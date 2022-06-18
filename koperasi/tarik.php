<?php 

session_start();
require 'function/function.php';

if( !isset($_SESSION["login"]) ){
	header("Location: ../login/loginu.php");
	exit;
}

$id = $_GET["ur"];
$nik = $_SESSION["nik"];

if( isset($_POST["transaksi"]) ) {
	
	// cek data berhasi ditambah atau tidak
	if( tarik($_POST) > 0 ) {
		echo "
			<script>
				alert('Transaksi Berhasil Dilakukan!');
				document.location.href = 'index.php'
			</script>
		";
	} else {
		echo "
			<script>
				alert('Transaksi Gagal Dilakukan!');
			</script>
		";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Penarikan Simpanan</title>
	<link rel="stylesheet" href="tarik.css">
</head>
<body>

	<div class="container">
		<form action="" method="post">
			<div class="header">
				<h3 class="judul">Silahkan Masukkan Nominal yang Akan Anda Tarik</h3>
			</div>

			<div class="main">
				<ul>
					<li>
						<input type="hidden" name="nik" value="<?= $nik; ?>">
						<label class="nom">Nominal :</label>
						<input class="isi" type="text" name="nominal">
					</li>
				</ul>
			</div>

			<div class="footer">
				<button type="submit" name="transaksi">Transaksi!</button>
				<button type="submit" name="batal">Batal!</button>
			</div>
		</form>
	</div>

</body>
</html>