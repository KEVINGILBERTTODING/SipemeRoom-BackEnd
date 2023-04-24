<div style="height: 100px;"></div>
<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header alert alert-success">
          Invoice Pembayaran Anda
        </div>
        <div class="card-body">
          <table class="table">
          <?php foreach($transaksi as $tr): ?>
            <tr>
              <th>Ruangan</th>
              <td>:</td>
              <td><?= $tr->merek; ?></td>
            </tr>
            <tr>
              <th>Tanggal Sewa</th>
              <td>:</td>
              <td><?= date('d/m/Y', strtotime($tr->tgl_rental)); ?></td>
            </tr>
            <tr>
              <th>Tanggal Kembali</th>
              <td>:</td>
              <td><?= date('d/m/Y', strtotime($tr->tgl_kembali)); ?></td>
            </tr>
            <!--<tr>
              <th>Biaya Sewa Perhari</th>
              <td>:</td>
              <td>Rp.<?= number_format($tr->harga, 0, ',', '.'); ?>,-</td>
            </tr>-->
            <tr>
              <?php 
                $x = strtotime($tr->tgl_kembali);
                $y = strtotime($tr->tgl_rental);
                $jmlHari = abs(($x - $y)/(60*60*24));
              ?>
              <th>Jumlah Hari Sewa</th>
              <td>:</td>
              <td><?= $jmlHari; ?> Hari</td>
            </tr>
            <!--<tr class="text-success">
              <th>Jumlah Pembayaran</th>
              <td>:</td>
              <td><button class="btn btn-sm btn-success">Rp.<?= number_format($tr->harga * $jmlHari, 0, ',', '.'); ?>,-</button></td>
            </tr>-->
            <tr>
              <td></td>
              <td></td>
              <td><a href="<?= base_url('customer/transaksi/cetak_invoice/'.$tr->id_rental) ?>" class="btn btn-sm btn-secondary">Print Invoice</a></td>
            </tr>

          <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header alert alert-primary">
          Informasi Persetujuan
        </div>
        <div class="card-body">
          <p class="text-success mb-3">Silahkan melakukan konfirmasi persetujuan kepada yang terkait :</p>

          <ul class="list-group list-group-flush">
            <li class="list-group-item">ASDANI KINDARTO, S.Sos, M.Eng, Ph.D 08121352952</li>
            <li class="list-group-item">HANRY SUGIHASTOMO, S.Sos, MM 082169992772</li>
          </ul>

          <?php
          if(empty($tr->bukti_pembayaran)){ ?>
            <!-- Button trigger modal -->
            <button style="width: 100%;" type="button" class="btn btn-sm btn-danger mt-3" data-toggle="modal" data-target="#exampleModal">
              Upload Bukti Persetujuan
            </button>
          <?php }
          elseif($tr->status_pembayaran == '0'){ ?>
            <button style="width: 100%;" class="btn btn-sm btn-warning mt-3"><i class="fa fa-clock-o"></i> Menunggu Konfirmasi</button>
          <?php }
          elseif($tr->status_pembayaran == '1'){ ?>
            <button style="width: 100%;" class="btn btn-sm btn-success mt-3"><i class="fa fa-check"></i> Telah Melakukan Persetujuan</button>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

</div>


<!-- Modal untuk upload pembayarn -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload bukti persetujuan anda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('customer/transaksi/pembayaran_aksi') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Upload Bukti Persetujuan</label>
            <input type="hidden" name="id_rental" value="<?= $tr->id_rental ?>">
            <input type="file" name="bukti_pembayaran" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-success">Kirim</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div style="height: 180px;"></div>