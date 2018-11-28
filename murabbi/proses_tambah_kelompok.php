<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];

$nama_murabbi = $_POST['nama_murabbi'];
$nama_kelompok = $_POST['nama_kelompok'];
$nama_kelompok = mysqli_real_escape_string($koneksi, $nama_kelompok);
$nama_kelompok = stripslashes($nama_kelompok);

$jenjang = $_POST['jenjang'];
$angkatan_kelompok = $_POST['angkatan_kelompok'];
$jenis_kelamin = $_POST['jenis_kelamin'];

$tahun = date('Y');

$sql4="SELECT nama_kelompok FROM rekap where nama_kelompok='$nama_kelompok' and tahun='$tahun'";
$result=mysqli_query($koneksi,$sql4);
$rowcheck=mysqli_num_rows($result);

if($rowcheck == 0){
	$insert = $koneksi->prepare("INSERT INTO `rekap` (`nama_murabbi`, `nama_kelompok`, `angkatan_kelompok`, `jenis_kelamin`, `jenjang`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
	$insert->bind_param("ssssis", $nama_murabbi, $nama_kelompok, $angkatan_kelompok, $jenis_kelamin, $jenjang, $tahun);
	$insert->execute();
}
else{
	echo '<script language="javascript">alert("NAMA KELOMPOK SUDAH ADA"); document.location="tambah_kelompok.php?nama=' . $nama_murabbi . '";</script>';	
}

$selesai = true;
if($selesai == true)
{
	echo '<script language="javascript">alert("BERHASIL MENAMBAHKAN KELOMPOK"); document.location="lihat_mutarabbi.php";</script>';
}
else
{
	echo '<script language="javascript">alert("GAGAL MENAMBAHKAN KELOMPOK"); document.location="tambah_kelompok.php?nama=' . $nama_murabbi . '";</script>';
}

?>