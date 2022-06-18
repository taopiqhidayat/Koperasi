<?php

$conn = mysqli_connect("localhost", "root", "", "db_koperasi");

function query($query) {
	global $conn;
	// ambil data dari tabel di database
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

	$tgl = date("dmy");
	$bar = mysqli_query($conn, "SELECT * FROM transaksi");
	$jumbar = mysqli_num_rows($bar);
	$hbar = $jumbar + 1;
	echo $hbar;
	$kd_trans = $tgl . $hbar;
	echo $kd_trans;
?>