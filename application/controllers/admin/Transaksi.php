<?php

class Transaksi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (empty($this->session->userdata('username'))) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Anda belum login!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
			redirect('auth/login');
		} elseif ($this->session->userdata('role_id') != '1') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Anda tidak punya akses ke halaman ini!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
			redirect('customer/dashboard');
		}
	}

	public function index()
	{
		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi tr, ruangan mb, customer cs WHERE tr.id_ruangan=mb.id_ruangan AND tr.id_customer=cs.id_customer")->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/data_transaksi', $data);
		$this->load->view('templates_admin/footer');
	}

	public function pembayaran($id)
	{
		// $where = array('id_rental' => $id);
		$data['pembayaran'] = $this->db->query("SELECT * FROM transaksi WHERE id_sewa='$id'")->row_array();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/konfirmasi_pembayaran', $data);
		$this->load->view('templates_admin/footer');
	}

	public function cek_pembayaran()
	{
		$id                = $this->input->post('id_ruangan');
		$status_pembayaran = $this->input->post('status_pembayaran');

		$data = array(
			'status_apr' => $status_pembayaran
		);

		$where = array('id_sewa' => $id);
		$this->rental_model->update_data('transaksi', $data, $where);
		redirect('admin/transaksi');
	}

	public function download_pembayaran($id)
	{
		$this->load->helper('download');
		$filePembayaran = $this->rental_model->downloadPembayaran($id);
		$file = 'assets/upload/' . $filePembayaran['bukti_apr'];
		force_download($file, NULL);
	}

	public function transaksi_selesai($id)
	{
		// $where = array('id_rental' => $id);
		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi WHERE id_sewa='$id'")->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/transaksi_selesai', $data);
		$this->load->view('templates_admin/footer');
	}

	public function transaksi_selesai_aksi()
	{
		$id                  = $this->input->post('id_sewa');
		$id_mobil            = $this->input->post('id_ruangan');
		$tgl_pengembalian    = $this->input->post('tgl_pengembalian');
		// $status_rental       = $this->input->post('status_rental');
		// $status_pengembalian = $this->input->post('status_pengembalian');
		$tgl_kembali         = $this->input->post('tgl_kembali');

		$x = strtotime($tgl_pengembalian);
		$y = strtotime($tgl_kembali);
		$selisih = abs($x - $y) / (60 * 60 * 24);

		$data = array(
			'tgl_pengembalian'    => $tgl_pengembalian,
			'status_rental'       => 'Selesai',
			'status_pengembalian' => 'Kembali',
		);
		$data2 = array('status' => 1);

		$where  = array('id_sewa' => $id);
		$where2 = array('id_ruangan' => $id_mobil);

		$this->rental_model->update_data('transaksi', $data, $where);
		$this->rental_model->update_data('ruangan', $data2, $where2);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Transaksi berhasil diupdate
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
      <span aria-hidden="true">&times;</span>
    </button></div>');
		redirect('admin/transaksi');
	}

	public function batal_transaksi($id)
	{
		$where = array('id_sewa' => $id);

		$data = $this->rental_model->get_where($where, 'transaksi')->row();

		$where2 = array('id_ruangan' => $data->id_ruangan);
		// var_dump($where2);
		// die;
		$data2 = array('status' => '1');

		$this->rental_model->update_data('ruangan', $data2, $where2);
		$this->rental_model->delete_data($where, 'transaksi');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Transaksi berhasil dibatalkan
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
      <span aria-hidden="true">&times;</span>
    </button></div>');
		redirect('admin/transaksi');
	}
}
