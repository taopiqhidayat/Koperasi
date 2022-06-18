<?php
session_start();
require '../function/function.php';

//cek cookie
if ( isset($_COOKIE['be']) && isset($_COOKIE['quiet'])) {
	$be = $_COOKIE['be'];
	$quiet = $_COOKIE['quiet'];

	//ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM admin WHERE id = $be");
	$row = mysqli_fetch_assoc($result);

	//cek cookie dan username
	if( $quiet === hash('fnv1a32', $row['username']) ) {
		$_SESSION['login'] = true;
	}
}

if( isset($_POST["registrasi"]) ){
	header("Location: ../registrasi/registrasia.php");
	exit;
}

if( isset($_SESSION["login"]) ){
	header("Location: ../index/indexa.php");
	exit;
}

if(isset($_POST["login"])) {
	$kd_pegawai = $_POST["kd_pegawai"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM admin WHERE kd_pegawai = '$kd_pegawai'");
	
	//cek username
	if(mysqli_num_rows($result) === 1 ) {
		
		//cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {
			//set session
					
			$_SESSION["id"] = $row["id"];
			$_SESSION["nama"] = $row["nama"];
			$_SESSION["nik"] = $row["nik_pegawai"];
			$_SESSION["gambar"] = $row["gambar"];

			$_SESSION["login"] = true;

			//cek remember me
			setcookie('be', $row["id"], time()+1);
			setcookie('quiet', hash('fnv1a32', $row["username"]), time()+1);

			$_GET["ur"] = $row["id"];
			header("Location: ../index/indexa.php");
			exit;

		}
	}

	$error = true;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login Admin</title>
	<link rel="stylesheet" href="logina.css">
</head>
<body>

<div class="container">

<div class="header">
	<h1 class="judul">Halaman Login Admin</h1>
</div>

<div class="main">

<?php if (isset($error)) : ?>
	<p style="color: red; font-style: italic;">Username / Password Salah!</p>
<?php endif; ?>

<form class="login" action="" method="post">
	<ul>
		<li>
			<label class="kdpeg" for="kd_pegawai">Kode Pegawai :</label>
			<input class="kd_peg" type="text" name="kd_pegawai" id="kd_pegawai" autocomplete="off">
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

<div  class="footer"> <a class="saluse" href="loginu.php">Masuk Sebagai Anggota</a></div>

</div>

</body>
</html>