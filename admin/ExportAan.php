<?php
header("Content-type: application/vnd.ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=data_r_ikhwan.xls");
 
// Tambahkan table
include 'RequestAan.php';