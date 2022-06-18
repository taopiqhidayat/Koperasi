<?php
// Koneksi Database
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



function tambah($data) {
	global $conn;

	$nik = htmlspecialchars($data['nik']);
	$nama = htmlspecialchars($data['nama']);
	$jk = htmlspecialchars($data['jk']);
	$agama = htmlspecialchars($data['agama']);
	$temlahir = htmlspecialchars($data['temlahir']);
	$tglahir = htmlspecialchars($data['tanglahir']);
	$alamat = htmlspecialchars($data['alamat']);
	$email = htmlspecialchars($data['email']);
	$nohp = htmlspecialchars($data['no_hp']);
	
	// upload gambar
	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	// query insert data
	$query = "INSERT INTO anggota
				VALUES
				('', '$nik', '$nama', $jk, $agama, $temlahir, $tglahir, $alamat, $email, '$nohp', '$gambar')
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn); 
}



function upload() {
	$namafile = $_FILES['gambar']['name'];
	$ukuranfile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek gambar tidak diupload
	if ( $error === 4 ) {
		echo "<script>
				alert('Pilih Gambar Terlebih Dahulu')
			 </script>";
		return false;
	}

	// cek yg diupload adalh gambar
	$eksgamval = ['jpg', 'jpeg', 'png'];
	$eksgam = explode('.', $namafile);
	$eksgam = strtolower( end($eksgam) );
	if( !in_array( $eksgam, $eksgamval ) ) {
		echo "<script>
				alert('File Yang Anda Upload Bukan Gambar')
			 </script>";
		return false;
	}

	//cek ukuran gambar
	// if( $ukuranfile > 15000000 ) {
	// 	echo "<script>
	// 			alert('File Yang Anda Upload Terlalu Besar')
	// 		 </script>";
	// 	return false;
	// } 

	// jika lolos
	// generate nama gambar baru
	$namafilebaru = uniqid();
	$namafilebaru .= '.';
	$namafilebaru .= $eksgam;

	move_uploaded_file($tmpName, '../img/' . $namafilebaru);

	return $namafilebaru; 
}



function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM anggota WHERE id = $id");
	return mysqli_affected_rows($conn);
}



function ubah($data) {
	global $conn;

	$id = $data["id"];
	$nik = htmlspecialchars($data['nik']);
	$nama = htmlspecialchars($data['nama']);
	$jk = htmlspecialchars($data['jk']);
	$agama = htmlspecialchars($data['agama']);
	$temlahir = htmlspecialchars($data['temlahir']);
	$tglahir = htmlspecialchars($data['tanglahir']);
	$alamat = htmlspecialchars($data['alamat']);
	$email = htmlspecialchars($data['email']);
	$nohp = htmlspecialchars($data['no_hp']);
	
	// upload gambar
	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	// query insert data
	$query = "UPDATE anggota SET
				nik = '$nik_anggota',
				nama = '$nama',
				jenis_kelamin = $jk,
				agama = $agama,
				tempat_lahir = $temlahir,
				tanggal_lahir = $tglahir,
				alamat = $alamat,
				email= $email,
				no_hp = '$nohp',
				gambar = '$gambar'
			  WHERE id = $id
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn); 
}



function cari($keyword) {
	$query = "SELECT * FROM anggota
				WHERE
			  nama LIKE '%$keyword%' OR
			  nik_anggota LIKE '%$keyword%' OR
			  no_hp LIKE '%$keyword%'
			 ";
	return query($query);
}



