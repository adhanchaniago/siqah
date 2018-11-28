<?php
session_start();
 
if(!isset($_SESSION['nama_pengguna'])){
	echo "<script language='javascript'>alert('Anda belum masuk!'); document.location='../index.php';</script>";
}