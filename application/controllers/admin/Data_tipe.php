<?php

class Data_tipe extends CI_Controller{

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
    elseif($this->session->userdata('role_id') != '1'){
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Anda tidak punya akses ke halaman ini!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
      redirect('customer/dashboard');
    }
  }

  public function index(){
    $data['tipe'] = $this->rental_model->get_data('tipe')->result();
    $this->load->view('templates_admin/header');
    $this->load->view('templates_admin/sidebar');
    $this->load->view('admin/data_tipe', $data);
    $this->load->view('templates_admin/footer');
  }

  public function tambah_tipe(){
    $this->load->view('templates_admin/header');
    $this->load->view('templates_admin/sidebar');
    $this->load->view('admin/form_tambah_tipe');
    $this->load->view('templates_admin/footer');
  }

  public function tambah_tipe_aksi(){
    $this->_rules();

    if($this->form_validation->run() == FALSE){
      $this->tambah_tipe();
    }
    else{
      $kode_tipe = $this->input->post('kode_tipe');
      $nama_tipe = $this->input->post('nama_tipe');

      $data = array(
        'kode_tipe' => $kode_tipe,
        'nama_tipe' => $nama_tipe,
      );

      $this->rental_model->insert_data($data, 'tipe');
      $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      Data tipe berhasil ditambahkan
      <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
      </button></div>');
      redirect('admin/data_tipe');
    }
  }

  public function update_tipe($id){
    $where = array('id_tipe' => $id);
    $data['tipe'] = $this->db->query("SELECT * FROM tipe WHERE id_tipe = '$id'")->result();
    $this->load->view('templates_admin/header');
    $this->load->view('templates_admin/sidebar');
    $this->load->view('admin/form_update_tipe', $data);
    $this->load->view('templates_admin/footer');
  }

  public function update_tipe_aksi(){
    $this->_rules();

    if($this->form_validation->run() == FALSE){
      $id = $this->input->post('id_tipe');
      $this->update_tipe($id);
    }
    else{
      $id        = $this->input->post('id_tipe');
      $kode_tipe = $this->input->post('kode_tipe');
      $nama_tipe = $this->input->post('nama_tipe');

      $data = array(
        'kode_tipe' => $kode_tipe,
        'nama_tipe' => $nama_tipe,
      );

      $where = array('id_tipe' => $id);

      $this->rental_model->update_data('tipe', $data, $where);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      Data tipe berhasil diupdate
      <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
      </button></div>');
      redirect('admin/data_tipe');
    }
  }

  public function delete_tipe($id){
    $where = array('id_tipe' => $id);
    $this->rental_model->delete_data($where, 'tipe');
    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Data tipe berhasil dihapus
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
      <span aria-hidden="true">&times;</span>
    </button></div>');
    redirect('admin/data_tipe');
  }



  public function _rules(){
    $this->form_validation->set_rules('kode_tipe', 'Kode Tipe', 'required');
    $this->form_validation->set_rules('nama_tipe', 'Nama Tipe', 'required');
  }


}