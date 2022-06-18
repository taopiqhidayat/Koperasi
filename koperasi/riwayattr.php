<?php

session_start();

if( !isset($_SESSION["login"]) ){
	header("Location: ../login/loginu.php");
	exit;
}

require 'function/function.php';

$id = $_GET["ur"];
$nik = $_SESSION["nik"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Riwayat Transaksi</title>
	<link rel="stylesheet" href="riwayattr.css">
</head>
<body>

	<div class="container">
		
		<div class="header">
			<h1 class="judul">Riwayat Transaksi Saya</h1>
		</div>

		<div class="main">
			<?php 
			$result = mysqli_query($conn, "SELECT * FROM transaksi WHERE nik = '$nik'");
			$cek = mysqli_fetch_assoc($result);

			?>
			<?php if($cek) : ?>
			<table class="tabel" border="1" cellpadding="10" cellspacing="0">
				<tr char="judul-baris">
					<th>No.</th>
					<th>Kode Transaksi</th>
					<th>Tanggal Transaksi</th>
					<th>Simpan</th>
					<th>Tarik</th>
					<th>Pinjam</th>
					<th>Bayar</th>
				</tr>
				<?php $i = 1; ?>
				<?php foreach ($result as $row) : ?>
				<tr>
					<td><?= $i; ?></td>
					<td><?= $row["kode_transaksi"]; ?></td>
					<td><?= $row["tanggal_transaksi"]; ?></td>
					<td><?= $row["simpan"]; ?></td>
					<td><?= $row["tarik"]; ?></td>
					<td><?= $row["pinjam"]; ?></td>
					<td><?= $row["bayar"]; ?></td>
				</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
			</table>
			<?php endif; ?>
		</div>

		<div class="footer">
			
		</div>

	</div>

</body>
</html>