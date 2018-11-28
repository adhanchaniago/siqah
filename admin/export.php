<?php
$pilihan = $_POST['jenis_kelamin'];

if($pilihan == "Ikhwan"){
	// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd.ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=data_r_ikhwan.xls");
 

 
// Tambahkan table
include 'r_ikhwan.php';
}
else if($pilihan == "Akhwat"){
	// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd.ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=data_r_akhwat.xls");
 
// Tambahkan table
include 'r_akhwat.php';
}
?>