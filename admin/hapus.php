<?php
include_once "../koneksi.php";


if(isset($_GET['id']))
{
	$id_mutarabbi = $_GET['id'];
	$nama_kelompok = $_GET['nama'];
	$angkatan_kelompok = $_GET['angkatan_kelompok'];

	//Dapatkan nama mutarabbi
	$select = $koneksi->prepare("SELECT nama_mutarabbi FROM mutarabbi WHERE id_mutarabbi='$id_mutarabbi';");
	$select->execute();
	$select->store_result();
	$select->bind_result($nama_mutarabbi);
	$select->fetch();
	
	//Dapatkan user
	$select = $koneksi->prepare("SELECT nama_murabbi FROM mutarabbi WHERE id_mutarabbi='$id_mutarabbi';");
	$select->execute();
	$select->store_result();
	$select->bind_result($nama_murabbi);
	$select->fetch();

	$delete = $koneksi->prepare("DELETE FROM halaqah WHERE id_mutarabbi=?;");
	$delete->bind_param("i", $id_mutarabbi);
	$delete->execute();

	$delete = $koneksi->prepare("DELETE FROM mutarabbi WHERE id_mutarabbi=?;");
	$delete->bind_param("i", $id_mutarabbi);
	$delete->execute();

	$delete = $koneksi->prepare("DELETE FROM rekap_mutarabbi WHERE nama_mutarabbi=?;");
	$delete->bind_param("s", $nama_mutarabbi);
	$delete->execute();
	$sudah_delete = true;
	if($sudah_delete == true){
		echo '<script language="javascript">alert("BERHASIL MENGHAPUS MUTARABBI"); document.location="data_mutarabbi.php?nama=' . $nama_kelompok . '&angkatan_kelompok=' . $angkatan_kelompok . '";</script>';
	}
}
?>