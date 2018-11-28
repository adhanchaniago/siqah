<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];

$bulan_pilih = array(
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
        );

//Dapatkan user
$select = $koneksi->prepare("SELECT nama_murabbi FROM murabbi WHERE nama_pengguna='$nama_pengguna';");
$select->execute();
$select->store_result();
$select->bind_result($nama_murabbi);
$select->fetch();

$nama_kelompok = addslashes($_POST['nama_kelompok']);
$keberjalanan = $_POST['keberjalanan'];

if(isset($_POST['lapor']))
	{
		if ($keberjalanan == "Tidak") {
			$laporan = "Ya";
			$badal = $_POST['badal'];
			$pekan = $_POST['pekan'];
			$bulan = $_POST['bulan'];
			$tahun = $_POST['tahun'];
			$qadhaya = $_POST['qadhaya'];

			$delete = $koneksi->prepare("DELETE FROM status_laporan WHERE pekan=? and bulan=? and tahun=? and nama_kelompok=?;");
			$delete->bind_param("ssss", $pekan, $bulan, $tahun, $nama_kelompok);
			$delete->execute();

			$delete = $koneksi->prepare("DELETE FROM laporan WHERE pekan=? and bulan=? and tahun=? and nama_kelompok=?;");
				$delete->bind_param("ssss", $pekan, $bulan, $tahun, $nama_kelompok);
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
	
			$insert = $koneksi->prepare("INSERT INTO `status_laporan` (`nama_murabbi`, `badal`, `pekan`, `bulan`, `tahun`, `nama_kelompok`, `qadhaya`, `laporan`, `berjalan`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$insert->bind_param("sssssssss", $nama_murabbi, $badal, $pekan, $bulan, $tahun, $nama_kelompok, $qadhaya, $laporan, $keberjalanan);
			$insert->execute();
		}
		else
		{
		$keterangan = $_POST['keterangan'];
		$dipilih = $_POST['ceklis_id'];	
		
		if(empty($dipilih))
		{
			echo '<script language="javascript">alert("Belum Ada Mutarabbi Yang Dipilih"); document.location="edit_laporan.php?nama=' . stripslashes($nama_kelompok) . '&bulan=' . $bulan . '&pekan=' . $pekan . '&tahun=' . $tahun . '";</script>';
		}
		else
		{
			$id_laporan = $_POST['id_laporan'];
			$nama_mutarabbi = $_POST['ceklis_id'];
			$badal = $_POST['badal'];
			$pekan = $_POST['pekan'];
			$bulan = $_POST['bulan'];
			$hari = $_POST['hari'];
			$tanggal = $_POST['tanggal'];
			$tanggal_db = substr($tanggal, 8, 2);
			$hari = $_POST['hari'];
			$tahun = substr($tanggal, 0,4);
			$nama_kelompok = $_POST['nama_kelompok'];

			$delete = $koneksi->prepare("DELETE FROM status_laporan WHERE pekan=? and bulan=? and tahun=? and nama_kelompok=?;");
			$delete->bind_param("ssss", $pekan, $bulan, $tahun, $nama_kelompok);
			$delete->execute();

			$delete = $koneksi->prepare("DELETE FROM laporan WHERE pekan=? and bulan=? and tahun=? and nama_kelompok=?;");
				$delete->bind_param("ssss", $pekan, $bulan, $tahun, $nama_kelompok);
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

			$bulan = $bulan_pilih[substr($tanggal, 5, 2)];

			$bulan = $bulan_pilih[substr($tanggal, 5, 2)];

			(int) $bulan_nomer = substr($tanggal, 5, 2);
			$a = strtotime($tanggal);

			if ($bulan_nomer == 2){
				if(date('W', $a)-5==0){
					$pekan = 5;
				}
				else{
					$pekan = date('W', $a)-5;
				}
			}
			else if ($bulan_nomer == 3){
				if(date('W', $a)-9==0){
					$pekan = 4;
				}
				else{
					$pekan = date('W', $a)-9;
				}
			}
			else if ($bulan_nomer == 4){
				if(date('W', $a)-13==0){
					$pekan = 4;
				}
				else{
					$pekan = date('W', $a)-13;
				}
			}
			else if ($bulan_nomer == 5){
				$pekan = date('W', $a)-17;
			}
			else if ($bulan_nomer == 6){
				if(date('W', $a)-22==0){
					$pekan = 5;
				}
				else{
					$pekan = date('W', $a)-22;
				}
			}
			else if ($bulan_nomer == 7){
				if(date('W', $a)-26==0){
					$pekan = 4;
				}
				else{
					$pekan = date('W', $a)-26;
				}
			}
			else if ($bulan_nomer == 8){
				if(date('W', $a)-31==0){
					$pekan = 5;
				}
				else{
					$pekan = date('W', $a)-31;
				}
			}
			else if ($bulan_nomer == 9){
				if(date('W', $a)-35==0){
					$pekan = 4;
				}
				else{
					$pekan = date('W', $a)-35;
				}
			}
			else if ($bulan_nomer == 10){
				if(date('W', $a)-39==0){
					$pekan = 4;
				}
				else{
					$pekan = date('W', $a)-39;
				}
			}
			else if ($bulan_nomer == 11){
				if(date('W', $a)-44==0){
					$pekan = 5;
				}
				else{
					$pekan = date('W', $a)-44;
				}
			}
			else if ($bulan_nomer == 12){
				if(date('W', $a)-48==0){
					$pekan = 4;
				}
				else{
					$pekan = date('W', $a)-48;
				}
			}
			else{
				$pekan = date('W', $a);
			}

			$waktu_mulai = $_POST['waktu_mulai'];
			$waktu_berakhir = $_POST['waktu_berakhir'];
			$tempat = $_POST['tempat'];
			$tempat = mysqli_real_escape_string($koneksi, $tempat);
			$madah = $_POST['madah'];
			$madah = mysqli_real_escape_string($koneksi, $madah);
			$qadhaya = $_POST['qadhaya'];
			$qadhaya = mysqli_real_escape_string($koneksi, $qadhaya);

			$select = $koneksi->prepare("SELECT nama_mutarabbi FROM mutarabbi WHERE nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok' ORDER BY nama_mutarabbi ASC;");
			$select->execute();
			$select->store_result();
			$select->bind_result($nama_mutarabbi);
				$i=0;
			while($select->fetch())
			{
				$insert = $koneksi->prepare("INSERT INTO `laporan` (`nama_murabbi`, `nama_mutarabbi`, `kehadiran`, `badal`, `pekan`, `hari`, `tanggal`, `bulan`, `tahun`, `waktu_mulai`, `waktu_berakhir`, `tempat`, `madah`, `nama_kelompok`, `keterangan`, `qadhaya` ) VALUES (?, ?, 'Tidak', NULL, ?, NULL, NULL, ?, ?, NULL, NULL, NULL, NULL, ?, ?, NULL)");
				$insert->bind_param("sssssss", $nama_murabbi, $nama_mutarabbi, $pekan, $bulan, $tahun, $nama_kelompok, $keterangan[$i]);
				$insert->execute();
				$i++;
	}


			$jumlah = count($dipilih);
			?>
			<?php

			if($bulan == "Januari"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Februari"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Maret"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "April"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Mei"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Juni"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Juli"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Agustus"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "September"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Oktober"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "November"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}
				else if($bulan == "Desember"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_1`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_2`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_3`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_4`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_5`=NULL WHERE nama_kelompok='$nama_kelompok'");
						$edit->execute();
					}
				}

			for($i=0; $i < $jumlah; $i++)
			{
				$edit = $koneksi->prepare("UPDATE `laporan` SET `badal`='$badal', `hari`='$hari', `tanggal`='$tanggal_db', `waktu_mulai`='$waktu_mulai', `waktu_berakhir`='$waktu_berakhir', `tempat`='$tempat', `madah`='$madah', `qadhaya`='$qadhaya' WHERE nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok' and pekan='$pekan' and bulan='$bulan' and tahun='$tahun'");
						$edit->execute();
				$edit = $koneksi->prepare("UPDATE `laporan` SET `kehadiran`='Ya' WHERE nama_mutarabbi='$dipilih[$i]' and pekan='$pekan' and bulan='$bulan' and tahun='$tahun' and nama_kelompok='$nama_kelompok'");
						$edit->execute();


				$hadir=1;

				if($bulan == "Januari"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_1`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_1`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_2`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_2`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_3`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_3`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_4`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_4`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_5`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_5`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
				}
				else if($bulan == "Februari"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_1`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_1`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_2`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_2`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_3`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_3`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_4`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_4`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_5`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_5`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
				}
				else if($bulan == "Maret"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_1`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_1`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_2`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_2`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_3`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();
	
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_3`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_4`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_4`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_5`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_5`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
				}
				else if($bulan == "April"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_1`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_1`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_2`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_2`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_3`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_3`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_4`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_4`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_5`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_5`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
				}
				else if($bulan == "Mei"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_1`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_1`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_2`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_2`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_3`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_3`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_4`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_4`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_5`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_5`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
				}
				else if($bulan == "Juni"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_1`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_1`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_2`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_2`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_3`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_3`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_4`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_4`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_5`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_5`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
				}
				else if($bulan == "Juli"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_1`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_1`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_2`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_2`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_3`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_3`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_4`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_4`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_5`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_5`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
				}
				else if($bulan == "Agustus"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_1`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_1`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_2`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_2`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_3`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_3`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_4`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_4`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_5`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_5`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
				}
				else if($bulan == "September"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_1`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_1`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_2`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_2`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_3`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_3`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_4`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_4`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_5`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_5`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
				}
				else if($bulan == "Oktober"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_1`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_1`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_2`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_2`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_3`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_3`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_4`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_4`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_5`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_5`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
				}
				else if($bulan == "November"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_1`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_1`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_2`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_2`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_3`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_3`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_4`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_4`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_5`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_5`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
				}
				else if($bulan == "Desember"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_1`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_1`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_2`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_2`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_3`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_3`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_4`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_4`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_5`=? WHERE nama_kelompok=? and nama_murabbi=?");
						$edit->bind_param("iss", $jumlah, $nama_kelompok, $nama_murabbi);
						$edit->execute();

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_5`=? WHERE nama_mutarabbi=?");
						$edit->bind_param("is", $hadir, $dipilih[$i]);
						$edit->execute();
					}
				}


			}
		}
		if($keberjalanan="Ya"){
		$laporan = "Ya";

/*		$delete = $koneksi->prepare("DELETE FROM status_laporan WHERE pekan=? and bulan=? and tahun=? and nama_kelompok=?;");
			$delete->bind_param("ssss", $pekan, $bulan, $tahun, $nama_kelompok);
			$delete->execute();
*/
		$insert = $koneksi->prepare("INSERT INTO `status_laporan` (`nama_murabbi`, `badal`, `pekan`, `bulan`, `tahun`, `nama_kelompok`, `qadhaya`, `laporan`, `berjalan`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$insert->bind_param("sssssssss", $nama_murabbi, $badal, $pekan, $bulan, $tahun, $nama_kelompok, $qadhaya, $laporan, $keberjalanan);
		$insert->execute();
	}
	}
	
}

$selesai = true;
if($selesai == true)
{
	echo '<script language="javascript">alert("BERHASIL MELAPORKAN HALAQAH"); document.location="hasil_rekap_presensi.php?nama=' . $nama_kelompok . '";</script>';
}
else
{
	echo '<script language="javascript">alert("GAGAL MELAPORKAN HALAQAH"); document.location="lapor.php";</script>';
}
?>