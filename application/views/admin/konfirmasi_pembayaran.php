<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Konfirmasi Persetujuan</h1>
		</div>
		<div class="card" style="width: 55%;">
			<div class="card-header">
				Konfirmasi Persetujuan
			</div>
			<center class="card-body">
				<form action="<?= base_url('admin/transaksi/cek_pembayaran'); ?>" method="post">

					<a class="btn btn-sm btn-success" href="<?= base_url('admin/transaksi/download_pembayaran/' . $pembayaran['id_sewa']) ?>"><i class="fas fa-download"></i> Download Bukti Persetujuan</a>

					<div class="custom-control custom-switch ml-3">
						<input type="hidden" class="custom-control-input" value="<?= $pembayaran['id_sewa'] ?>" name="id_rental">
						<input type="checkbox" class="custom-control-input" id="customSwitch1" value="1" name="status_pembayaran">
						<label class="custom-control-label" for="customSwitch1">Konfirmasi Persetujuan</label>
					</div>
					<hr>
					<button type="submit" class="btn btn-sm btn-primary">Simpan</button>

				</form>
			</center>
		</div>
	</section>
</div>