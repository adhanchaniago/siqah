<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];

//Dapatkan user
$select = $koneksi->prepare("SELECT id_murabbi FROM murabbi WHERE nama_pengguna='$nama_pengguna';");
$select->execute();
$select->store_result();
$select->bind_result($id_murabbi);
$select->fetch();

//Dapatkan id_murabbi terakhir
$select = $koneksi->prepare("SELECT murabbi.id_murabbi FROM murabbi ORDER BY `id_murabbi` DESC LIMIT 1");
$select->execute();
$select->store_result();
$select->bind_result($id_murabbi);
$select->fetch();

$id_murabbi = $id_murabbi + 1;
$nama_murabbi = $_POST['nama_murabbi'];
$prodi = $_POST['prodi'];
$angkatan = $_POST['angkatan'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$nama_pengguna_baru = $_POST['nama_pengguna_baru'];
$kata_sandi_baru = $_POST['kata_sandi_baru'];
$kata_sandi_baru2 = $_POST['kata_sandi_baru2'];

if($nama_murabbi == "" OR $prodi == "" OR $angkatan == "" OR $nama_pengguna_baru == "" OR $kata_sandi_baru == "" OR $kata_sandi_baru2 == ""){
	 echo '<script language="javascript">alert("Isian belum lengkap!"); document.location="tambah_murabbi.php";</script>';
}
if($kata_sandi_baru != $kata_sandi_baru2){
	 echo '<script language="javascript">alert("Kata Sandi tidak sama"); document.location="tambah_murabbi.php";</script>';
}
else{
		$insert = $koneksi->prepare("INSERT INTO `murabbi` (`id_murabbi`, `nama_murabbi`, `prodi`, `angkatan`, `jenis_kelamin`, `nama_pengguna`, `kata_sandi`) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$insert->bind_param("issssss", $id_murabbi, $nama_murabbi, $prodi, $angkatan, $jenis_kelamin, $nama_pengguna_baru, $kata_sandi_baru);
		$insert->execute();

		$selesai = true;
		if($selesai == true)
		{
			echo '<script language="javascript">alert("BERHASIL MENAMBAHKAN MURABBI"); document.location="data_murabbi.php";</script>';
		}
		else
		{
			echo '<script language="javascript">alert("GAGAL MENAMBAHKAN MURABBI"); document.location="tambah_murabbi.php";</script>';
		}
}
?>