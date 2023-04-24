<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth_model extends CI_Model
{


	public function __construct()
	{
		parent::__construct();
	}

	public function auth($table, $username)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('username', $username);
		return $this->db->get()->row_array();
	}
}
