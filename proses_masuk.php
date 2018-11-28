<?php
 session_start(); //memulai session
 include "koneksi.php";//mengambil isian username dan password dari form
 $nama_pengguna = $_POST['nama_pengguna'];
 $kata_sandi = $_POST['kata_sandi'];
 //query untuk mengambil data user dari database sesuai dengan username inputan form
 $q = "SELECT * FROM murabbi WHERE nama_pengguna = '$nama_pengguna' ";
 $result = mysqli_query($koneksi, $q);
 $data = mysqli_fetch_array($result);
 //cek kesesuaian password masukan dengan database
 if ($kata_sandi == $data['kata_sandi']) {
	 //menyimpan tipe user dan username dalam session
	 if ($_SESSION['nama_pengguna'] = $data['nama_pengguna']){
	 	 if (strtolower($nama_pengguna) == "admin" AND $kata_sandi == "admin") {
	 		header( 'Location: admin/index.php' ) ;
	 		}
	 	else{
	 	header( 'Location: murabbi/index.php' ) ;}
	 }
 }
 //jika password tidak sesuai
 else if($nama_pengguna == "" OR $kata_sandi == ""){
	 echo '<script language="javascript">alert("Username / Password belum diisi!"); document.location="index.php";</script>';
 }
 else {
	echo '<script language="javascript">alert("Username / Password tidak sesuai!"); document.location="index.php";</script>';
 }
 ?> 