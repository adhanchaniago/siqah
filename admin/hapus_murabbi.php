<?php
include_once "../koneksi.php";
if(isset($_GET['id']))
{
	$id_murabbi = $_GET['id'];

	//Dapatkan user
	$select = $koneksi->prepare("SELECT nama_murabbi FROM murabbi WHERE id_murabbi='$id_murabbi';");
	$select->execute();
	$select->store_result();
	$select->bind_result($nama_murabbi);
	$select->fetch();

	$delete = $koneksi->prepare("DELETE FROM halaqah WHERE id_murabbi=?;");
	$delete->bind_param("i", $id_murabbi);
	$delete->execute();

	$delete = $koneksi->prepare("DELETE FROM rekap WHERE nama_murabbi=?;");
	$delete->bind_param("s", $nama_murabbi);
	$delete->execute();

	$delete = $koneksi->prepare("DELETE FROM rekap_mutarabbi WHERE nama_murabbi=?;");
	$delete->bind_param("s", $nama_murabbi);
	$delete->execute();

	$delete = $koneksi->prepare("DELETE FROM status_laporan WHERE nama_murabbi=?;");
	$delete->bind_param("s", $nama_murabbi);
	$delete->execute();

	$delete = $koneksi->prepare("DELETE FROM laporan WHERE nama_murabbi=?;");
	$delete->bind_param("s", $nama_murabbi);
	$delete->execute();

	$delete = $koneksi->prepare("DELETE FROM mutarabbi WHERE nama_murabbi=?;");
	$delete->bind_param("s", $nama_murabbi);
	$delete->execute();

	$delete = $koneksi->prepare("DELETE FROM murabbi WHERE id_murabbi=?;");
	$delete->bind_param("i", $id_murabbi);
	$delete->execute();

	$sudah_delete = true;
	if($sudah_delete == true){
		echo '<script language="javascript">alert("BERHASIL MENGHAPUS MURABBI"); document.location="data_murabbi.php";</script>';
	}
}
?>