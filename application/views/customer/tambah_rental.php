<div class="container">
  <div style="height: 150px;"></div>
  <div class="card">
    <card class="card-header">
      Form Sewa Ruangan
    </card> 
    <div class="card-body">
      <?php foreach($detail as $dt): ?>
      <form action="<?= base_url('customer/rental/tambah_rental_aksi') ?>" method="post">
        <div class="form-group">
          <!--<label for="">Harga Sewa/hari</label>-->
          <input type="hidden" name="id_mobil" value="<?= $dt->id_mobil; ?>">
          <input type="hidden" name="harga" class="form-control" value="<?= $dt->harga; ?>" readonly>
        </div>
        <div class="form-group">
          <!--<label for="">Denda/hari</label>-->
          <input type="hidden" name="denda" class="form-control" value="<?= $dt->denda; ?>" readonly>
        </div>
        <div class="form-group">
          <label for="">Tanggal Rental</label>
          <input type="date" name="tgl_rental" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Tanggal Kembali</label>
          <input type="date" name="tgl_kembali" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Rental</button>
      </form>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<div style="height: 180px;"></div>