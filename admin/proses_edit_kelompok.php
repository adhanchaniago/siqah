<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];

$nama_murabbi = $_POST['nama_murabbi'];
$nama_kelompok_lama = $_POST['nama_kelompok_lama'];
$nama_kelompok_baru = $_POST['nama_kelompok_baru'];
$angkatan_kelompok_baru = $_POST['angkatan_kelompok_baru'];
$jenjang_baru = $_POST['jenjang_baru'];

//Dapatkan id_murabbi
$select = $koneksi->prepare("SELECT id_murabbi FROM murabbi WHERE nama_murabbi='$nama_murabbi';");
$select->execute();
$select->store_result();
$select->bind_result($id_murabbi);
$select->fetch();

$sql4="SELECT nama_kelompok FROM rekap where nama_kelompok='$nama_kelompok_baru'";
$result=mysqli_query($koneksi,$sql4);
$rowcheck=mysqli_num_rows($result);

if($rowcheck == 0){
	$edit = $koneksi->prepare("UPDATE `rekap` SET `nama_kelompok`=?, `angkatan_kelompok`=?, `jenjang`=? WHERE nama_kelompok=?");
	$edit->bind_param("ssis", $nama_kelompok_baru, $angkatan_kelompok_baru, $jenjang_baru, $nama_kelompok_lama);
	$edit->execute();
}

$selesai = true;
if($selesai == true)
{
	echo '<script language="javascript">alert("BERHASIL MENGEDIT KELOMPOK"); document.location="lihat_kelompok.php?id=' . $id_murabbi . '";</script>';
}
else
{
	echo '<script language="javascript">alert("GAGAL MENGEDIT KELOMPOK"); document.location="edit_kelompok.php?nama=' . $nama_kelompok_lama . '";</script>';
}
?>