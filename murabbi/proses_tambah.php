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

//Dapatkan id_halaqah terakhir
$select = $koneksi->prepare("SELECT halaqah.id_halaqah FROM halaqah ORDER BY `id_halaqah` DESC LIMIT 1");
$select->execute();
$select->store_result();
$select->bind_result($id_halaqah);
$select->fetch();

//Dapatkan id_mutarabbi terakhir
$select = $koneksi->prepare("SELECT mutarabbi.id_mutarabbi FROM mutarabbi ORDER BY `id_mutarabbi` DESC LIMIT 1");
$select->execute();
$select->store_result();
$select->bind_result($id_mutarabbi);
$select->fetch();

$id_mutarabbi = $id_mutarabbi + 1;
$id_halaqah = $id_halaqah + 1;
$nama_mutarabbi = $_POST['nama_mutarabbi'];
$prodi = $_POST['prodi'];
$angkatan = $_POST['angkatan'];
$nama_murabbi = $_POST['nama_murabbi'];
$jenjang = $_POST['jenjang'];
$nama_kelompok = $_POST['nama_kelompok'];	
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$tahun = date('Y');
$status = "Aktif";

$insert = $koneksi->prepare("INSERT INTO `mutarabbi` (`id_mutarabbi`, `nama_mutarabbi`, `prodi`, `angkatan`, `nama_murabbi`, `jenjang`, `nama_kelompok`, `no_hp`, `alamat`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$insert->bind_param("isssssssss", $id_mutarabbi, $nama_mutarabbi, $prodi, $angkatan, $nama_murabbi, $jenjang, $nama_kelompok, $no_hp, $alamat, $status);
$insert->execute();

$insert = $koneksi->prepare("INSERT INTO `halaqah` (`id_halaqah`, `id_mutarabbi`, `id_murabbi`, `nama_kelompok`) VALUES (?, ?, ?, ?)");
$insert->bind_param("iiis", $id_halaqah, $id_mutarabbi, $id_murabbi, $nama_kelompok);
$insert->execute();

$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
	$insert->bind_param("ssss", $nama_mutarabbi, $nama_kelompok, $nama_murabbi, $tahun);
	$insert->execute();

$selesai = true;
if($selesai == true)
{
	echo '<script language="javascript">alert("BERHASIL MENAMBAHKAN MUTARABBI"); document.location="data_mutarabbi.php?nama=' . $nama_kelompok . '";</script>';
}
else
{
	echo '<script language="javascript">alert("GAGAL MENAMBAHKAN MUTARABBI"); document.location="tambah.php?nama=' . $nama_kelompok . '";</script>';
}
?>