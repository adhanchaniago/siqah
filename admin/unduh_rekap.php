<?php
header("Content-type: application/vnd.ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=rekap_ikhwan_2015.xls");

include 'rekap_ikhwan_2015.php';
?>