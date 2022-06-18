<?php 

session_start();
require '../function/function.php';

if( !isset($_SESSION["login"]) ){
	header("Location: ../login/logina.php");
	exit;
}

// tombol kembali
// if( isset($_POST["batal"]) ) {
// 	tambah($_POST) = false;
// 	header("Location : ../index/index.php");
// 	exit;
// }

// cek ke database

// cek tombol tambah ditekan belum
if( isset($_POST["tambah"]) ) {
	
	// cek data berhasi ditambah atau tidak
	if( tambah($_POST) > 0 ) {
		echo "
			<script>
				alert('Data Anggota Berhasil Ditambahkan!');
				document.location.href = '../index/indexa.php'
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Anggota Gagal Ditambahkan!');
			</script>
		";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Anggota</title>
	<link rel="stylesheet" href="tambah.css">
</head>
<body>
	<div class="container">

		<div class="header">
		<h1 class="judul">Tambah Data Anggota</h1>
		</div>

		<div class="main">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="tabel">
			<table>
				<tr>
					<td class="nik"><label for="nik">NIK :</label></td>
					<td><input type="text" name="nik" id="nik" required></td>
				</tr>
				
				<tr>
					<td><label for="nama">Nama :</label></td>
					<td><input type="text" name="nama" id="nama" required></td>
				</tr>
				
				<tr>
					<td><label for="jk">Jenis Kelamin :</label></td>
					<td><input type="text" name="jk" id="jk" required></td>
				</tr>
				
				<tr>
					<td><label for="agama">Agama :</label></td>
					<td><input type="text" name="agama" id="agama" required></td>
				</tr>
				
				<tr>
					<td><label for="temlahir">Tempat Lahir :</label></td>
					<td><input type="text" name="temlahir"></td>
				</tr>
				
				<tr>
					<td><label for="tanglahir">Tanggal Lahir :</label></td>
					<td><input type="text" name="tanglahir" id="tanglahir"></td>
				</tr>
				
				<tr>
					<td><label for="alamat">Alamat :</label></td>
					<td><input type="text" name="alamat" id="alamat"></td>
				</tr>
				
				<tr>
					<td><label for="email">Email :</label></td>
					<td><input type="text" name="email" id="email"></td>
				</tr>
				
				<tr>
					<td><label for="nohp">No HP</label></td>
					<td><input type="text" name="no_hp" id="nohp" required></td>
				</tr>
			</table>
			</div>
				
				<table>
				<tr>
					<td><label for="gambar">Foto :</label></td>
					<td><input type="file" name="gambar" id="gambar" required></td>
				</tr>
				</table>
				<br>
				<button class="btambah" type="tambah" name="tambah">Tambah!</button><!-- <button type="submit" name="batal">Batal</button> -->

		</form>
		</div>
	</div>
</body>
</html>