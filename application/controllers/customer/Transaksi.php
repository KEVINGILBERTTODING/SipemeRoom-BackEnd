<?php

class Transaksi extends CI_Controller{

  public function __construct(){
    parent::__construct();
    
    if(empty($this->session->userdata('username'))){
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Anda belum login!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
      redirect('auth/login');
    }
    elseif($this->session->userdata('role_id') != '2'){
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Anda tidak punya akses ke halaman ini!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
      redirect('admin/dashboard');
    }
  }

  public function index(){
    $customer = $this->session->userdata('id_customer');
    // var_dump($customer);
    // die;
    $data['transaksi'] = $this->db->query("SELECT * FROM transaksi tr, mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil AND tr.id_customer=cs.id_customer AND cs.id_customer='$customer' ORDER BY id_rental DESC")->result();
    $this->load->view('templates_customer/header');
    $this->load->view('customer/transaksi', $data);
    $this->load->view('templates_customer/footer');
  }

  public function pembayaran($id){
    $data['transaksi'] = $this->db->query("SELECT * FROM transaksi tr, mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil AND tr.id_customer=cs.id_customer AND tr.id_rental='$id' ORDER BY id_rental DESC")->result();
    $this->load->view('templates_customer/header');
    $this->load->view('customer/pembayaran', $data);
    $this->load->view('templates_customer/footer');
  }

  public function pembayaran_aksi(){
    $id               = $this->input->post('id_rental');
    $bukti_pembayaran = $_FILES['bukti_pembayaran']['name'];

    if($bukti_pembayaran=''){}
    else{
      $config['upload_path'] = './assets/upload';
      $config['allowed_types'] = 'pdf|jpg|jpeg|png|tiff';

      $this->load->library('upload', $config);
      if(!$this->upload->do_upload('bukti_pembayaran')){
        echo "Bukti pembayaran mobil gagal diupload";
      }
      else{
        $bukti_pembayaran = $this->upload->data('file_name');
      }
    }

    $data = array('bukti_pembayaran' => $bukti_pembayaran);
    $where = array('id_rental' => $id);

    $this->rental_model->update_data('transaksi', $data, $where);
    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Bukti pembayaran anda berhasil diupload
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
      <span aria-hidden="true">&times;</span>
    </button></div>');
    redirect('customer/transaksi');
  }

  public function cetak_invoice($id){
    $data['transaksi'] = $this->db->query("SELECT * FROM transaksi tr, mobil mb, customer cs WHERE tr.id_mobil=mb.id_mobil AND tr.id_customer=cs.id_customer AND tr.id_rental='$id'")->result();
    $this->load->view('customer/cetak_invoice', $data);
  }

  public function batal_transaksi($id){
    $where = array('id_rental' => $id);

    $data = $this->rental_model->get_where($where, 'transaksi')->row();
    
    $where2 = array('id_mobil' => $data->id_mobil);
    // var_dump($where2);
    // die;
    $data2 = array('status' => '1');

    $this->rental_model->update_data('mobil', $data2, $where2);
    $this->rental_model->delete_data($where, 'transaksi');
    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Transaksi berhasil dibatalkan
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
      <span aria-hidden="true">&times;</span>
    </button></div>');
    redirect('customer/transaksi');
  }


}