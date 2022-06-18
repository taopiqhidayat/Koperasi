<?php

session_start();

if( isset($_SESSION["login"]) ){
	header("Location: ../index.php");
	exit;
}

require '../function/function.php';

if ( isset($_POST["regist"]) ) {
	if ( registrasiu($_POST) === 1 ) {
		echo "<script>
				alert('User Baru Berhasil Ditambahkan!')
			  </script)";
		header("Location: ../login/loginu.php");
		exit;
	} else {
		echo mysqli_error($conn);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi</title>
	<link rel="stylesheet" href="registrasiu.css">
</head>
<body>
	
<div class="container">

	<div class="header">
	<h1 class="judul">Halaman Registrasi</h1>
	</div>

	<div class="main">
	<form action="" method="post">
		
		<ul>
			<li>
				<label class="nik" for="nik">Nomor Induk (NIK) :</label>
				<input type="text" name="nik" id="nik">
			</li>
			<li>
				<label class="usnem" for="username">Username :</label>
				<input type="text" name="username" id="username">
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