<?php
include_once "../koneksi.php";
if(isset($_GET['id']))
{
	$id_mutarabbi = $_GET['id'];
	
	$delete = $koneksi->prepare("DELETE FROM halaqah WHERE id_mutarabbi=?;");
	$delete->bind_param("i", $id_mutarabbi);
	$delete->execute();

	$delete = $koneksi->prepare("DELETE FROM mutarabbi WHERE id_mutarabbi=?;");
	$delete->bind_param("i", $id_mutarabbi);
	$delete->execute();
	$sudah_delete = true;
	if($sudah_delete == true){
		echo '<script language="javascript">alert("BERHASIL MENGHAPUS MUTARABBI"); document.location="data_mutarabbi.php";</script>';
	}
}
?>