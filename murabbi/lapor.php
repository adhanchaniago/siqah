<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];
$nama_kelompok = $_GET['nama'];
$nama_kelompok = mysqli_real_escape_string($koneksi, $nama_kelompok);
date_default_timezone_set("Asia/Bangkok");

$bulan = array(
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

if(!isset($_POST['pekan_pilih'])){
if( date('d') % 7 == 0){
    $pekan_pilih = date('d')/7;
  }
  else{
    $pekan_pilih = (int)(date('d')/7)+1;
  }
  $bulan_pilih = $bulan[date("m")];
}
else{
  $pekan_pilih = $_POST['pekan_pilih'];
  $bulan_pilih = $_POST['bulan_pilih'];
}

$time = date('H:i');

$bulan = array(
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
$select = $koneksi->prepare("SELECT nama_murabbi, jenis_kelamin FROM murabbi WHERE nama_pengguna='$nama_pengguna';");
$select->execute();
$select->store_result();
$select->bind_result($nama_murabbi, $jenis_kelamin);
$select->fetch();

//Dapatkan jenjang
$select = $koneksi->prepare("SELECT jenjang FROM mutarabbi WHERE nama_kelompok='$nama_kelompok';");
$select->execute();
$select->store_result();
$select->bind_result($jenjang);
$select->fetch();

$array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
$hari = $array_hr[date('N')];

$tanggal = date('Y-m-d');
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
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
	<title>Lapor Keterlaksanaan</title>

	<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<style type="text/css" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css"></style>

	<!-- Favicon Properties -->
    <link rel="apple-touch-icon" sizes="57x57" href="../favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="../favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
<!--	<style type="text/css">
		body { margin: 20px 50px; }
		h1 { font-size: 1.5em; }
		p { margin: 0; }
		input[type="checkbox"] { 
		  height: 20px; 
		  width: 20px; 
		  margin-right: 10px;
		}	

		.ready { font-size: 1.5em; }
		.ui-progressbar-value {
			background: lightgreen; 
		}
		.progressbar-container {
		  position: relative;
		  width: 350px; 
		}

		.progressbar-bar { 
		  height: 25px;
		margin: 10px 0;
		border-radius: 7px;
		}

		.progressbar-label {
		  position: absolute;
		  top: 2px;
		  left: 45%;
		  z-index: 2;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function() {
		  
		  // get box count
		  var count = 0;
		  var checked = 0;
		  function countBoxes() { 
		    count = $("input[type='checkbox']").length;
		    console.log(count);
		  }
		  
		  countBoxes();
		  $(":checkbox").click(countBoxes);
		  
		  // count checks
		  
		  function countChecked() {
		    checked = $("input:checked").length;
		    
		    var percentage = parseInt(((checked / count) * 100),10);
		    $(".progressbar-bar").progressbar({
		            value: percentage
		        });
		    $(".progressbar-label").text(percentage + "%");
		  }
		  
		  countChecked();
		  $(":checkbox").click(countChecked);
		});
	</script>-->

	    <!--Back To Top-->
    <script type="text/javascript">
        $(document).ready(function(){
    $(window).scroll(function(){
        if ($(window).scrollTop() > 100) {
            $('#tombolScrollTop').fadeIn();
        } else {
            $('#tombolScrollTop').fadeOut();
        }
    });
});

function scrolltotop()
{
    $('html, body').animate({scrollTop : 0},500);
}

window.onload=function(){ 
	var select = document.getElementById("keberjalanan");
select.onchange=function(){
    if(select.value=="Berjalan"){
       document.getElementById("form_lapor").style.display="inline";
       document.getElementById("form_lapor2").style.display="none";
    }else if(select.value=="Tidak"){
       document.getElementById("form_lapor").style.display="none";
       document.getElementById("form_lapor2").style.display="inline";
    }

}
}
    </script>
    <!--END Back to Top-->
</head>
<body>
<header>
    <!-- Navbar goes here -->
    <nav>
        <div class="nav-wrapper teal darken-4 z-depth-3">
        <a href="index.php" class="brand-logo center hide-on-med-and-down">
        <img src="../favicon/icon-header2.png" class="responsive-img" style="height: 55px; margin-top: 5px;"></a>
        <a href="index.php" class="brand-logo center hide-on-large-only">
        <img src="../favicon/icon-header2.png" class="responsive-img" style="height: 45px; margin-top: 5px;"></a>
        <a href="#" data-activates="mobile-mode" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="left hide-on-med-and-down">
            <li><a href="lihat_mutarabbi.php">Data Kelompok</a></li>
            <li class="active"><a href="laporan_halaqah.php">Laporan Halaqah</a></li>
            <li><a href="rekap_presensi.php">Rekapitulasi Presensi</a></li>
            <li><a href="pusat_madah.php">Pusat Madah</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a href="#"><strong><?=$nama_murabbi;?></strong></a></li>
            <li><a href="keluar.php">Keluar</a></li>
        </ul>
        <ul class="right hide-on-large-only">
            <li><a href="index.php"><i class="material-icons">arrow_back</i></a></li>
        </ul>
        
        <ul class="side-nav" id="mobile-mode">
            <li><a href="lihat_mutarabbi.php">Data Kelompok</a></li>
            <li class="active"><a href="laporan_halaqah.php">Laporan Halaqah</a></li>
            <li><a href="rekap_presensi.php">Rekapitulasi Presensi</a></li>
            <li><a href="pusat_madah.php">Pusat Madah</a></li>
            <div class="divider"></div>
            <li><a href="#"><strong><?=$nama_murabbi;?></strong></a></li>
            <div class="divider"></div>
            <li><a href="keluar.php">Keluar</a></li>
        </ul>
        </div>
    </nav>
</header>

<!-- Headline -->
    <div class="section teal lighten-5 z-depth-1">
        <div class="container">
            <p class="flow-text">Dashboard Murabbi</p>
        </div>
    </div>

    <!-- Breacrumb Navigation -->
    <nav class="hide-on-med-and-down">
      <div class="nav-wrapper teal darken-3">
      <div class="container">
          <div class="col s12">
            <a href="index.php" class="breadcrumb"><i class="material-icons">home</i></a>
            <a href="laporan_halaqah.php" class="breadcrumb">Laporan Halaqah</a>
            <a href="lapor.php?nama=<?=stripslashes($nama_kelompok);?>" class="breadcrumb">Lapor <?= stripslashes($nama_kelompok);?></a>
          </div>
        </div>
      </div>
    </nav>    

<div class="container">
<h2>Laporan Halaqah</h2>

<div id="form_lapor" style="display: inline;">
<form method="post" action="proses_lapor.php" onsubmit="return confirm('Yakin Ingin Laporkan Data?');">
<div class="row">
	<div class="input-field col s12">
		<select id="keberjalanan" name="keberjalanan">
			<option value="Ya" selected="selected">Berjalan</option>
			<option value="Tidak">Tidak Berjalan</option>
		</select>
		<label>Keberjalanan Halaqah</label>
	</div>
</div>
	<div class="row">
		<div class="input-field col s12">
			<input type="text" name="nama_kelompok" value="<?= stripslashes($nama_kelompok);?>" disabled>
			<input type="hidden" name="nama_kelompok" value="<?= stripslashes($nama_kelompok);?>" placeholder="Nama Kelompok">
			<label>Nama Kelompok</label>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<input type="text" name="nama_murabbi" value="<?=$nama_murabbi;?>" disabled>
			<input type="hidden" name="nama_murabbi" value="<?=$nama_murabbi;?>" placeholder="Nama Murabbi">
			<label>Nama Murabbi</label>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<select name="badal">
			<option value="Tidak">Ya</option>
			<option value="Tidak">Tidak</option>
			<?php
			$select = $koneksi->prepare("SELECT nama_murabbi FROM murabbi WHERE nama_murabbi != '$nama_murabbi' and nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and jenis_kelamin='$jenis_kelamin' ORDER BY id_murabbi ASC;");
						$select->execute();
						$select->store_result();
						$select->bind_result($nama_badal);
						while($select->fetch())
						{
						?>
				<option value="<?=$nama_badal;?>">Tidak, Badal oleh akh <?=$nama_badal;?></option>
				<?php
				}?>
			</select>
			<label>Kehadiran Murabbi</label>
		</div>
	</div>
		<div class="row">
			<div class="input-field col s12">
	        	<input type="date" name="tanggal" value="<?php echo date("Y-m-d");?>" required>
	        	<label class="active">Tanggal</label>
	        </div>
		</div>
		<div class="row">
			<div class="input-field col s12">
	        	<?php date_default_timezone_set("Asia/Dushanbe"); ?>
	        	<input type="time" name="waktu_mulai" style="width: 100px;" value="<?= date('H:00');?>" required> - 
	        	<?php date_default_timezone_set("Asia/Bangkok"); ?>
	        	<input type="time" name="waktu_berakhir" style="width: 100px;" value="<?=date('H:00');?>" required>
	        	<label class="active">Waktu</label>
	        </div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" name="tempat" required>
				<label>Tempat</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" name="madah" required>
				<label>Madah</label>
			</div>
		</div>

		<h5>Mutarabbi Yang Hadir:</h5>	
		<table class="bordered striped">
		<tr>
			<th>No.</th>
			<th>Nama</th>
			<th>Kehadiran</th>
			<th>Keterangan</th>
		</tr>
		<?php
		$i = 1;
		$select = $koneksi->prepare("SELECT id_mutarabbi, nama_mutarabbi from mutarabbi WHERE nama_kelompok = '$nama_kelompok' and status = 'Aktif' ORDER BY nama_mutarabbi ASC;");
					$select->execute();
					$select->store_result();
					$select->bind_result($id_mutarabbi, $nama_mutarabbi);
					while($select->fetch())
					{
					?>
		<tr>
			<td><?=$i++;?></td>
			<td><?=$nama_mutarabbi;?></td>
			<td>
				<!-- Switch -->
				<div class="switch">
					<label>
						Tidak hadir
						<input type="checkbox" name="ceklis_id[]" value="<?= mysqli_real_escape_string($koneksi, $nama_mutarabbi);?>">
						<span class="lever"></span>
						Hadir
				    </label>
				</div>
			</td>
			<td>			
		        <div class="row">
		          <div class="input-field col s12">
		          	<textarea id="textarea1" name="keterangan[]" class="materialize-textarea" data-length="120"></textarea>
		            <label for="textarea1">Deskripsi</label>
		          </div>
		        </div>
			</td>
		</tr>
		<?php
					}
					?>
	</table>
	<!--
	<div class="progressbar-container">
	  <div class="progressbar-bar"></div>
	  <label>Persentase Kehadiran</label>
	  <span class="progressbar-label"></span>
	</div>

	<span class="ready"></span>-->

	<div class="row">
			<div class="input-field col s4">
	        	<textarea id="textarea2" name="qadhaya" class="materialize-textarea" data-length="500"></textarea>
	        	<label>Qadhaya Rawai</label>
	        </div>
	</div>
<button type="submit" class="waves-effect waves-light btn z-depth-3" name="lapor">Laporkan</button>
</form>
</div>
<br>

<div id="form_lapor2" style="display: none;">
<form method="post" action="proses_lapor.php" onsubmit="return confirm('Yakin Ingin Laporkan Data?');">
<div class="row">
	<div class="input-field col s12">
		<select id="keberjalanan" name="keberjalanan">
			<option value="Ya">Berjalan</option>
			<option value="Tidak" selected="selected">Tidak Berjalan</option>
		</select>
		<label>Keberjalanan Halaqah</label>
	</div>
</div>
	<div class="row">
		<div class="input-field col s12">
			<input type="text" name="nama_kelompok" value="<?= stripslashes($nama_kelompok);?>" disabled>
			<input type="hidden" name="nama_kelompok" value="<?= stripslashes($nama_kelompok);?>" placeholder="Nama Kelompok">
			<label>Nama Kelompok</label>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<input type="text" name="nama_murabbi" value="<?=$nama_murabbi;?>" disabled>
			<input type="hidden" name="nama_murabbi" value="<?=$nama_murabbi;?>" placeholder="Nama Murabbi">
			<label>Nama Murabbi</label>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<select name="badal">
			<option value="Tidak">Ya</option>
			<option value="Tidak">Tidak</option>
			<?php
			$select = $koneksi->prepare("SELECT nama_murabbi FROM murabbi WHERE nama_murabbi != '$nama_murabbi' and nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and jenis_kelamin='$jenis_kelamin' ORDER BY id_murabbi ASC;");
						$select->execute();
						$select->store_result();
						$select->bind_result($nama_badal);
						while($select->fetch())
						{
						?>
				<option value="<?=$nama_badal;?>">Tidak, Badal oleh akh <?=$nama_badal;?></option>
				<?php
				}?>
				</select>
			<label>Kehadiran Murabbi</label>
		</div>
	</div>
		<div class="row">
			<div class="input-field col s2">		
			<select name="pekan_pilih" id="pekan_pilih">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
			<label>Pekan ke-</label>
			</div>
			<div class="input-field col s4">
			<select name="bulan_pilih" id="bulan_pilih">
			<?php
						for($i=1; $i<=12; $i++)
						{
						?>
				<option value="<?=$bulan[date($i)];?>"><?=$bulan[date($i)];?></option>
				<?php
				}?>
			</select>
			<label>Bulan</label>
			</div>
			<div class="input-field col s2">
	        	<input type="text" name="tahun" maxlength="4" value="<?php echo date('Y');?>" placeholder="Tahun" required>
	        	<label>Tahun</label>
	        </div>
		</div>
		<div class="row">
			<div class="input-field col s4">
	        	<textarea id="textarea2" name="qadhaya" class="materialize-textarea" data-length="500"></textarea>
	        	<label>Qadhaya Rawai</label>
	        </div>
	</div>
<button type="submit" class="waves-effect waves-light btn z-depth-3" name="lapor">Laporkan</button>
</form>
</div>
</div>
<br>

<button id="tombolScrollTop" class="btn-floating waves-effect waves-light" onclick="scrolltotop()" style="float: right; margin: 0 20px 20px 0;"><i class="material-icons">arrow_upward</i></button>

<footer class="page-footer teal darken-4">
          <div class="footer-copyright">
            <div class="container">
                © 2017 Copyright LTT FT
            <div class="right">
            <a class="grey-text text-lighten-4" href="tutorial.php">Tutorial Penggunaan</a> | 
            <a class="grey-text text-lighten-4" href="tentang_kami.php">Tentang Kami</a>
            </div>
            </div>
          </div>
    </footer>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

    <!-- Custom Javasciprt -->
    <script>
        $( document ).ready(function(){
            $(".button-collapse").sideNav();
        })

        $(document).ready(function() {
    		$('select').material_select();
  		});

  		$('#pekan_pilih option[value="<?=$pekan_pilih;?>"]').attr('selected','selected');
        $('#bulan_pilih option[value="<?=$bulan_pilih;?>"]').attr('selected','selected');
    </script>
</body>
</html>