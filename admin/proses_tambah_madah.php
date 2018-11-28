<?php 
		include "../koneksi.php";
		include "akses.php";
			$judul = $_POST['judul_madah'];
			$prioritas = $_POST['prioritas'];
			$bidang_studi = $_POST['bidang_studi'];
			$jenjang  = $_POST['jenjang'];
			$ekstensi_diperbolehkan	= array('doc','docx', 'ppt', 'pptx');
			$lokasi = $_FILES['lokasi']['name'];
			$x = explode('.', $lokasi);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['lokasi']['size'];
			$file_tmp = $_FILES['lokasi']['tmp_name'];	

			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 2044070){			
					move_uploaded_file($file_tmp, '../madah/'.$lokasi);
					$lokasi = "../madah/" . $lokasi;
					$insert = $koneksi->prepare("INSERT INTO `madah` (`madah`, `prioritas`, `bidang_studi`, `jenjang`, `lokasi`) VALUES (?, ?, ?, ?, ?)");
					$insert->bind_param("sisis", $judul, $prioritas, $bidang_studi, $jenjang, $lokasi);
					$insert->execute();
					$selesai = true;
					if($selesai == true){
						echo '<script language="javascript">alert("BERHASIL MENGUNGGAH FILE"); document.location="pusat_madah.php";</script>';
					}else{
						echo '<script language="javascript">alert("GAGAL MENGUNGGAH FILE"); document.location="tambah_madah.php";</script>';
					}
				}else{
					echo '<script language="javascript">alert("UKURAN FILE TERLALU BESAR"); document.location="tambah_madah.php";</script>';
				}
			}else{
				if($lokasi == null){
					$insert = $koneksi->prepare("INSERT INTO `madah` (`madah`, `prioritas`, `bidang_studi`, `jenjang`) VALUES (?, ?, ?, ?)");
					$insert->bind_param("sisi", $judul, $prioritas, $bidang_studi, $jenjang);
					$insert->execute();
					$selesai = true;
					if($selesai == true){
						echo '<script language="javascript">alert("BERHASIL MENAMBAH MADAH"); document.location="pusat_madah.php";</script>';
				}
				else{
					echo '<script language="javascript">alert("EKSTENSI FILE TIDAK DIPERBOLEHKAN"); document.location="tambah_madah.php";</script>';
				}
			}}
		?>