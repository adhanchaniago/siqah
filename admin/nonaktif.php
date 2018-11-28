<?php
include_once "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];

if(isset($_GET['id']))
{
	$id_mutarabbi = $_GET['id'];

	//Dapatkan user
$select = $koneksi->prepare("SELECT nama_murabbi, nama_kelompok FROM mutarabbi WHERE id_mutarabbi='$id_mutarabbi';");
$select->execute();
$select->store_result();
$select->bind_result($nama_murabbi, $nama_kelompok);
$select->fetch();

	//Dapatkan user
$select = $koneksi->prepare("SELECT angkatan_kelompok FROM rekap WHERE nama_kelompok='$nama_kelompok' and nama_murabbi='$nama_murabbi';");
$select->execute();
$select->store_result();
$select->bind_result($angkatan_kelompok);
$select->fetch();
	
	$edit = $koneksi->prepare("UPDATE `mutarabbi` SET `status`='Nonaktif' WHERE id_mutarabbi='$id_mutarabbi' and nama_murabbi='$nama_murabbi'");
	$edit->execute();
	
	$sudah_edit = true;
	if($sudah_edit == true){
		echo '<script language="javascript">alert("BERHASIL NON-AKTIFKAN MUTARABBI"); document.location="data_mutarabbi.php?nama=' . $nama_kelompok . '&angkatan_kelompok=' . $angkatan_kelompok . '";</script>';
	}
}
?>