<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Customer extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api/Ruangan_model', 'ruangan_model');
		$this->load->model('api/Auth_model', 'auth_model');
		$this->load->model('api/Transaksi_model', 'transaksi_model');
		$this->load->model('api/User_model', 'user_model');
		$this->load->library('dompdfgenerator');
	}

	public function getAllRuangan()
	{
		$data = $this->ruangan_model->getRuangAvailable();
		echo json_encode($data);
	}

	public function sewa()
	{
		$idCustomer = $this->input->post('id_customer');
		$idRuangan = $this->input->post('room_id');
		$tanggalRental = $this->input->post('tgl_rental');
		$tanggalKembali = $this->input->post('tgl_kembali');
		$harga = $this->input->post('harga');
		$denda = $this->input->post('denda');

		$data = [
			'id_customer' => $idCustomer,
			'id_mobil' => $idRuangan,
			'tgl_rental' => $tanggalRental,
			'tgl_kembali' => $tanggalKembali,
			'harga' =>  $harga,
			'denda' => $denda,
			'total_denda' => 0,
			'status_pengembalian' => 'Belum Kembali',
			'status_rental' => 'Belum Selesai',
			'status_pembayaran' => 0
		];

		$insert = $this->transaksi_model->insertTransaksi($data);
		if ($insert == true) {

			$dataRuangan = [
				'status' => 0
			];

			$update = $this->ruangan_model->updateRuangan($idRuangan, $dataRuangan);
			if ($update == true) {
				$response = [
					'code' => 200,
					'message' => 'Successfully insert new transaction'
				];

				echo json_encode($response);
			} else {
				$response = [
					'code' => 400,
					'message' => 'Gagal menambahkan transaksi baru'
				];
			}
		} else {
			$response = [
				'code' => 400,
				'message' => 'Gagal menambahkan transaksi baru'
			];

			echo json_encode($response);
		}
	}

	public function getMyTransactions()
	{
		$userId = $this->input->get('user_id');
		echo json_encode($this->transaksi_model->getTransactions($userId));
	}

	public function orderCancel()
	{
		$roomId = $this->input->post('room_id');
		$transId = $this->input->post('trans_id');

		$deleteTrans = $this->transaksi_model->delete($transId);
		if ($deleteTrans == true) {

			$dataRuangan = [
				'status' => 1
			];

			$updateRuangan = $this->ruangan_model->updateRuangan($roomId, $dataRuangan);
			if ($updateRuangan == true) {
				$response = [
					'code' => 200,
					'status' => true
				];
				echo json_encode($response);
			} else {
				$response = [
					'code' => 400,
					'status' => false
				];
				echo json_encode($response);
			}
		} else {
			$response = [
				'code' => 400,
				'status' => false
			];
			echo json_encode($response);
		}
	}

	public function download_invoice($id)
	{
		// filename dari pdf ketika didownload
		$file_pdf = 'Invoice';
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi tr, mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil AND tr.id_customer=cs.id_customer AND tr.id_rental='$id'")->result();
		$html = $this->load->view('customer/cetak_invoice', $data, true);
		$this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

	public function detailTransaction()
	{
		$id = $this->input->post('trans_id');
		$data = $this->db->query("SELECT * FROM transaksi tr, mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil AND tr.id_customer=cs.id_customer AND tr.id_rental='$id'")->row_array();
		$tanggalRental = new DateTime($data['tgl_rental']);
		$tanggalKembali = new DateTime($data['tgl_kembali']);
		$durasi = $tanggalKembali->diff($tanggalRental)->format("%a");
		$detailTransaksi = [
			'merek' => $data['merek'],
			'tgl_rental' => $data['tgl_rental'],
			'tgl_kembali' => $data['tgl_kembali'],
			'durasi' => $durasi,
			'status_pembayaran' => $data['status_pembayaran'],
			'bukti_pembayaran' => $data['bukti_pembayaran']
		];
		echo json_encode($detailTransaksi);
	}

	public function uploadPersetujuan()
	{
		$transId = $this->input->post('trans_id');
		$config['upload_path'] = './assets/upload/';
		$config['allowed_types'] = 'pdf|jpg|jpeg|png';
		$config['max_size'] = '4080';

		$this->load->library('upload', $config);
		$data2 = array();
		$this->upload->initialize($config);



		if ($this->upload->do_upload('bukti')) {
			$data2['bukti'] = $this->upload->data('file_name');
			$uploadBukti = true;
		} else {
			$response = [
				'status' => false,
				'code' => 400,
				'message' => 'Format file tidak sesuai'

			];
			echo json_encode($response);
			return;
		}

		// Cek apakah kedua upload berhasil
		if ($uploadBukti == true) {

			$data = [
				'bukti_pembayaran' => $data2['bukti']

			];
			$update = $this->transaksi_model->update($transId, $data);
			if ($update == true) {
				$response = [
					'status' => true,
					'code' => 200
				];
				echo json_encode($response);
			} else {
				$response = [
					'status' => false,
					'code' => 400,
					'message' => 'Gagal mengunggah berkas'
				];
				echo json_encode($response);
			}
		} else {
			$response = [
				'status' => false,
				'code' => 400,
				'message' => 'Gagal mengunggah berkas'
			];
			echo json_encode($response);
		}
	}
	public function getUserById()
	{
		$idUser = $this->input->get('id_customer');
		echo json_encode($this->user_model->getUserById($idUser));
	}

	public function ubahPassword()
	{
		$userId = $this->input->post('id_customer');
		$passOld = $this->input->post('old_pass');
		$passNew = $this->input->post('pass_new');
		$dataUser = $this->user_model->getUserById($userId);

		$data = [
			'password' => md5($passNew)
		];

		if ($dataUser[0]->password == md5($passOld)) {
			$update = $this->user_model->update($userId, $data);
			if ($update == true) {
				$response = [
					'code' => 200,
					'status' => true
				];
				echo json_encode($response);
			} else {
				$response = [
					'code' => 404,
					'status' => false,
					'message' => 'Gagal update password'
				];
				echo json_encode($response);
			}
		} else {
			$response = [
				'code' => 404,
				'status' => false,
				'message' => 'Password lama salah'
			];
			echo json_encode($response);
		}
	}

	public function updateProfile()
	{
		$username = $this->input->post('username');
		$userId = $this->input->post('user_id');
		$validasi = $this->auth_model->auth('customer', $username);
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$gender = $this->input->post('gender');
		$noTelp = $this->input->post('no_telepon');
		$noKtp = $this->input->post('no_ktp');

		if ($validasi == null) {


			$data = [
				'nama' => $nama,
				'username' => $username,
				'alamat'  => $alamat,
				'gender' => $gender,
				'no_telepon' => $noTelp,
				'no_ktp' => $noKtp
			];

			$update = $this->user_model->update($userId, $data);
			if ($update == true) {
				$response = [
					'code' => 200,
					'status' => true
				];
				echo json_encode($response);
			} else {
				$response = [
					'code' => 404,
					'status' => false,
					'message' => 'Gagal mengubah profil'
				];
				echo json_encode($response);
			}
		} else {
			if ($validasi['id_customer'] == $userId) {
				$data = [
					'nama' => $nama,
					'username' => $username,
					'alamat'  => $alamat,
					'gender' => $gender,
					'no_telepon' => $noTelp,
					'no_ktp' => $noKtp
				];

				$update = $this->user_model->update($userId, $data);
				if ($update == true) {
					$response = [
						'code' => 200,
						'status' => true
					];
					echo json_encode($response);
				} else {
					$response = [
						'code' => 404,
						'status' => false,
						'message' => 'Gagal mengubah profil'
					];
					echo json_encode($response);
				}
			} else {
				$response = [
					'code' => 404,
					'status' => false,
					'message' => 'Username telah digunakan'
				];
				echo json_encode($response);
			}
		}
	}
}


/* End of file Customer.php */
/* Location: ./application/controllers/Customer.php */
