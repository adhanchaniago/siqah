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

			//Dapatkan data lengkap madah
			$select = $koneksi->prepare("SELECT id_madah FROM madah WHERE madah='$judul';");
			$select->execute();
			$select->store_result();
			$select->bind_result($id_madah);
			$select->fetch();

			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 2044070){			
					move_uploaded_file($file_tmp, '../madah/'.$lokasi);
					$lokasi = "../madah/" . $lokasi;

					$edit = $koneksi->prepare("UPDATE `madah` SET `madah`=?, `prioritas`=?, `bidang_studi`=?, `jenjang`=?, `lokasi`=? WHERE id_madah=?");
					$edit->bind_param("sisisi", $judul, $prioritas, $bidang_studi, $jenjang, $lokasi, $id_madah);
					$edit->execute();

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
					$edit = $koneksi->prepare("UPDATE `madah` SET `madah`=?, `prioritas`=?, `bidang_studi`=?, `jenjang`=? WHERE id_madah=?");
					$edit->bind_param("sisii", $judul, $prioritas, $bidang_studi, $jenjang, $id_madah);
					$edit->execute();
					$selesai = true;
					if($selesai == true){
						echo '<script language="javascript">alert("BERHASIL MENAMBAH MADAH"); document.location="pusat_madah.php";</script>';
				}
				else{
					echo '<script language="javascript">alert("EKSTENSI FILE TIDAK DIPERBOLEHKAN"); document.location="tambah_madah.php";</script>';
				}
			}}
		?>