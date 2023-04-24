<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Form Input Data Ruang</h1>
    </div>

    <div class="card">
      <div class="card-body">

        <form action="<?= base_url('admin/data_mobil/tambah_mobil_aksi') ?>" enctype="multipart/form-data" method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Tipe Ruang</label>
                <select name="kode_tipe" id="" class="form-control">
                  <option value="">--Pilih Tipe Ruang--</option>
                  <?php foreach($tipe as $tp): ?>
                  <option value="<?= $tp->kode_tipe ?>"><?= $tp->nama_tipe; ?></option>
                  <?php endforeach; ?>
                </select>
                <?= form_error('kode_tipe', '<div class="text-small text-danger">', '</div>') ?>
              </div>

              <div class="form-group">
                <label for="">Ruangan</label>
                <input type="text" name="merek" class="form-control">
                <?= form_error('merek', '<div class="text-small text-danger">', '</div>') ?>
              </div>

              <div class="form-group">
                <label for="">Kapasitas</label>
                <input type="text" name="no_plat" class="form-control">
                <?= form_error('no_plat', '<div class="text-small text-danger">', '</div>') ?>
              </div>

              <div class="form-group">
                <label for="">Dekorasi</label>
                <input type="text" name="warna" class="form-control">
                <?= form_error('warna', '<div class="text-small text-danger">', '</div>') ?>
              </div>

              <div class="form-group">
                <label for="">AC</label>
                <select name="ac" id="" class="form-control">
                  <option value="">--Pilih--</option>
                  <option value="1">Tersedia</option>
                  <option value="0">Tidak Tersedia</option>
                </select>
                <?= form_error('ac', '<div class="text-small text-danger">', '</div>') ?>
              </div>

              <div class="form-group">
                <label for="">Makanan</label>
                <select name="sopir" id="" class="form-control">
                  <option value="">--Pilih--</option>
                  <option value="1">Tersedia</option>
                  <option value="0">Tidak Tersedia</option>
                </select>
                <?= form_error('sopir', '<div class="text-small text-danger">', '</div>') ?>
              </div>

              <div class="form-group">
                <label for="">MP3 Player</label>
                <select name="mp3_player" id="" class="form-control">
                  <option value="">--Pilih--</option>
                  <option value="1">Tersedia</option>
                  <option value="0">Tidak Tersedia</option>
                </select>
                <?= form_error('mp3_player', '<div class="text-small text-danger">', '</div>') ?>
              </div>

              <div class="form-group">
                <label for="">Central Lock</label>
                <select name="central_lock" id="" class="form-control">
                  <option value="">--Pilih--</option>
                  <option value="1">Tersedia</option>
                  <option value="0">Tidak Tersedia</option>
                </select>
                <?= form_error('central_lock', '<div class="text-small text-danger">', '</div>') ?>
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Harga Sewa perhari</label>
                <input type="number" name="harga" class="form-control">
                <?= form_error('harga', '<div class="text-small text-danger">', '</div>') ?>
              </div>

              <div class="form-group">
                <label for="">Denda</label>
                <input type="number" name="denda" class="form-control">
                <?= form_error('denda', '<div class="text-small text-danger">', '</div>') ?>
              </div>

              <div class="form-group">
                <label for="">Tahun</label>
                <input type="text" name="tahun" class="form-control">
                <?= form_error('tahun', '<div class="text-small text-danger">', '</div>') ?>
              </div>

              <div class="form-group">
                <label for="">Status</label>
                <select name="status" id="" class="form-control">
                  <option value="">--Pilih Status--</option>
                  <option value="1">Tersedia</option>
                  <option value="0">Tidak Tersedia</option>
                </select>
                <?= form_error('status', '<div class="text-small text-danger">', '</div>') ?>
              </div>
              
              <div class="form-group">
                <label for="">Gambar</label>
                <input type="file" name="gambar" class="form-control">
              </div>

              <button type="submit" class="btn btn-primary mt-4">Simpan</button>
              <button type="reset" class="btn btn-success mt-4">Reset</button>
            </div>
          </div>
        </form>
      </div>
    </div>


  </section>
</div>