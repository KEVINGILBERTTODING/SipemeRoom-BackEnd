<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Customer extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api/Ruangan_model', 'ruangan_model');
		$this->load->model('api/Transaksi_model', 'transaksi_model');
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
}


/* End of file Customer.php */
/* Location: ./application/controllers/Customer.php */
