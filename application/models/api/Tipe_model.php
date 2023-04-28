<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tipe_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	public function getAllTipe()
	{
		$this->db->select('*');
		$this->db->from('tipe');
		return $this->db->get()->result();
	}
}

/* End of file Tipe_model.php */
/* Location: ./application/models/Tipe_model.php */
