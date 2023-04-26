<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Ruangan_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Ruangan_model extends CI_Model
{

	public function getRuangAvailable()
	{
		$this->db->select('*');
		$this->db->from('mobil');
		return $this->db->get()->result();
	}

	public function updateRuangan($id, $data)
	{
		$this->db->where('id_mobil', $id);
		$update = $this->db->update('mobil', $data);
		if ($update) {
			return true;
		} else {
			return false;
		}
	}
}

/* End of file Ruangan_model.php */
/* Location: ./application/models/Ruangan_model.php */
