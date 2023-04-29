<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api/Ruangan_model', 'ruangan_model');
		$this->load->model('api/User_model', 'user_model');
		$this->load->model('api/Tipe_model', 'tipe_model');
		$this->load->model('api/Auth_model', 'auth_model');
	}

	public function getAllRuangan()
	{
		$data = $this->ruangan_model->getRuangAvailable();
		echo json_encode($data);
	}

	public function insertRoom()
	{

		$config['upload_path'] = './assets/upload/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '2080';

		$this->load->library('upload', $config);
		$data2 = array();
		$this->upload->initialize($config);



		if ($this->upload->do_upload('gambar')) {
			$data2['gambar'] = $this->upload->data('file_name');
			$gambar = true;
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
		if ($gambar == true) {

			$data = [
				'kode_tipe' => $this->input->post('kode_tipe'),
				'merek' => $this->input->post('room_name'),
				'no_plat' => $this->input->post('kapasitas'),
				'warna' => $this->input->post('dekorasi'),
				'tahun' => $this->input->post('tahun'),
				'status' => $this->input->post('status'),
				'harga' => $this->input->post('harga'),
				'denda' => $this->input->post('denda'),
				'ac' => $this->input->post('ac'),
				'sopir' => $this->input->post('sopir'),
				'mp3_player' =>  $this->input->post('mp3_player'),
				'central_lock' => $this->input->post('central_lock'),
				'gambar' => $data2['gambar']
			];
			$insert = $this->ruangan_model->insert($data);
			if ($insert == true) {
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

	public function getAllTipe()
	{
		echo json_encode($this->tipe_model->getAllTipe());
	}

	public function deleteRoom()
	{
		$idRoom = $this->input->post('room_id');
		$delete = $this->ruangan_model->deleteRoom($idRoom);
		if ($delete == true) {
			$respoonse = [
				'status' => true,
				'code' => 200
			];
			echo json_encode($respoonse);
		} else {
			$respoonse = [
				'status' => false,
				'code' => 4004
			];
			echo json_encode($respoonse);
		}
	}

	public function updateRoom()
	{

		$pathImage = $this->input->post('path_image');
		$roomId = $this->input->post('room_id');

		$config['upload_path'] = './assets/upload/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '2080';

		$this->load->library('upload', $config);
		$data2 = array();
		$this->upload->initialize($config);

		$pathImage = $this->input->post('path_image');
		$roomId = $this->input->post('room_id');

		if ($pathImage == '') {

			$data = [
				'kode_tipe' => $this->input->post('kode_tipe'),
				'merek' => $this->input->post('room_name'),
				'no_plat' => $this->input->post('kapasitas'),
				'warna' => $this->input->post('dekorasi'),
				'tahun' => $this->input->post('tahun'),
				'status' => $this->input->post('status'),
				'harga' => $this->input->post('harga'),
				'denda' => $this->input->post('denda'),
				'ac' => $this->input->post('ac'),
				'sopir' => $this->input->post('sopir'),
				'mp3_player' =>  $this->input->post('mp3_player'),
				'central_lock' => $this->input->post('central_lock')
			];
			$insert = $this->ruangan_model->updateRuangan($roomId, $data);
			if ($insert == true) {
				$response = [
					'status' => true,
					'code' => 200
				];
				echo json_encode($response);
			} else {
				$response = [
					'status' => false,
					'code' => 400,
					'message' => 'Gagal mengubah data'
				];
				echo json_encode($response);
			}
		} else {

			if ($this->upload->do_upload('gambar')) {
				$data2['gambar'] = $this->upload->data('file_name');
				$gambar = true;
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
			if ($gambar == true) {

				$data = [
					'kode_tipe' => $this->input->post('kode_tipe'),
					'merek' => $this->input->post('room_name'),
					'no_plat' => $this->input->post('kapasitas'),
					'warna' => $this->input->post('dekorasi'),
					'tahun' => $this->input->post('tahun'),
					'status' => $this->input->post('status'),
					'harga' => $this->input->post('harga'),
					'denda' => $this->input->post('denda'),
					'ac' => $this->input->post('ac'),
					'sopir' => $this->input->post('sopir'),
					'mp3_player' =>  $this->input->post('mp3_player'),
					'central_lock' => $this->input->post('central_lock'),
					'gambar' => $data2['gambar']
				];
				$insert = $this->ruangan_model->updateRuangan($roomId, $data);
				if ($insert == true) {
					$response = [
						'status' => true,
						'code' => 200
					];
					echo json_encode($response);
				} else {
					$response = [
						'status' => false,
						'code' => 400,
						'message' => 'Gagal mengubah data'
					];
					echo json_encode($response);
				}
			} else {
				$response = [
					'status' => false,
					'code' => 400,
					'message' => 'Gagal mengubah data'
				];
				echo json_encode($response);
			}
		}
	}

	public function insertTipe()
	{
		$data  = [
			'kode_tipe' => $this->input->post('kode_tipe'),
			'nama_tipe' => $this->input->post('nama_tipe')
		];

		$insert = $this->tipe_model->insert($data);
		if ($insert == true) {
			$response = [
				'status' => true,
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'status' => false,
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	public function deleteTipe()
	{
		$id = $this->input->post('id');
		$delete = $this->tipe_model->deleteTipe($id);
		if ($delete == true) {
			$response = [
				'status' => true,
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'status' => false,
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	public function updateTipe()
	{
		$id = $this->input->post('id');
		$data  = [
			'kode_tipe' => $this->input->post('kode_tipe'),
			'nama_tipe' => $this->input->post('nama_tipe')
		];

		$update = $this->tipe_model->updateTipe($id, $data);
		if ($update == true) {
			$response = [
				'status' => true,
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'status' => false,
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	public function getAllUser()
	{
		echo json_encode($this->user_model->getAllUser());
	}

	public function deleteUser()
	{
		$id = $this->input->post('customer_id');
		$delete = $this->user_model->deleteUser($id);
		if ($delete == true) {
			$response = [
				'status' => true,
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'status' => false,
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	public function updateCustomer()
	{
		$username = $this->input->post('username');
		$userId = $this->input->post('user_id');
		$validasi = $this->auth_model->auth('customer', $username);
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$gender = $this->input->post('gender');
		$noTelp = $this->input->post('no_telepon');
		$password = $this->input->post('password');
		$noKtp = $this->input->post('no_ktp');

		if ($validasi == null) {


			$data = [
				'nama' => $nama,
				'username' => $username,
				'alamat'  => $alamat,
				'gender' => $gender,
				'password' => md5($password),
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
					'password' => md5($password),
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


/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
