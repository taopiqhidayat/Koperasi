<?php

session_start();

if( !isset($_SESSION["login"]) ){
	header("Location: ../login/login.php");
	exit;
}

require '../function/function.php';

$id = $_GET["ur"];

if( hapus($id) > 0 ) {
	echo "
			<script>
				alert('Data Berhasil Dihapus!');
				document.location.href = '../index/indexa.php'
			</script>	
		";
} else {
	echo "
			<script>
				alert('Data Gagal Dihapus!');
				document.location.href = '../index/indexa.php'
			</script>
		";
}

?>