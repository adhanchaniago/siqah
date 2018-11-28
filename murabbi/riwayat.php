<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];
$nama_kelompok = $_GET['nama'];
$nama_kelompok = mysqli_real_escape_string($koneksi, $nama_kelompok);

//Dapatkan user
$select = $koneksi->prepare("SELECT nama_murabbi FROM murabbi WHERE nama_pengguna='$nama_pengguna';");
$select->execute();
$select->store_result();
$select->bind_result($nama_murabbi);
$select->fetch();

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

$sql = "SELECT count(nama_kelompok) from rekap WHERE nama_murabbi = '$nama_murabbi' GROUP BY nama_kelompok"; // syntax SQL
 
$result = $koneksi->query($sql); // eksekusi perintah SQL
$jumlah_kelompok = $result->num_rows;

if(!isset($_GET['tahun'])){
    $tahun_pilihan = date("Y");
}
else
{
    $tahun_pilihan = $_GET['tahun'];
}

$tahun_sekarang = date("Y");

if(!isset($_GET['bulan'])){
    $bulan_pilihan = date("m");
}
else
{
    $bulan_pilihan = $_GET['bulan'];
}

$bulan_sekarang = date("m");
if($bulan_pilihan == '01'){
  $bulan_pilihan = '1';
}
else if($bulan_pilihan == '02'){
  $bulan_pilihan = '2';
}
else if($bulan_pilihan == '03'){
  $bulan_pilihan = '3';
}
else if($bulan_pilihan == '04'){
  $bulan_pilihan = '4';
}
else if($bulan_pilihan == '05'){
  $bulan_pilihan = '5';
}
else if($bulan_pilihan == '06'){
  $bulan_pilihan = '6';
}
else if($bulan_pilihan == '07'){
  $bulan_pilihan = '7';
}
else if($bulan_pilihan == '08'){
  $bulan_pilihan = '8';
}
else if($bulan_pilihan == '09'){
  $bulan_pilihan = '9';
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
	<title>Riwayat Laporan</title>
	<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

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
              <a href="riwayat.php?nama=<?= stripslashes($nama_kelompok);?>" class="breadcrumb">Riwayat Laporan</a>
            </div>
          </div>
        </div>
      </nav>    

<div class="container">
<h3>Riwayat Laporan</h3>
<?php
if($bulan_pilihan == 1){
        ?>
        <center><a href="riwayat.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan + 11;?>&tahun=<?=$tahun_pilihan - 1;?>"> < </a> Bulan:  <?=$bulan_pilihan;?> <a href="riwayat.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan + 1;?>&tahun=<?=$tahun_pilihan;?>">
        <?php    
    }
    else if($bulan_pilihan == 12){
        ?>
        <center><a href="riwayat.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan -1;?>&tahun=<?=$tahun_pilihan;?>"> < </a> Bulan:  <?=$bulan_pilihan;?> <a href="riwayat.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan - 11;?>&tahun=<?=$tahun_pilihan + 1;?>">
        <?php
    }
    else{
        ?>
        <center><a href="riwayat.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan - 1;?>&tahun=<?=$tahun_pilihan;?>"> < </a> Bulan:  <?=$bulan_pilihan;?> <a href="riwayat.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan + 1;?>&tahun=<?=$tahun_pilihan;?>">
        <?php
    }    
    if($tahun_pilihan < $tahun_sekarang){
        echo ">";
    }
    if($bulan_pilihan < $bulan_sekarang){
        echo ">";
    } 
    ?></a></center>
    <center><a href="riwayat.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan;?>&tahun=<?=$tahun_pilihan - 1;?>"> < </a> Tahun:  <?=$tahun_pilihan;?> <a href="riwayat.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan;?>&tahun=<?=$tahun_pilihan + 1;?>"> 
    <?php
    if($tahun_pilihan < $tahun_sekarang){
        echo ">";
    } 
    ?></a></center>

<table class="bordered striped">
	<tr>
		<th>Bulan</th>
		<th>Pekan</th>
    <th>Laporan</th>
    <th>Keterlaksanaan</th>
		<th>Tindakan</th>
	</tr>
	<?php

  for($p=1;$p<=5;$p++){
    //Dapatkan laporan & berjalan
      $select = $koneksi->prepare("SELECT laporan, berjalan FROM status_laporan WHERE nama_kelompok='$nama_kelompok' and pekan='$p' and bulan='$bulan[$bulan_pilihan]' and tahun='$tahun_pilihan'");
      $select->execute();
      $select->store_result();
      $select->bind_result($laporan, $berjalan);
      $select->fetch();
        ?>
  <tr>
    <td><?=$bulan[$bulan_pilihan];?></td>
    <td><?=$p;?></td>
    <td><?php 
        if ($laporan == "Ya") {
          echo '<i class="material-icons">check</i>'; 
          } 
        else {
          }
        ?>
    </td>
    <td><?php 
        if ($berjalan != "Ya") {
          if ($laporan != "Ya") {
          }
          else{
          echo '<i class="material-icons">close</i>';
          }
          } 
        else { 
            echo '<i class="material-icons">check</i>'; 
          }
        ?>
    </td>
    <td><?php 
        if ($laporan != "Ya") {
          ?>
          <a href="lapor.php?nama=<?= stripslashes(stripslashes($nama_kelompok));?>">Lapor</a>
          <?php
          } 
        else { 
            ?>
            <a href="lihat_laporan.php?nama=<?= stripslashes(stripslashes($nama_kelompok));?>&bulan=<?=$bulan[$bulan_pilihan];?>&pekan=<?=$p;?>&tahun=<?=$tahun_pilihan;?>">Lihat</a> | <a href="edit_laporan.php?nama=<?= stripslashes(stripslashes($nama_kelompok));?>&bulan=<?=$bulan[$bulan_pilihan];?>&pekan=<?=$p;?>&tahun=<?=$tahun_pilihan;?>">Edit</a> | <a href="hapus_laporan.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan[$bulan_pilihan];?>&pekan=<?=$p;?>&tahun=<?=$tahun_pilihan;?>" onclick="return confirm('Yakin Ingin Hapus Laporan?');">Hapus</a>
            <?php
          }
        ?>
    </td>
  </tr>
  <?php
    $laporan = null;
    $berjalan = null;
    }
?>
</table>
</br>
</div>

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
    </script>
</body>
</html>