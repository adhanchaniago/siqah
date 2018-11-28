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

$lapor_pilih = array(
                '1' => 'Januari',
                '2' => 'Februari',
                '3' => 'Maret',
                '4' => 'April',
                '5' => 'Mei',
                '6' => 'Juni',
                '7' => 'Juli',
                '8' => 'Agustus',
                '9' => 'September',
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

//Dapatkan jumlah mutarabbi
$select = $koneksi->prepare("SELECT count(nama_mutarabbi) from mutarabbi WHERE nama_murabbi = '$nama_murabbi' AND nama_kelompok='$nama_kelompok';");
$select->execute();
$select->store_result();
$select->bind_result($jumlah_mutarabbi);
$select->fetch();

if(isset($_POST['lapor']))
	{
		if ($keberjalanan == "Tidak") {
			$laporan = "Ya";
			$badal = $_POST['badal'];
			$pekan = $_POST['pekan_pilih'];
			$bulan = $_POST['bulan_pilih'];
			$tahun = $_POST['tahun'];
			$qadhaya = $_POST['qadhaya'];

			$sql4="SELECT pekan, bulan, tahun from status_laporan where nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok' and pekan='$pekan' and bulan='$bulan' and tahun='$tahun' GROUP BY pekan";
			$result=mysqli_query($koneksi,$sql4);
			$rowcheck=mysqli_num_rows($result);

			if($rowcheck != 0){
					echo '<script language="javascript">alert("Pekan ini sudah pernah dilaporkan"); document.location="lapor.php?nama=' . stripslashes($nama_kelompok) . '";</script>';
				}
			else{	
			$insert = $koneksi->prepare("INSERT INTO `status_laporan` (`nama_murabbi`, `badal`, `pekan`, `bulan`, `tahun`, `nama_kelompok`, `qadhaya`, `laporan`, `berjalan`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$insert->bind_param("sssssssss", $nama_murabbi, $badal, $pekan, $bulan, $tahun, $nama_kelompok, $qadhaya, $laporan, $keberjalanan);
				$insert->execute();
				}
		}
		else{

		$keterangan = $_POST['keterangan'];
		$dipilih = $_POST['ceklis_id'];

		if(empty($dipilih))
		{
			echo '<script language="javascript">alert("Belum Ada Mutarabbi Yang Dipilih"); document.location="lapor.php?nama=' . stripslashes($nama_kelompok) . '";</script>';
		}
		else
		{
			$nama_mutarabbi = $_POST['ceklis_id'];
			$badal = $_POST['badal'];
			$tanggal = $_POST['tanggal'];
			$tanggal_db = substr($tanggal, 8, 2);
			$day = date('D', strtotime($tanggal));
			$dayList = array(
				'Sun' => 'Minggu',
				'Mon' => 'Senin',
				'Tue' => 'Selasa',
				'Wed' => 'Rabu',
				'Thu' => 'Kamis',
				'Fri' => 'Jumat',
				'Sat' => 'Sabtu'
			);
			$hari = $dayList[$day];
			
			$bulan = $bulan_pilih[substr($tanggal, 5, 2)];
			(int) $bulan_nomer = substr($tanggal, 5, 2);
			$a = strtotime($tanggal);
			if ($bulan_nomer == 1){
				if(date('W', $a)-52==0){
					$pekan = 1;
					$bulan_nomer = 1;
					$bulan = $lapor_pilih[$bulan_nomer];
					$bulan_laporan = $lapor_pilih[$bulan_nomer+1];
				}
				else{
					$pekan = date('W', $a);
				}
			}
			else if ($bulan_nomer == 2){
				if(date('W', $a)-5==0){
					$pekan = 5;
					$bulan_nomer = 1;
					$bulan = $lapor_pilih[$bulan_nomer];
					$bulan_laporan = $lapor_pilih[$bulan_nomer+1];
				}
				else{
					$pekan = date('W', $a)-5;
				}
			}
			else if ($bulan_nomer == 3){
				if(date('W', $a)-9==0){
					$pekan = 4;
					$bulan_nomer = 2;
					$bulan = $lapor_pilih[$bulan_nomer];
					$bulan_laporan = $lapor_pilih[$bulan_nomer+1];
				}
				else{
					$pekan = date('W', $a)-9;
				}
			}
			else if ($bulan_nomer == 4){
				if(date('W', $a)-13==0){
					$pekan = 4;
					$bulan_nomer = 3;
					$bulan = $lapor_pilih[$bulan_nomer];
					$bulan_laporan = $lapor_pilih[$bulan_nomer+1];
				}
				else{
					$pekan = date('W', $a)-13;
				}
			}
			else if ($bulan_nomer == 5){
				if(date('W', $a)-18==0){
					$pekan = 5;
					$bulan_nomer = 4;
					$bulan = $lapor_pilih[$bulan_nomer];
					$bulan_laporan = $lapor_pilih[$bulan_nomer+1];
				}
				else{
					$pekan = date('W', $a)-18;
				}
			}
			else if ($bulan_nomer == 6){
				if(date('W', $a)-22==0){
					$pekan = 4;
					$bulan_nomer = 5;
					$bulan = $lapor_pilih[$bulan_nomer];
					$bulan_laporan = $lapor_pilih[$bulan_nomer+1];
				}
				else{
					$pekan = date('W', $a)-22;
				}
			}
			else if ($bulan_nomer == 7){
				if(date('W', $a)-26==0){
					$pekan = 4;
					$bulan_nomer = 6;
					$bulan = $lapor_pilih[$bulan_nomer];
					$bulan_laporan = $lapor_pilih[$bulan_nomer+1];
				}
				else{
					$pekan = date('W', $a)-26;
				}
			}
			else if ($bulan_nomer == 8){
				if(date('W', $a)-31==0){
					$pekan = 5;
					$bulan_nomer = 7;
					$bulan = $lapor_pilih[$bulan_nomer];
					$bulan_laporan = $lapor_pilih[$bulan_nomer+1];
				}
				else{
					$pekan = date('W', $a)-31;
				}
			}
			else if ($bulan_nomer == 9){
				if(date('W', $a)-35==0){
					$pekan = 4;
					$bulan_nomer = 8;
					$bulan = $lapor_pilih[$bulan_nomer];
					$bulan_laporan = $lapor_pilih[$bulan_nomer+1];
				}
				else{
					$pekan = date('W', $a)-35;
				}
			}
			else if ($bulan_nomer == 10){
				if(date('W', $a)-39==0){
					$pekan = 4;
					$bulan_nomer = 9;
					$bulan = $lapor_pilih[$bulan_nomer];
					$bulan_laporan = $lapor_pilih[$bulan_nomer+1];
				}
				else{
					$pekan = date('W', $a)-39;
				}
			}
			else if ($bulan_nomer == 11){
				if(date('W', $a)-44==0){
					$pekan = 5;
					$bulan_nomer = 10;
					$bulan = $lapor_pilih[$bulan_nomer];
					$bulan_laporan = $lapor_pilih[$bulan_nomer+1];
				}
				else{
					$pekan = date('W', $a)-44;
				}
			}
			else if ($bulan_nomer == 12){
				if(date('W', $a)-48==0){
					$pekan = 4;
					$bulan_nomer = 11;
					$bulan = $lapor_pilih[$bulan_nomer];
					$bulan_laporan = $lapor_pilih[$bulan_nomer+1];
				}
				else{
					$pekan = date('W', $a)-48;
				}
			}
			if($pekan == "01"){
				$pekan = "1";
			}
			else if($pekan == "02"){
				$pekan = "2";
			}
			else if($pekan == "03"){
				$pekan = "3";
			}
			else if($pekan == "04"){
				$pekan = "4";
			}
			else if($pekan == "05"){
				$pekan = "5";
			}

			$tahun = substr($tanggal, 0,4);
			$waktu_mulai = $_POST['waktu_mulai'];
			$waktu_berakhir = $_POST['waktu_berakhir'];
			$tempat = $_POST['tempat'];
			$tempat = mysqli_real_escape_string($koneksi, $tempat);
			$madah = $_POST['madah'];
			$madah = mysqli_real_escape_string($koneksi, $madah);
//			$nama_kelompok = $_POST['nama_kelompok'];
			$qadhaya = $_POST['qadhaya'];
			$qadhaya = mysqli_real_escape_string($koneksi, $qadhaya);
			$tahun_sekarang = date('Y');

			$sql4="SELECT pekan, bulan, tahun from status_laporan where nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok' and pekan='$pekan' and bulan='$bulan' and tahun='$tahun' GROUP BY pekan";
			$result=mysqli_query($koneksi,$sql4);
			$rowcheck=mysqli_num_rows($result);

			if($rowcheck != 0){
					echo '<script language="javascript">alert("Pekan ini sudah pernah dilaporkan"); document.location="lapor.php?nama=' . stripslashes($nama_kelompok) . '";</script>';
				}
			else{
			$select = $koneksi->prepare("SELECT nama_mutarabbi FROM mutarabbi WHERE nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok' ORDER BY nama_mutarabbi ASC;");
$select->execute();
$select->store_result();
$select->bind_result($nama_mutarabbi);
	$i=0;
while($select->fetch()){
	$nama_mutarabbi = addslashes($nama_mutarabbi);
	$insert = $koneksi->prepare("INSERT INTO `laporan` (`nama_murabbi`, `nama_mutarabbi`, `kehadiran`, `badal`, `pekan`, `hari`, `tanggal`, `bulan`, `tahun`, `waktu_mulai`, `waktu_berakhir`, `tempat`, `madah`, `nama_kelompok`, `keterangan`, `qadhaya` ) VALUES (?, '$nama_mutarabbi', 'Tidak', NULL, ?, NULL, NULL, ?, ?, NULL, NULL, NULL, NULL, '$nama_kelompok', ?, NULL)");
				$insert->bind_param("sssss", $nama_murabbi, $pekan, $bulan_laporan, $tahun, $keterangan[$i]);
				$insert->execute();
				$i++;
	}


			$jumlah = count($dipilih);
			?>
			<?php
			for($i=0; $i < $jumlah; $i++)
			{
				//echo $dipilih[$i];
				$edit = $koneksi->prepare("UPDATE `laporan` SET `badal`='$badal', `hari`='$hari', `tanggal`='$tanggal_db', `waktu_mulai`='$waktu_mulai', `waktu_berakhir`='$waktu_berakhir', `tempat`='$tempat', `madah`='$madah', `qadhaya`='$qadhaya' WHERE nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok' and pekan='$pekan' and bulan='$bulan_laporan' and tahun='$tahun'");
						$edit->execute();
				$edit = $koneksi->prepare("UPDATE `laporan` SET `kehadiran`='Ya' WHERE nama_mutarabbi='$dipilih[$i]' and pekan='$pekan' and bulan='$bulan' and tahun='$tahun' and nama_kelompok='$nama_kelompok'");
						$edit->execute();

				$hadir = "1";
				//echo $hadir . $dipilih[$i];

				$sql6="SELECT * FROM rekap_mutarabbi where nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok' and tahun='$tahun_sekarang'";
				$result=mysqli_query($koneksi,$sql6);
				$rowcheck=mysqli_num_rows($result);

				if($rowcheck == 0){
					$select = $koneksi->prepare("SELECT nama_mutarabbi from rekap_mutarabbi WHERE nama_murabbi='$nama_murabbi' and nama_kelompok = '$nama_kelompok' ORDER BY nama_mutarabbi ASC;");
						$select->execute();
						$select->store_result();
						$select->bind_result($nama_mutarabbi_pilihan);
						while($select->fetch())
						{
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $nama_mutarabbi_pilihan, $nama_kelompok, $nama_murabbi, $tahun);
							$insert->execute();
						}
				}

				//Dapatkan
				$select = $koneksi->prepare("SELECT angkatan_kelompok, jenis_kelamin, jenjang FROM rekap where nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok'");
				$select->execute();
				$select->store_result();
				$select->bind_result($angkatan_kelompok, $jenis_kelamin, $jenjang);
				$select->fetch();

				$sql5="SELECT * FROM rekap where nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok' and tahun='$tahun' ";
				$result=mysqli_query($koneksi,$sql5);
				$rowcheck=mysqli_num_rows($result);

				if($rowcheck == 0){
						$insert = $koneksi->prepare("INSERT INTO `rekap` (`nama_murabbi`, `nama_kelompok`, `angkatan_kelompok`, `jenis_kelamin`, `jenjang`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
						$insert->bind_param("ssssis", $nama_murabbi, $nama_kelompok, $angkatan_kelompok, $jenis_kelamin, $jenjang, $tahun);
						$insert->execute();
					}
				else{

				if($bulan == "Januari"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						
						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Februari"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Maret"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "April"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Mei"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Juni"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Juli"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Agustus"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "September"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Oktober"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "November"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Desember"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
							

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}

			}

			if($bulan == "Januari"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `januari_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `januari_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Februari"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `februari_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `februari_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Maret"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `maret_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `maret_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "April"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `april_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `april_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Mei"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `mei_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `mei_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Juni"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juni_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juni_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Juli"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `juli_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `juli_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Agustus"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `agustus_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `agustus_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "September"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `september_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `september_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Oktober"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `oktober_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `oktober_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "November"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `november_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `november_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}
				else if($bulan == "Desember"){
					if($pekan == 1){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_1`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_1`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 2){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_2`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_2`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 3){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_3`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_3`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 4){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_4`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
						

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_4`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
					else if($pekan == 5){
						$edit = $koneksi->prepare("UPDATE `rekap` SET `desember_5`=? WHERE nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						$edit->bind_param("i", $jumlah);
						$edit->execute();

						$sql7="SELECT * FROM rekap_mutarabbi where nama_mutarabbi='$dipilih[$i]' and nama_kelompok='$nama_kelompok' and nama_murabbi = '$nama_murabbi' and tahun='$tahun_sekarang'";
						$result=mysqli_query($koneksi,$sql7);
						$rowcheck=mysqli_num_rows($result);

						if($rowcheck == 0){
							$insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
							$insert->bind_param("ssss", $dipilih[$i], $nama_kelompok, $nama_murabbi, $tahun_sekarang);
							$insert->execute();
						}
							

						$edit = $koneksi->prepare("UPDATE `rekap_mutarabbi` SET `desember_5`='$hadir' WHERE nama_mutarabbi='$dipilih[$i]' AND nama_kelompok='$nama_kelompok' AND tahun='$tahun'");
						
						$edit->execute();
					}
				}

			}
		}
	}
		if ($keberjalanan == "Ya") {
			$laporan = "Ya";

			$sql4="SELECT pekan, bulan, tahun from status_laporan where nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok' and pekan='$pekan' and bulan='$bulan' and tahun='$tahun' GROUP BY pekan";
			$result=mysqli_query($koneksi,$sql4);
			$rowcheck=mysqli_num_rows($result);

			if($rowcheck != 0){
				}
			else{
			$insert = $koneksi->prepare("INSERT INTO `status_laporan` (`nama_murabbi`, `badal`, `pekan`, `bulan`, `tahun`, `nama_kelompok`, `qadhaya`, `laporan`, `berjalan`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$insert->bind_param("sssssssss", $nama_murabbi, $badal, $pekan, $bulan, $tahun, $nama_kelompok, $qadhaya, $laporan, $keberjalanan);
				$insert->execute();
			}
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
	echo '<script language="javascript">alert("GAGAL MELAPORKAN HALAQAH"); document.location="lapor.php?nama=' . $nama_kelompok . '";</script>';
}

?>