<?php
include_once "../koneksi.php";
if(isset($_GET['nama']))
{
	$nama_kelompok = $_GET['nama'];
	
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

	$delete = $koneksi->prepare("DELETE FROM status_laporan WHERE nama_kelompok=?;");
	$delete->bind_param("s", $nama_kelompok);
	$delete->execute();

	$sudah_delete = true;
	if($sudah_delete == true){
		echo '<script language="javascript">alert("BERHASIL MENGHAPUS KELOMPOK & ISINYA"); document.location="lihat_mutarabbi.php";</script>';
	}
}
?>