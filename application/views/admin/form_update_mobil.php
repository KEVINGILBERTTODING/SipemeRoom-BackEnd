<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Form Update Data Ruang</h1>
		</div>

		<div class="card">
			<div class="card-body">

				<?php foreach ($mobil as $mb) : ?>

					<form action="<?= base_url('admin/data_mobil/update_mobil_aksi') ?>" enctype="multipart/form-data" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Tipe Ruangan</label>
									<input type="hidden" name="id_mobil" value="<?= $mb->id_ruangan; ?>">
									<select name="kode_tipe" id="" class="form-control">
										<option value="<?= $mb->kode_tipe ?>"><?= $mb->nama_tipe ?></option>
										<?php foreach ($tipe as $tp) : ?>
											<option value="<?= $tp->kode_tipe ?>"><?= $tp->nama_tipe; ?></option>
										<?php endforeach; ?>
									</select>
									<?= form_error('kode_tipe', '<div class="text-small text-danger">', '</div>') ?>
								</div>

								<div class="form-group">
									<label for="">Ruangan</label>
									<input type="text" name="merek" class="form-control" value="<?= $mb->nama_ruangan ?>">
									<?= form_error('merek', '<div class="text-small text-danger">', '</div>') ?>
								</div>

								<div class="form-group">
									<label for="">Kapasitas</label>
									<input type="text" name="no_plat" class="form-control" value="<?= $mb->kapasitas; ?>">
									<?= form_error('no_plat', '<div class="text-small text-danger">', '</div>') ?>
								</div>

								<div class="form-group">
									<label for="">Dekorasi</label>
									<input type="text" name="warna" class="form-control" value="<?= $mb->dekorasi ?>">
									<?= form_error('warna', '<div class="text-small text-danger">', '</div>') ?>
								</div>

								<div class="form-group">
									<label for="">AC</label>
									<select name="ac" id="" class="form-control">
										<option <?php if ($mb->ac == "1") {
															echo "selected='selected'";
														}
														echo $mb->ac; ?> value="1">Tersedia</option>
										<option <?php if ($mb->ac == "0") {
															echo "selected='selected'";
														}
														echo $mb->ac; ?> value="0">Tidak Tersedia</option>
									</select>
									<?= form_error('ac', '<div class="text-small text-danger">', '</div>') ?>
								</div>

								<div class="form-group">
									<label for="">Makanan</label>
									<select name="sopir" id="" class="form-control">
										<option <?php if ($mb->makanan == "1") {
															echo "selected='selected'";
														}
														echo $mb->makanan; ?> value="1">Tersedia</option>
										<option <?php if ($mb->makanan == "0") {
															echo "selected='selected'";
														}
														echo $mb->makanan; ?> value="0">Tidak Tersedia</option>
									</select>
									<?= form_error('sopir', '<div class="text-small text-danger">', '</div>') ?>
								</div>

								<div class="form-group">
									<label for="">MP3 Player</label>
									<select name="mp3_player" id="" class="form-control">
										<option <?php if ($mb->mp3_player == "1") {
															echo "selected='selected'";
														}
														echo $mb->mp3_player; ?> value="1">Tersedia</option>
										<option <?php if ($mb->mp3_player == "0") {
															echo "selected='selected'";
														}
														echo $mb->mp3_player; ?> value="0">Tidak Tersedia</option>
									</select>
									<?= form_error('mp3_player', '<div class="text-small text-danger">', '</div>') ?>
								</div>

								<div class="form-group">
									<label for=""> Central Lock</label>
									<select name="central_lock" id="" class="form-control">
										<option <?php if ($mb->central_lock == "1") {
															echo "selected='selected'";
														}
														echo $mb->central_lock; ?> value="1">Tersedia</option>
										<option <?php if ($mb->central_lock == "0") {
															echo "selected='selected'";
														}
														echo $mb->central_lock; ?> value="0">Tidak Tersedia</option>
									</select>
									<?= form_error('central_lock', '<div class="text-small text-danger">', '</div>') ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Tahun</label>
									<input type="text" name="tahun" class="form-control" value="<?= $mb->tahun ?>">
									<?= form_error('tahun', '<div class="text-small text-danger">', '</div>') ?>
								</div>

								<!-- <div class="form-group">
									<label for="">Harga</label>
									<input type="number" name="harga" class="form-control" value="<?= $mb->harga ?>">
									<?= form_error('harga', '<div class="text-small text-danger">', '</div>') ?>
								</div> -->
								<!-- <div class="form-group">
									<label for="">Denda</label>
									<input type="number" name="denda" class="form-control" value="<?= $mb->denda ?>">
									<?= form_error('denda', '<div class="text-small text-danger">', '</div>') ?>
								</div> -->

								<div class="form-group">
									<label for="">Status</label>
									<select name="status" id="" class="form-control">
										<option <?php if ($mb->status == "1") {
															echo "selected='selected'";
														}
														echo $mb->status; ?> value="1">Tersedia</option>
										<option <?php if ($mb->status == "0") {
															echo "selected='selected'";
														}
														echo $mb->status; ?> value="0">Tidak Tersedia</option>
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

				<?php endforeach; ?>
			</div>
		</div>

	</section>
</div>