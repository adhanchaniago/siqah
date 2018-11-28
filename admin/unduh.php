<?php
$filename = "Presensi.xls";

if(isset($cetak)){
	// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd.ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=$filename");
 

 
// Tambahkan table
include 'unduh_presensi.php?id=<?=$id_agenda;?>';
}
?>