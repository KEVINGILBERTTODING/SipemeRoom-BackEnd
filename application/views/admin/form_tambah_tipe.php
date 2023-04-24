<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Form Input Tipe Mobil</h1>
    </div>

    <form action="<?= base_url('admin/data_tipe/tambah_tipe_aksi') ?>" method="post">
      <div class="form-group"> 
        <label for="">Kode Tipe</label>
        <input type="text" name="kode_tipe" class="form-control">
        <?= form_error('kode_tipe', '<div class="text-small text-danger">', '</div>') ?>
      </div>
      <div class="form-group"> 
        <label for="">Nama Tipe</label>
        <input type="text" name="nama_tipe" class="form-control">
        <?= form_error('nama_tipe', '<div class="text-small text-danger">', '</div>') ?>
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
      <button type="reset" class="btn btn-warning">Reset</button>

    </form>


  </section>
</div>