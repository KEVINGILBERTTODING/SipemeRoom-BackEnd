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

	public function insert($data)
	{
		$insert = $this->db->insert('tipe', $data);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteTipe($id)
	{
		$this->db->where('id_tipe', $id);
		$delete = $this->db->delete('tipe');
		if ($delete) {
			return true;
		} else {
			return false;
		}
	}

	public function updateTipe($id, $data)
	{
		$this->db->where('id_tipe', $id);
		$update = $this->db->update('tipe', $data);
		if ($update) {
			return true;
		} else {
			return false;
		}
	}
}

/* End of file Tipe_model.php */
/* Location: ./application/models/Tipe_model.php */
