<?php 

session_start();
require '../function/function.php';

if( !isset($_SESSION["login"]) ){
	header("Location: ../login/logina.php");
	exit;
}

// tombol kembali
// if( isset($_POST["batal"]) ) {
// 	ubah($_POST) = false;
// 	header("Location : ../index/index.php");
// 	exit;
// }

// cek ke database

// ambi data id di url
$id = $_GET["ur"];

// query data anggta berdasarkan id
$ang = query("SELECT * FROM anggota WHERE id = '$id'")[0];

// cek tombol ubah ditekan belum
if( isset($_POST["ubah"]) ) {
	
	// cek data berhasi diubah
	if( ubah($_POST) > 0 ) {
		echo "
			<script>
				alert('Data Anggota Berhasil Diubah!');
				document.location.href = '../index/indexa.php'
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Anggota Gagal Diubah!');
			</script>
		";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Ubah Data Anggota</title>
	<link rel="stylesheet" href="ubah.css">
</head>
<body>
	<div class="container">

		<div class="header">
		<h1 class="judul">Ubah Data Anggota</h1>
		</div>

		<div class="main">
		<form action="" method="post">
			<input type="hidden" name="id" value="<?= $ang["id"]; ?>">	
			<input type="hidden" name="gmbrdlu" value="<?= $ang["gambar"]; ?>">
			<div class="tabel">
			<table>
				<tr>
					<td><label for="nik">NIK :</label></td>
					<td><input type="text" name="nik" id="nik" required value="<?= $ang["nik_anggota"]; ?>"></td>
				</tr>
				
				<tr>
					<td><label for="nama">Nama :</label></td>
					<td><input type="text" name="nama" id="nama" required value="<?= $ang["nama"]; ?>"></td>
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
					<td><input type="text" name="tanglahir"></td>
				</tr>
				
				<tr>
					<td><label for="alamat">Alamat :</label></td>
					<td><input type="text" name="alamat"></td>
				</tr>
				
				<tr>
					<td><label for="email">Email :</label></td>
					<td><input type="text" name="email"></td>
				</tr>
				
				<tr>
					<td><label for="nohp">No HP</label></td>
					<td><input type="text" name="no_hp" id="nohp" required value="<?= $ang["no_hp"]; ?>"></td>
				</tr>
			</table>
			</div>

			<div class="upl">
			<ul class="upload">
				<li>
					<img src="../img/<?=$ang["gambar"]; ?>" width="40px">
					<label for="gambar">Ganti Foto :</label>
					<input type="file" name="gambar" id="gambar" required>
				</li>
			</ul>
			</div>

				<button class="bubah" type="ubah" name="ubah">Ubah!</button><!-- <button type="submit" name="batal">Batal</button> -->
			
		</form>
		</div>
	</div>
</body>
</html>