<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api/Auth_model', 'auth_model');
		$this->load->model('api/User_model', 'user_model');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$passwordHash = md5($password);
		$customer = $this->auth_model->auth('customer', $username);

		if ($customer != null) {
			if ($customer['password'] == $passwordHash) {
				$response = [
					'code' => 200,
					'user_id' => $customer['id_customer'],
					'username' => $customer['username'],
					'nama' => $customer['nama'],
					'role' => $customer['role_id']
				];
				echo json_encode($response);
			} else {
				$response = [
					'code' => 500,
					'message' => 'Password salah'
				];
				echo json_encode($response);
			}
		} else {
			$response = [
				'code' => 500,
				'message' => 'Username belum terdaftar'
			];
			echo json_encode($response);
		}
	}

	public function register()
	{
		$username = $this->input->post('username');

		$validasi = $this->auth_model->auth('customer', $username);

		if ($validasi == null) {
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$gender = $this->input->post('gender');
			$noTelp = $this->input->post('no_telepon');
			$noKtp = $this->input->post('no_ktp');
			$password = $this->input->post('password');

			$data = [
				'nama' => $nama,
				'username' => $username,
				'alamat'  => $alamat,
				'gender' => $gender,
				'no_telepon' => $noTelp,
				'no_ktp' => $noKtp,
				'password' => md5($password),
				'role_id' => 2
			];
			$insert = $this->user_model->register($data);

			if ($insert == true) {
				$respone = [
					'code' => 200
				];
				echo json_encode($respone);
			} else {
				$respone = [
					'code' => 500,
					'message' => 'Gagal registrasi'
				];
				echo json_encode($respone);
			}
		} else {
			$respone = [
				'code' => 500,
				'message' => 'Username telah digunakan'
			];
			echo json_encode($respone);
		}
	}
}
