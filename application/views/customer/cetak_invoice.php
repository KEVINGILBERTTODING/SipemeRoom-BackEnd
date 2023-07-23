<table style="width: 40%;">
	<h2>Invoice Pemesanan Anda</h2>
	<?php foreach ($transaksi as $tr) : ?>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?= $tr->nama; ?></td>
		</tr>

		<tr>
			<td>Ruangan</td>
			<td>:</td>
			<td><?= $tr->nama_ruangan; ?></td>
		</tr>
		<tr>
			<td>Tanggal Sewa</td>
			<td>:</td>
			<td><?= date('d/m/Y', strtotime($tr->tgl_sewa)); ?></td>
		</tr>
		<tr>
			<td>Tanggal Selesai Sewa</td>
			<td>:</td>
			<td><?= date('d/m/Y', strtotime($tr->tgl_kembali)); ?></td>
		</tr>
		<!--<tr>
      <td>Biaya Sewa Perhari</td>
      <td>:</td>
      <td>Rp.<?= number_format($tr->harga, 0, ',', '.'); ?>,-</td>
    </tr>-->
		<tr>
			<?php
			$x = strtotime($tr->tgl_kembali);
			$y = strtotime($tr->tgl_sewa);
			$jmlHari = abs(($x - $y) / (60 * 60 * 24));
			?>
			<td>Jumlah Hari Sewa</td>
			<td>:</td>
			<td><?= $jmlHari; ?> Hari</td>
		</tr>

		<tr>
			<td>Status Persetujuan</td>
			<td>:</td>
			<td style="font-weight:bold; color:red;">
				<?php if ($tr->status_apr == '0') {
					echo "Belum Disetujui";
				} else {
					echo "Disetujui";
				} ?>
			</td>
		</tr>

		<!--<tr style="font-weight:bold; color:red;">
      <td>JUMLAH PEMBAYARAN</td>
      <td>:</td>
      <td>Rp.<?= number_format($tr->harga * $jmlHari, 0, ',', '.'); ?>,-</td>
    </tr>-->

		<tr>
			<td>Pihak Terkait Persetujuan</td>
			<td>:</td>
			<td>
				<ul>
					<li>Zaenal Abidin 085318765890</li>
					<li>Ronyani Nugroho 081434523167</li>
					<li>Rahmani Slamet 081533780965</li>
				</ul>
			</td>
		</tr>
	<?php endforeach; ?>
</table>

<script>
	window.print();
</script>