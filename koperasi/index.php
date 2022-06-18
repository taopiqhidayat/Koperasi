<?php

session_start();

if( !isset($_SESSION["login"]) ){
	header("Location: login/loginu.php");
	exit;
}

require 'function/function.php';
$id = $_SESSION["id"];
$nik = $_SESSION["nik"];
$nama = $_SESSION["nama"];
$gambar = $_SESSION["gambar"];

// apakah tombol cari ditekan
if( isset($_POST["cari"]) ) {
	$anggota = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Utama</title>
	<link rel="stylesheet" href="index.css">
</head>
<body>
	<form action="" method="post">
		<div class="topbar">
			<div class="foto">
				<a href="profil/profil.php?ur=<?= $id; ?>">
					<img src="img/<?= $gambar; ?>">
				</a>
			</div>
			<label class="nama" for="foto"><?= $nama; ?></label>
			<div class="menu">
			<a href="#">Home</a>
			<a href="riwayattr.php?ur=<?= $id; ?>">Riwayat Transaksi</a>
			<a href="cekstat.php?ur=<?= $id; ?>">Cek Status</a>
			<a href="simpan.php?ur=<?= $id; ?>">Simpan</a>
			<a href="tarik.php?ur=<?= $id; ?>">Tarik Simpanan</a>
			<a href="mohonpin.php?ur=<?= $id; ?>">Permohonan Pinjaman</a>
			<a href="baypin.php?ur=<?= $id; ?>">Bayar Pinjaman</a>
			</div>
			<a class="keluar" href="logout/logoutu.php" onclick="return confirm('Apakah Anda Yakin Ingin Keluar ???')">Logout</a>
			
		</div>
	</form>

		<div class="container">
			<div class="header">
				<h1 class="judul">Selamat Datang <?= $nama; ?> Di Koperasi Kami</h1>
			</div>
			<div class="hallo">
					<p>Terimakasih telah menggunakan aplikasi Kami dan mempercayai Koperasi Kami. Dengan menjadi anggota koperasi Anda telah memiliki kesempatan untuk bisa menabung uang di koperasi dengan bunga yang lebih kecil daripada bunga di bank. Serta memberikan Anda peluang untuk mendapatkan pinjaman bagi modal usaha Anda dalam berimpestasi. Silahkan gunakan aplikasi ini dengan benar dan sejujurnya. Jika ada keluhan pada aplikasi ini silahkan hubungi kami. Semoga Anda dapat betah dengan aplikasi ini dan dapat bertahan dengan koperasi kami</p>
				</div>
			<div class="main">
				<?php
				$tanggal = date("Y-m-d");
				$result = mysqli_query($conn, "SELECT * FROM transaksi WHERE nik = '$nik' AND tanggal_transaksi = '$tanggal'");
				$cek = mysqli_fetch_assoc($result);
				?>
				<?php if ($cek) : ?>
					
				<table class="tabel">
					<tr>
						<th>No.</th>
						<th>Simpan</th>
						<th>Tarik</th>
						<th>Pinjam</th>
						<th>Bayar</th>
					</tr>

				<?php $i = 1; ?>
				<?php foreach ($result as $row) : ?>

					<tr>
						<td><?= $i; ?></td>
						<td>
							<div class="simpan">
								<?= $row["simpan"]; ?>
							</div>
						</td>
						<td>
							<div class="tarik">
								<?= $row["tarik"]; ?>
							</div>
						</td>
						<td>
							<div class="pinjam">
								<?= $row["pinjam"]; ?>
							</div>
						</td>
						<td>
							<div class="bayar">
								<?= $row["bayar"]; ?>
							</div>
						</td>
					</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
				</table>
				<?php endif; ?>
				
			</div>

		</div>

</body>
</html>