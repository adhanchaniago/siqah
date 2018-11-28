<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];

//Dapatkan id_murabbi
$select = $koneksi->prepare("SELECT id_murabbi FROM murabbi WHERE nama_pengguna='$nama_pengguna';");
$select->execute();
$select->store_result();
$select->bind_result($id_murabbi);
$select->fetch();

$id_halaqah = $_POST['id_halaqah'];
$id_mutarabbi = $_POST['id_mutarabbi'];
$nama_mutarabbi_lama = $_POST['nama_mutarabbi_lama'];
$nama_mutarabbi_baru = $_POST['nama_mutarabbi_baru'];
$prodi = $_POST['prodi'];
$angkatan = $_POST['angkatan'];
$nama_murabbi = $_POST['nama_murabbi'];
$jenjang = $_POST['jenjang'];
$nama_kelompok = $_POST['nama_kelompok'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];

$edit = $koneksi->prepare("UPDATE `halaqah` SET `id_mutarabbi`=?, `id_murabbi`=?, `nama_kelompok`=? WHERE id_halaqah=?");
$edit->bind_param("iisi", $id_mutarabbi, $id_murabbi, $nama_kelompok, $id_halaqah);
$edit->execute();

$edit = $koneksi->prepare("UPDATE `mutarabbi` SET `nama_mutarabbi`=?, `prodi`=?, `angkatan`=?, `nama_murabbi`=?, `jenjang`=?, `nama_kelompok`=?, `no_hp`=?, `alamat`=? WHERE id_mutarabbi=?");
$edit->bind_param("ssssssssi", $nama_mutarabbi_baru, $prodi, $angkatan, $nama_murabbi, $jenjang, $nama_kelompok, $no_hp, $alamat, $id_mutarabbi);
$edit->execute();

$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `nama_mutarabbi`=? WHERE nama_mutarabbi=? and nama_kelompok=?");
$edit->bind_param("sss", $nama_mutarabbi_baru, $nama_mutarabbi_lama, $nama_kelompok);
$edit->execute();

$selesai = true;
if($selesai == true)
{
    echo '<script language="javascript">alert("BERHASIL MENGEDIT DATA"); document.location="data_mutarabbi.php?nama=' . $nama_kelompok . '";</script>';
}
else
{
    echo "GAGAL EDIT";
}