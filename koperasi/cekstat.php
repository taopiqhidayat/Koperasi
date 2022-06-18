<?php

session_start();

if( !isset($_SESSION["login"]) ){
	header("Location: ../login/loginu.php");
	exit;
}

require 'function/function.php';
$id = $_GET["ur"];
$nik = $_SESSION["nik"]
?>

<!DOCTYPE html>
<html>
<head>
	<title>Status Keuangan</title>
	<link rel="stylesheet" href="cekstat.css">
</head>
<body>

	<div class="container">
		
		<div class="header">
			<h1 class="judul">Status Keuangan Saya</h1>
		</div>

		<div class="main">
			<?php 
			$result = mysqli_query($conn, "SELECT * FROM keuangan WHERE nik = '$nik'");
			$cek = mysqli_fetch_assoc($result);

			?>
			<?php if($cek) : ?>
			<table class="tabel" border="1" cellpadding="10" cellspacing="0">
				<tr char="judul-baris">
					<th>No.</th>
					<th>Saldo</th>
					<th>Pinjaman</th>
				</tr>

				<tr>
					<th></th>
					<th>Saldo</th>
					<th>Tarik</th>
					<th>Sisa Saldo</th>
					<th>Total Saldo</th>
					<th>Pinjaman</th>
					<th>Bayar</th>
					<th>Sisa Bayar</th>
					<th>Lama Bayar</th>
				</tr>

				<?php $i = 1; ?>
				<?php foreach ($result as $row) : ?>

				<tr>
					<td><?= $i; ?></td>
					<td><?= $row["saldo"]; ?></td>
					<td><?= $row["tarik"]; ?></td>
					<td><?= $row["sisa_saldo"]; ?></td>
					<td><?= $row["total_saldo"]; ?></td>
					<td><?= $row1["pinjam"]; ?></td>
					<td><?= $row1["bayar"]; ?></td>
					<td><?= $row1["sisa_bayar"]; ?></td>
					<td><?= $row1["lama_bayar"]; ?></td>
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