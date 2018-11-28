<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];
$nama_kelompok = addslashes($_GET['nama']);
$pekan = $_GET['pekan'];
$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];
date_default_timezone_set("Asia/Bangkok");

//Dapatkan user
$select = $koneksi->prepare("SELECT nama_murabbi FROM murabbi WHERE nama_pengguna='$nama_pengguna';");
$select->execute();
$select->store_result();
$select->bind_result($nama_murabbi);
$select->fetch();

//Dapatkan jumlah mutarabbi
$select = $koneksi->prepare("SELECT count(nama_mutarabbi) from mutarabbi WHERE nama_murabbi = '$nama_murabbi' AND nama_kelompok='$nama_kelompok';");
$select->execute();
$select->store_result();
$select->bind_result($jumlah_mutarabbi);
$select->fetch();

//Dapatkan jumlah mutarabbi hadir
$select = $koneksi->prepare("SELECT count(nama_mutarabbi) from laporan WHERE nama_murabbi = '$nama_murabbi' AND nama_kelompok='$nama_kelompok' and pekan='$pekan' and bulan='$bulan' and tahun='$tahun' and kehadiran='Ya';");
$select->execute();
$select->store_result();
$select->bind_result($jumlah_mutarabbi_hadir);
$select->fetch();

$select = $koneksi->prepare("SELECT badal, hari, tanggal, waktu_mulai, waktu_berakhir, tempat, madah, qadhaya FROM laporan WHERE nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok' and pekan='$pekan' and bulan='$bulan' and $tahun='$tahun';");
$select->execute();
$select->store_result();
$select->bind_result($badal, $hari, $tanggal, $waktu_mulai, $waktu_berakhir, $tempat, $madah, $qadhaya);
$select->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
	<title>Lihat Laporan</title>

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

    <!-- Custom CSS -->
    <style>
    .table-responsive {
      min-height: .01%;
      overflow-x: auto;
    }
    @media screen and (max-width: 767px) {
      .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: 1px solid #ddd;
      }
      .table-responsive > .table {
        margin-bottom: 0;
      }
      .table-responsive > .table > thead > tr > th,
      .table-responsive > .table > tbody > tr > th,
      .table-responsive > .table > tfoot > tr > th,
      .table-responsive > .table > thead > tr > td,
      .table-responsive > .table > tbody > tr > td,
      .table-responsive > .table > tfoot > tr > td {
        white-space: nowrap;
      }
      .table-responsive > .table-bordered {
        border: 0;
      }
      .table-responsive > .table-bordered > thead > tr > th:first-child,
      .table-responsive > .table-bordered > tbody > tr > th:first-child,
      .table-responsive > .table-bordered > tfoot > tr > th:first-child,
      .table-responsive > .table-bordered > thead > tr > td:first-child,
      .table-responsive > .table-bordered > tbody > tr > td:first-child,
      .table-responsive > .table-bordered > tfoot > tr > td:first-child {
        border-left: 0;
      }
      .table-responsive > .table-bordered > thead > tr > th:last-child,
      .table-responsive > .table-bordered > tbody > tr > th:last-child,
      .table-responsive > .table-bordered > tfoot > tr > th:last-child,
      .table-responsive > .table-bordered > thead > tr > td:last-child,
      .table-responsive > .table-bordered > tbody > tr > td:last-child,
      .table-responsive > .table-bordered > tfoot > tr > td:last-child {
        border-right: 0;
      }
      .table-responsive > .table-bordered > tbody > tr:last-child > th,
      .table-responsive > .table-bordered > tfoot > tr:last-child > th,
      .table-responsive > .table-bordered > tbody > tr:last-child > td,
      .table-responsive > .table-bordered > tfoot > tr:last-child > td {
        border-bottom: 0;
      }
    }
    </style>

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
            <a href="riwayat.php?nama=<?= $nama_kelompok;?>" class="breadcrumb">Riwayat Laporan</a>
            <a href="lihat_laporan.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan;?>&pekan=<?=$pekan;?>&tahun=<?=$tahun ;?>" class="breadcrumb">Lihat Riwayat</a>
          </div>
        </div>
      </div>
    </nav>    

<div class="container">
<h2>Laporan Halaqah</h2>
<div class="table-responsive">
Nama Murabbi: <?=$nama_murabbi;?><br>
Nama Kelompok: <?= stripslashes($nama_kelompok);?><br>
Badal: <?=$badal;?><br>
Hari: <?=$hari;?><br>
Tanggal: <?=$tanggal . " " . $bulan . " " . $tahun;?><br>
Pekan ke: <?=$pekan;?><br>
Waktu: <?=$waktu_mulai . " - " . $waktu_berakhir;?><br>
Tempat: <?=$tempat;?><br>
Madah: <?=$madah;?><br>
Jumlah Mutarabbi: <?=$jumlah_mutarabbi;?><br>
	<table class="bordered striped">
	<tr>
		<th>No.</th>
		<th>Nama Mutarabbi</th>
    <th>Kehadiran</th>
		<th>Keterangan</th>
	</tr>
<?php 
$i=0;
$select = $koneksi->prepare("SELECT nama_mutarabbi, kehadiran, keterangan FROM laporan WHERE nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok' and pekan='$pekan' and bulan='$bulan' and tahun='$tahun'");
$select->execute();
$select->store_result();
$select->bind_result($nama_mutarabbi, $kehadiran, $keterangan);
while($select->fetch()){
	$i++;
	?>
  <tr>
  	<td><?=$i;?></td>
    <td><?=$nama_mutarabbi;?></td>
    <td>
      <?php
        if($kehadiran == "Ya"){
          echo '<i class="material-icons">check</i>'; 
        }
        else{
          echo '<i class="material-icons">close</i>'; 
        }
      ?>
    </td>
    <td><?=$keterangan;?></td>
    <?php
      }
    ?>
  </tr>
</table>
Qadhaya: <?=$qadhaya;?><br>
<br>
<h4>Persentase: <?=number_format(($jumlah_mutarabbi_hadir/$jumlah_mutarabbi)*100);?>%</h4>
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
    <script type="text/javascript" src="../js/materialize.min.js"></script>

    <!-- Custom Javasciprt -->
    <script>
        $( document ).ready(function(){
            $(".button-collapse").sideNav();
        })

        $(document).ready(function() {
    		$('select').material_select();
  		});
    </script>
</body>
</html>