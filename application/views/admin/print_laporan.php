<h3 style="text-align: center;">Laporan Transaksi Sewa Ruangan</h3>

<table>
	<tr>
		<td>Dari Tanggal</td>
		<td>:</td>
		<td><?= $dari ?></td>
	</tr>
	<tr>
		<td>Sampai Tanggal</td>
		<td>:</td>
		<td><?= $sampai; ?></td>
	</tr>
</table>

<table class="table table-bordered table-striped mt-3">
	<tr>
		<th>No</th>
		<th>Customer</th>
		<th>Ruangan</th>
		<th>Tgl. Sewa</th>
		<th>Tgl. Selesai sewa</th>
		<th>Tgl. Selesai</th>
		<th>Status Selesai</th>
		<th>Status Sewa</th>
	</tr>

	<?php
	$no = 1;
	foreach ($laporan as $tr) : ?>
		<tr>
			<td><?= $no++; ?></td>
			<td><?= $tr->nama; ?></td>
			<td><?= $tr->nama_ruangan; ?></td>
			<td><?= date('d/m/Y', strtotime($tr->tgl_sewa)); ?></td>
			<td><?= date('d/m/Y', strtotime($tr->tgl_kembali)); ?></td>
			<td>
				<?php if ($tr->tgl_pengembalian == "0000-00-00") {
					echo "-";
				} else {
					echo date('d/m/Y', strtotime($tr->tgl_pengembalian));
				} ?>
			</td>

			<td>
				<?php if ($tr->status_apr == "1") {
					echo "Kembali";
				} else {
					echo "Belum Kembali";
				} ?>
			</td>


			<td>
				<?php if ($tr->status_apr == "1") {
					echo "Selesai";
				} else {
					echo "Belum Selesai";
				} ?>
			</td>
		</tr>

	<?php endforeach; ?>
</table>

<script>
	window.print();
</script>