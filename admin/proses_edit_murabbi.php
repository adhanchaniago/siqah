<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];

$id_murabbi = $_POST['id_murabbi'];
$nama_murabbi = $_POST['nama_murabbi'];
$prodi = $_POST['prodi'];
$angkatan = $_POST['angkatan'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$nama_pengguna_baru = $_POST['nama_pengguna_baru'];
$kata_sandi_baru = $_POST['kata_sandi_baru'];

$edit = $koneksi->prepare("UPDATE `murabbi` SET `nama_murabbi`=?, `prodi`=?, `angkatan`=?, `jenis_kelamin`=?, `nama_pengguna`=?, `kata_sandi`=? WHERE id_murabbi=?");
$edit->bind_param("ssssssi", $nama_murabbi, $prodi, $angkatan, $jenis_kelamin, $nama_pengguna_baru, $kata_sandi_baru, $id_murabbi);
$edit->execute();

$selesai = true;
if($selesai == true)
{
    echo '<script language="javascript">alert("BERHASIL MENGEDIT DATA"); document.location="data_murabbi.php";</script>';
}
else
{
    echo "GAGAL EDIT";
}