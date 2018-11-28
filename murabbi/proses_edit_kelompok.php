<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];

$nama_murabbi = $_POST['nama_murabbi'];
$nama_kelompok_lama = $_POST['nama_kelompok_lama'];
$nama_kelompok_lama = mysqli_real_escape_string($koneksi, $nama_kelompok_lama);
$nama_kelompok_baru = $_POST['nama_kelompok_baru'];
$nama_kelompok_baru = mysqli_real_escape_string($koneksi, $nama_kelompok_baru);
$angkatan_kelompok_baru = $_POST['angkatan_kelompok_baru'];
$jenjang_baru = $_POST['jenjang_baru'];
$id_rekap = $_POST['id_rekap'];

	$edit = $koneksi->prepare("UPDATE `halaqah` SET `nama_kelompok`='$nama_kelompok_baru' WHERE `nama_kelompok`='$nama_kelompok_lama'");
	$edit->execute();

	$edit = $koneksi->prepare("UPDATE `laporan` SET `nama_kelompok`='$nama_kelompok_baru' WHERE `nama_kelompok`='$nama_kelompok_lama'");
	$edit->execute();

	$edit = $koneksi->prepare("UPDATE `mutarabbi` SET `nama_kelompok`='$nama_kelompok_baru' WHERE `nama_kelompok`='$nama_kelompok_lama'");
	$edit->execute();

	$edit = $koneksi->prepare("UPDATE `rekap` SET `nama_kelompok`='$nama_kelompok_baru', `angkatan_kelompok`='$angkatan_kelompok_baru', `jenjang`='$jenjang_baru' WHERE `id_rekap`='$id_rekap'");
	$edit->execute();

	$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `nama_kelompok`='$nama_kelompok_baru' WHERE `nama_kelompok`='$nama_kelompok_lama'");
	$edit->execute();

	$edit = $koneksi->prepare("UPDATE `status_laporan` SET `nama_kelompok`='$nama_kelompok_baru' WHERE `nama_kelompok`='$nama_kelompok_lama'");
	$edit->execute();

$selesai = true;
if($selesai == true)
{
	echo '<script language="javascript">alert("BERHASIL MENGEDIT KELOMPOK"); document.location="lihat_mutarabbi.php";</script>';
}
else
{
	echo '<script language="javascript">alert("GAGAL MENGEDIT KELOMPOK"); document.location="edit_kelompok.php?nama=' . $nama_kelompok_lama . '";</script>';
}
?>