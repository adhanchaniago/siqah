<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];

//Dapatkan user
$select = $koneksi->prepare("SELECT nama_murabbi FROM murabbi WHERE nama_pengguna='$nama_pengguna';");
$select->execute();
$select->store_result();
$select->bind_result($nama_murabbi);
$select->fetch();

			$nama_kelompok = $_GET['nama'];
			$nama_kelompok_laporan = stripslashes($nama_kelompok);
			$pekan = $_GET['pekan'];
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];

			$delete = $koneksi->prepare("DELETE FROM status_laporan WHERE pekan=? and bulan=? and tahun=? and nama_kelompok=?;");
			$delete->bind_param("ssss", $pekan, $bulan, $tahun, $nama_kelompok);
			$delete->execute();

			$delete = $koneksi->prepare("DELETE FROM laporan WHERE pekan=? and bulan=? and tahun=? and nama_kelompok=?;");
				$delete->bind_param("ssss", $pekan, $bulan, $tahun, $nama_kelompok_laporan);
				$delete->execute();

			if($bulan == "Januari"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Februari"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Maret"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "April"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Mei"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Juni"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Juli"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Agustus"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "September"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Oktober"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "November"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Desember"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
	
$selesai = true;
if($selesai == true)
{
	echo '<script language="javascript">alert("BERHASIL MENGHAPUS LAPORAN"); document.location="riwayat.php?nama=' . addslashes($nama_kelompok) . '";</script>';
}
else
{
	echo '<script language="javascript">alert("GAGAL MENGHAPUS LAPORAN"); document.location="riwayat.php?nama=' . addslashes($nama_kelompok) . '";</script>';
}
?>