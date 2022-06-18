<?php

session_start();

if( isset($_SESSION["login"]) ){
	header("Location: ../index/indexa.php");
	exit;
}

require '../function/function.php';

if ( isset($_POST["regist"]) ) {
	if ( registrasi($_POST) === 1 ) {
		echo "<script>
				alert('User Baru Berhasil Ditambahkan!')
			  </script)";
		header("Location: ../login/logina.php");
		exit;
	} else {
		echo mysqli_error($conn);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi Admin</title>
	<link rel="stylesheet" href="registrasia.css">
</head>
<body>
	
<div class="container">

	<div class="header">
		<h1 class="judul">Halaman Registrasi Admin</h1>
	</div>

	<div class="main">
	<form action="" method="post">
		
		<ul>
			<li>
				<label class="kdpeg" for="kd_pegawai">Kode Pegawai :</label>
				<input type="text" name="kd_pegawai" id="kd_pegawai">
			</li>
			<li>
				<label class="pas" for="password">Password :</label>
				<input type="password" name="password" id="password">
			</li>
			<li>
				<label class="pass" for="kompass">Konfirmasi Password :</label>
				<input type="password" name="kompass" id="kompass">
			</li>
			<li>
				<button class="breg" type="submit" name="regist">Registrasi!</button>
			</li>
		</ul>

	</form>
	</div>
</div>
</body>
</html>