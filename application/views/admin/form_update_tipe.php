<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Form Update Tipe Mobil</h1>
    </div>

    <?php foreach($tipe as $tp): ?>
    <form action="<?= base_url('admin/data_tipe/update_tipe_aksi') ?>" method="post">
      <div class="form-group">
        <label for="">Kode Tipe</label>
        <input type="hidden" name="id_tipe" value="<?= $tp->id_tipe; ?>">
        <input type="text" name="kode_tipe" class="form-control"  value="<?= $tp->kode_tipe; ?>">
        <?= form_error('kode_tipe', '<div class="text-small text-danger">', '</div>') ?>
      </div>
      <div class="form-group"> 
        <label for="">Nama Tipe</label>
        <input type="text" name="nama_tipe" class="form-control"  value="<?= $tp->nama_tipe; ?>">
        <?= form_error('nama_tipe', '<div class="text-small text-danger">', '</div>') ?>
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
      <button type="reset" class="btn btn-warning">Reset</button>

    </form>
    <?php endforeach; ?>

  </section>
</div>