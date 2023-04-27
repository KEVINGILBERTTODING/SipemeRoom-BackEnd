<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model User_model
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

class User_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	public function register($data)
	{
		$insert = $this->db->insert('customer', $data);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}

	public function getUserById($id)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id_customer', $id);
		return $this->db->get()->result();
	}

	public function update($id, $data)
	{
		$this->db->where('id_customer', $id);
		$update = $this->db->update('customer', $data);
		if ($update) {
			return true;
		} else {
			return false;
		}
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
