<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Ruangan_model extends CI_Model
{

	public function getRuangAvailable()
	{
		$this->db->select('*');
		$this->db->from('ruangan');
		return $this->db->get()->result();
	}

	public function updateRuangan($id, $data)
	{
		$this->db->where('id_ruangan', $id);
		$update = $this->db->update('ruangan', $data);
		if ($update) {
			return true;
		} else {
			return false;
		}
	}

	public function insert($data)
	{
		$insert = $this->db->insert('ruangan', $data);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteRoom($idRoom)
	{
		$this->db->where('id_ruangan', $idRoom);
		$delete = $this->db->delete('ruangan');

		if ($delete) {
			return true;
		} else {
			return false;
		}
	}
}

/* End of file Ruangan_model.php */
/* Location: ./application/models/Ruangan_model.php */
