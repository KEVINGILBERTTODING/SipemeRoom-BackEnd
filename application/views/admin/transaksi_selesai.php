<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Transaksi Selesai</h1>
    </div>

    <?php foreach($transaksi as $tr): ?>
    <form action="<?= base_url('admin/transaksi/transaksi_selesai_aksi'); ?>" method="post">
      <input type="hidden" name="id_rental" value="<?= $tr->id_rental; ?>">
      <input type="hidden" name="id_mobil" value="<?= $tr->id_mobil; ?>">
      <input type="hidden" name="tgl_kembali" value="<?= $tr->tgl_kembali; ?>">
      <input type="hidden" name="denda" value="<?= $tr->denda; ?>">
      <div class="form-group">
        <label for="">Tanggal selesai</label>
        <input type="date" name="tgl_pengembalian" class="form-control" value="<?= $tr->tgl_pengembalian; ?>">
      </div>
      <!-- <div class="form-group">
        <label for="">Status Pengembalian</label>
        <select name="status_pengembalian" id="" class="form-control">
          <option value="<?//= $tr->status_pengembalian; ?>"><?//= $tr->status_pengembalian; ?></option>
          <option value="Kembali">Kembali</option>
          <option value="Belum Kembali">Belum Kembali</option>
        </select>
      </div> -->
      <!-- <div class="form-group">
        <label for="">Status Rental</label>
        <select name="status_rental" id="" class="form-control">
          <option value="<?//= $tr->status_rental; ?>"><?//= $tr->status_rental; ?></option>
          <option value="Selesai">Selesai</option>
          <option value="Belum Selesai">Belum Selesai</option>
        </select>
      </div> -->

      <button type="submit" class="btn btn-success">Save</button>
    </form>
    <?php endforeach; ?>

  </section>
</div>