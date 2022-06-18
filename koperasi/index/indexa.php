<?php

session_start();

if( !isset($_SESSION["login"]) ){
	header("Location: ../login/logina.php");
	exit;
}

require '../function/function.php';

$id = $_SESSION["id"];
$nama = $_SESSION["nama"];
$gambar = $_SESSION["gambar"];

$anggota = query("SELECT * FROM anggota");

// apakah tombol cari ditekan
if( isset($_POST["cari"]) ) {
	$anggota = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
	<link rel="stylesheet" href="indexa.css">
</head>
<body>

<div class="topbar">
	
	<form action="" method="post">
	<div class="dp" id="dp">
		<a href="../profil/profila.php">
			<img src="../img/<?= $gambar; ?>">
		</a>
	</div >
	<label for="dp"><?= $nama; ?></label>
	<a class="keluar" href="../logout/logout.php" onclick="return confirm('Apakah Anda Yakin Ingin Keluar ???')">Logout</a>
	</form>

</div>

<div class="container">
	<div class="header">
		<h1 class="judul">Daftar Anggota Koperasi</h1>
	</div>

	<div class="tools">
		<a href="../tambah/tambah.php">Tambah Data Anggota</a>
		<form action="" method="post">
			<input type="text" name="keyword" size="30" autofocus placeholder="Masukkan Kata Kunci Pencarian" autocomplete="off">
			<button type="submit" name="cari">Cari!</button>
		</form>
	</div>

	<br>
	<div class="main">
	
	<table class="tabel">
		
		<tr class="judul-baris">			
			<th>No.</th>
			<th>Gambar</th>
			<th>NIK</th>
			<th>Nama</th>
			<th>No HP</th>
			<th>Aksi</th>		
		</tr>

		<?php $i = 1; ?>
		<?php foreach ($anggota as $row) : ?>
		<?php if( $i % 2 == 0) : ?>
		<tr class="warna-barisb">
		<?php else : ?>
		<tr class="warna-bariss">
		<?php endif ?>
			<td><?= $i ?></td>
			<td>
				<div class="foto">
				<a href="../prodil/profil.php?ur=<?= $row["id"]; ?>">
				<img src="../img/<?= $row["gambar"]; ?>" width="50">
				</a>
				</div>
			</td>
			<td>
				<div class="nik">
				<?= $row["nik_anggota"]; ?>
				</div>
			</td>
			<td>
				<div class="nama">
				<?= $row["nama"] ?>
				</div>
			</td>
			<td>
				<div class="no">
				<?= $row["no_hp"] ?>
				</div>
			</td>
			<form action="" method="post">
			<td>
				<a href="../ubah/ubah.php?ur=<?= $row['id']?>">Ubah
				</a>
				<a href="../hapus/hapus.phpur=<?= $row['id']?>" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Data Anggota Ini ???')">Hapus</a>
			</td>
			</form>
		</tr>
		<?php $i++; ?>		
		<?php endforeach; ?>
	</table>
	</div>
</div>
</body>
</html>