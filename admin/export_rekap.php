<?php
$cetak = $_POST['Cetak'];
$bulan_pilih = $_GET['bulan_pilih'];
$tahun_pilih = $_GET['tahun_pilih'];
$angkatan_kelompok_pilih = $_GET['angkatan_kelompok_pilih'];
$angkatan_kelompok_pilih = substr($angkatan_kelompok_pilih, 0, 4);
$jenjang_pilih = $_GET['jenjang_pilih'];
$jenis_kelamin_pilih = $_GET['jenis_kelamin_pilih'];
$filename = "Rekap_" . $bulan_pilih . "_" . $tahun_pilih . "_" . $jenis_kelamin_pilih . "_" . $jenjang_pilih . "_" . $angkatan_kelompok_pilih . ".xls";

if(isset($cetak)){
	// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd.ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=$filename");
 

 
// Tambahkan table
include 'cetak_rekap_laporan.php';
}
?>