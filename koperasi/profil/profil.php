<?php 

session_start();
require '../function/function.php';

if( !isset($_SESSION["login"]) ){
	header("Location: ../login/loginu.php");
	exit;
}

// ambi data 
$id = $_SESSION["id"];
$nik = $_SESSION["nik"];
$data = mysqli_query($conn, "SELECT * FROM anggota WHERE id = '$id'");
$bawa = mysqli_fetch_assoc($data);

$ttl = $bawa["tempat_lahir"] . ", " . $bawa["tanggal_lahir"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profil Saya</title>
	<link rel="stylesheet" href="profil.css">
</head>
<body>

	<div class="container">
		<div class="header">
			<h1 class="judul">MY PROFIL</h1>
		</div>
		<div class="tabel">
			<table>
				<tr>
					<td>NIK :</td>
					<td><?= $bawa["nik_anggota"]; ?></td>
				</tr>
				<tr>
					<td>Nama :</td>
					<td><?= $bawa["nama"]; ?></td>
				</tr>
				<tr>
					<td>Jenis Kelamin :</td>
					<td><?= $bawa["jenis_kelamin"]; ?></td>
				</tr>
				<tr>
					<td>Agama :</td>
					<td><?= $bawa["agama"]; ?></td>
				</tr>
				<tr>
					<td>TTL :</td>
					<td><?= $ttl; ?></td>
				</tr>
				<tr>
					<td>Alamat :</td>
					<td><?= $bawa["alamat"]; ?></td>
				</tr>
			</table>
		</div>

		<div class="footer">
			<a href="../index.php"><button>Kembali</button></a>
		</div>

	</div>

</body>
</html>