<!-- Banner Starts Here -->
<div class="container">
	<div style="height: 150px;"></div>

	<div class="card">
		<div class="card-body">
			<?php foreach ($detail as $dt) : ?>
				<div class="row">
					<div class="col-md-6">
						<img width="500px;" src="<?= base_url('assets/upload/') . $dt->gambar; ?>" alt="">
					</div>
					<div class="col-md-6">
						<table class="table">
							<tr>
								<th>Ruangan</th>
								<td><?= $dt->nama_ruangan; ?></td>
							</tr>
							<tr>
								<th>Kapasitas</th>
								<td><?= $dt->kapasitas; ?></td>
							</tr>
							<tr>
								<th>Dekorasi</th>
								<td><?= $dt->dekorasi; ?></td>
							</tr>
							<tr>
								<th>Tahun</th>
								<td><?= $dt->tahun; ?></td>
							</tr>
							<tr>
								<th>Status</th>
								<td>
									<?php if ($dt->status == '1') {
										echo "Tersedia";
									} else {
										echo "Tidak tersedia / sedang dirental";
									} ?>
								</td>

							</tr>
							<tr>
								<td></td>
								<td>
									<?php
									if ($dt->status == "0") { ?>
										<span class="btn btn-danger">Telah Sewa</span>
									<?php } else {
										echo anchor('customer/rental/tambah_rental/' . $dt->id_ruangan, '<button class="btn btn-success">Rental</button>');
									}
									?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

</div>
<!-- Banner Ends Here -->

<div style="height: 180px;"></div>