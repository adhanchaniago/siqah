<?php
$koneksi = new mysqli("localhost", "root", "","u533415024_siqah");
//Jika Koneksi Gagal
if(mysqli_connect_errno())
{
    trigger_error("Tidak Dapat Terkoneksi Dengan Database");
}
$koneksi->set_charset('UTF-8');
?>