<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api/Ruangan_model', 'ruangan_model');
		$this->load->model('api/Tipe_model', 'tipe_model');
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
}


/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
