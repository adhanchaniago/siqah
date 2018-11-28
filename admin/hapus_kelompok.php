<?php
include_once "../koneksi.php";
if(isset($_GET['nama']))
{
	$nama_kelompok = $_GET['nama'];

	//Dapatkan id_murabbi
	$select = $koneksi->prepare("SELECT id_murabbi FROM murabbi, rekap WHERE nama_kelompok='Muslim Warrior' and murabbi.nama_murabbi = rekap.nama_murabbi;");
	$select->execute();
	$select->store_result();
	$select->bind_result($id_murabbi);
	$select->fetch();
	
	$delete = $koneksi->prepare("DELETE FROM halaqah WHERE nama_kelompok=?;");
	$delete->bind_param("s", $nama_kelompok);
	$delete->execute();

	$delete = $koneksi->prepare("DELETE FROM rekap WHERE nama_kelompok=?;");
	$delete->bind_param("s", $nama_kelompok);
	$delete->execute();

	$delete = $koneksi->prepare("DELETE FROM rekap_mutarabbi WHERE nama_kelompok=?;");
	$delete->bind_param("s", $nama_kelompok);
	$delete->execute();

	$delete = $koneksi->prepare("DELETE FROM laporan WHERE nama_kelompok=?;");
	$delete->bind_param("s", $nama_kelompok);
	$delete->execute();

	$delete = $koneksi->prepare("DELETE FROM mutarabbi WHERE nama_kelompok=?;");
	$delete->bind_param("s", $nama_kelompok);
	$delete->execute();

	$sudah_delete = true;
	if($sudah_delete == true){
		echo '<script language="javascript">alert("BERHASIL MENGHAPUS KELOMPOK & ISINYA"); document.location="lihat_kelompok.php?id=' . $id_murabbi . '";</script>';
	}
}
?>