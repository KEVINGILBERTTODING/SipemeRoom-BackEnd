
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{



	public function __construct()
	{
		parent::__construct();
	}

	public function insertTransaksi($data)
	{
		$insert = $this->db->insert('transaksi', $data);

		if ($insert) {
			return true;
		} else {
			return false;
		}
	}

	public function getTransactions($userId)
	{
		$this->db->select('transaksi.*, customer.nama, mobil.merek, mobil.no_plat');
		$this->db->from('transaksi');
		$this->db->join('customer', 'customer.id_customer = transaksi.id_customer', 'left');
		$this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil', 'left');
		$this->db->order_by('transaksi.id_rental', 'desc');

		$this->db->where('transaksi.id_customer', $userId);
		return $this->db->get()->result();
	}

	public function delete($id)
	{
		$this->db->where('id_rental', $id);
		$delete = $this->db->delete('transaksi');
		if ($delete) {
			return true;
		} else {
			return false;
		}
	}
}
