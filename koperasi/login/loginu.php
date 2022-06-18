<?php
session_start();
require '../function/function.php';

//cek cookie
if ( isset($_COOKIE['be']) && isset($_COOKIE['quiet'])) {
	$be = $_COOKIE['be'];
	$quiet = $_COOKIE['quiet'];

	//ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM anggota WHERE id = $be");
	$row = mysqli_fetch_assoc($result);

	//cek cookie dan username
	if( $quiet === hash('fnv1a32', $row['username']) ) {
		$_SESSION['login'] = true;
	}
}

if( isset($_POST["registrasi"]) ){
	header("Location: ../registrasi/registrasiu.php");
	exit;
}

if( isset($_SESSION["login"]) ){
	header("Location: ../index.php");
	exit;
}

if(isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM anggota WHERE username = '$username'");

	//cek username
	if(mysqli_num_rows($result) === 1 ) {
		
		//cek password
		$row = mysqli_fetch_assoc($result);
			
		if( password_verify($password, $row["password"]) ) {
			//set session
			$_SESSION["id"] = $row["id"];
			$_SESSION["nama"] = $row["nama"];
			$_SESSION["nik"] = $row["nik_anggota"];
			$_SESSION["gambar"] = $row["gambar"];

			$_SESSION["login"] = true;
				//cek remember me
			setcookie('be', $row["id"], time()+1);
			setcookie('quiet', hash('fnv1a32', $row["username"]), time()+1);
			header("Location: ../index.php");
			exit;

			}
	
	}

	$error = true;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
	<link rel="stylesheet" href="loginu.css">
</head>
<body>

<div class="container">

<div class="header">
	<h1 class="judul">Halaman Login</h1>
</div>

<div class="main">

<?php if (isset($error)) : ?>
	<p style="color: red; font-style: italic;">Username / Password Salah!</p>
<?php endif; ?>

<form class="login" action="" method="post">
	<ul>
		<li>
			<label class="nm" for="username">Username :</label>
			<input class="nam" type="text" name="username" id="username" autocomplete="off">
		</li>
		<li>
			<label class="pas" for="password">Password  :</label>
			<input class="pass" type="password" name="password" id="password">
		</li>
		<li>
			<input class="chbox" type="checkbox" name="remember" id="remember">
			<label class="rememember" for="remember">Ingat Saya</label>
		</li>
		<li>
			<button class="blogin" type="submit" name="login">Login</button>
			<button class="bregis" type="submit" name="registrasi">Registrasi</button>
		</li>
	</ul>	
</form>

</div>

<div  class="footer"> <a class="saluse" href="logina.php">Masuk Sebagai Admin</a></div>

</div>

</body>
</html>