<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api/Auth_model', 'auth_model');
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
}