function registrasi($data) {
	global $conn;

	$kd_pegawai = strtolower($data["kd_pegawai"]);
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$kompass = mysqli_real_escape_string($conn, $data["kompass"]);

	//cek username isi gak
	$rslt = mysqli_query($conn, "SELECT password FROM admin WHERE kd_pegawai = 'kd_pegawai'");
	if ( mysqli_fetch_assoc($rslt) ) {
		echo "<script>
				alert('Mohon Maaf Anda sudah memiliki akun sebelumnya!. Silahkan cek kembai Kode Pegawai yang Anda gunakan!')
			  </script>";
		return false;
	}

	//cek konfirmasi password sesuai
	if( $password !== $kompass) {
		echo "<script>
				alert('Konfirmasi Password Tidak Sesuai!');
			  </script>";
		return false;

	}

	//enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	//tambahkan ke database
	mysqli_query($conn, "UPDATE admin SET
					password = '$password'
				WHERE kd_pegawai = '$kd_pegawai'");

	return 1;
	return mysqli_affected_rows($conn);
}



function registrasiu($data) {
	global $conn;

	$nik = strtolower($data["nik"]);
	$username = strtolower($data["username"]);
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$kompass = mysqli_real_escape_string($conn, $data["kompass"]);

	//cek username isi gak
	$rslt = mysqli_query($conn, "SELECT username FROM anggota WHERE nik_anggota = 'nik'");
	if ( mysqli_fetch_assoc($rslt) ) {
		echo "<script>
				alert('Mohon Maaf NIK yang Anda gunakan sudah memiiki akun!. Silahkan cek kembai NIK yang Anda gunakan!')
			  </script>";
		return false;
	}

	//cek username sudah dipakai belum
	$result = mysqli_query($conn, "SELECT username FROM anggota WHERE username = '$username'");

	if ( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('Mohon Maaf Username Sudah Terdaftar!')
			  </script>";
		return false;
	}

	//cek konfirmasi password sesuai
	if( $password !== $kompass) {
		echo "<script>
				alert('Konfirmasi Password Tidak Sesuai!');
			  </script>";
		return false;

	}

	//enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	//tambahkan ke database
	mysqli_query($conn, "UPDATE anggota SET
					username ='$username',
					password = '$password'
				WHERE nik_anggota = '$nik'
				");

	return 1;
	return mysqli_affected_rows($conn);
}



function simpan($data) {
	global $conn;

	$nik = $data['nik'];
	$simpan = $data['nominal'];
	$tanggal = date("Y-m-d");

	// kode transaksi
	$tgl = date("ymd");
	$bar = mysqli_query($conn, "SELECT * FROM transaksi");
	$jumbar = mysqli_num_rows($bar);
	$hbar = $jumbar + 1;
	$kd_trans = $tgl . $hbar;
	
	// query insert data
	$query = "INSERT INTO transaksi
				VALUES
				('', '$kd_trans', '$nik', '$tanggal', '$simpan', '', '', '', '')
			 ";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

	$result = mysqli_query($conn, "SELECT saldo FROM keuangan WHERE nik = '$nik'");

	$salaw = mysqli_fetch_assoc($result);
	$saldo = $salaw + $simpan;
	$query1 = "UPDATE keuangan SET saldo = $salaw , total_saldo = $saldo WHERE nik = $nik"; 

	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
}



function tarik($data) {
	global $conn;

	$nik = $data['nik'];
	$tarik = $data['nominal'];
	$tanggal = date("Y-m-d");

	// kode transaksi
	$tgl = date("dmy");
	$bar = mysqli_query($conn, "SELECT * FROM transaksi");
	$jumbar = mysqli_num_rows($bar);
	$hbar = $jumbar + 1;
	$kd_trans = $tgl . $hbar;

	// query insert data
	$query = "INSERT INTO transaksi
				VALUES
				('', '$kd_trans', '$nik', '$tanggal', '', '$tarik', '', '', '')
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

	$result = mysqli_query($conn, "SELECT saldo FROM keuangan WHERE nik = '$nik'");

	$salaw = mysqli_fetch_assoc($result);
	$saldo = $salaw - $tarik;
	$query1 = "UPDATE keuangan SET saldo = $salaw, tarik = $tarik, sisa_saldo = $saldo, total_saldo = $saldo WHERE nik = $nik";

	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
}



function pinjam($data) {
	global $conn;

	$nik = $data['nik'];
	$pinjam = $data['nominal'];
	$lamabayar = $data['lamabayar'];
	$tanggal = date("Y-m-d");

	// kode transaksi
	$tgl = date("dmy");
	$bar = mysqli_query($conn, "SELECT * FROM transaksi");
	$jumbar = mysqli_num_rows($bar);
	$hbar = $jumbar + 1;
	$kd_trans = $tgl . $hbar;

	// query insert data
	$query = "INSERT INTO transaksi
				VALUES
				('', '$kd_trans', '$nik', '$tanggal', '', '', '$pinjam', '', '')
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

	$query1 = "UPDATE keuangan SET pinjaman = $pinjam, lama_bayar = $lamabayar WHERE nik = $nik";

	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
}



function bayar($data) {
	global $conn;

	$nik = $data['nik'];
	$bayar = $data['nominal'];
	$tanggal = date("Y-m-d");

	// kode transaksi
	$tgl = date("dmy");
	$bar = mysqli_query($conn, "SELECT * FROM transaksi");
	$jumbar = mysqli_num_rows($bar);
	$hbar = $jumbar + 1;
	$kd_trans = $tgl . $hbar;

	// query insert data
	$query = "INSERT INTO transaksi
				VALUES
				('', '$kd_trans', '$nik', '$tanggal', '', '', '', '$bayar', '')
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

	$query1 = "UPDATE keuangan SET pinjaman = $pinjam, lama_bayar = $lamabayar WHERE nik = $nik";

	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
}





?>