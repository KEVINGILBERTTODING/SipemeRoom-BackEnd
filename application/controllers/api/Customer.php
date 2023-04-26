<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Customer
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Customer extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api/Ruangan_model', 'ruangan_model');
		$this->load->model('api/Transaksi_model', 'transaksi_model');
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
}


/* End of file Customer.php */
/* Location: ./application/controllers/Customer.php */
