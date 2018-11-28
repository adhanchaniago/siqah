<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];
$id_mutarabbi = $_GET['id'];

//Dapatkan nama_mutarabbi
$select = $koneksi->prepare("SELECT nama_kelompok, nama_mutarabbi FROM mutarabbi WHERE id_mutarabbi='$id_mutarabbi';");
$select->execute();
$select->store_result();
$select->bind_result($nama_kelompok, $nama_mutarabbi);
$select->fetch();

$nama_kelompok = stripslashes($nama_kelompok);
$nama_kelompok = mysqli_real_escape_string($koneksi, $nama_kelompok);

//Dapatkan angkatan_kelompok
$select = $koneksi->prepare("SELECT angkatan_kelompok, jenis_kelamin, nama_murabbi, jenjang FROM rekap WHERE nama_kelompok='$nama_kelompok'");
$select->execute();
$select->store_result();
$select->bind_result($angkatan_kelompok, $jenis_kelamin, $nama_murabbi, $jenjang);
$select->fetch();

//Dapatkan id_murabbi
$select = $koneksi->prepare("SELECT id_murabbi FROM murabbi WHERE nama_murabbi='$nama_murabbi';");
$select->execute();
$select->store_result();
$select->bind_result($id_murabbi);
$select->fetch();

//Dapatkan jumlah mutarabbi
$select = $koneksi->prepare("SELECT count(nama_mutarabbi) from mutarabbi WHERE nama_murabbi = '$nama_murabbi' AND nama_kelompok='$nama_kelompok';");
$select->execute();
$select->store_result();
$select->bind_result($jumlah_mutarabbi);
$select->fetch();

$tahun_sekarang = date('Y');

//Dapatkan tahun terkini
$select = $koneksi->prepare("SELECT tahun FROM rekap WHERE nama_murabbi='$nama_murabbi' ORDER BY tahun DESC limit 1;");
$select->execute();
$select->store_result();
$select->bind_result($tahun_terkini);
$select->fetch();

if($tahun_sekarang != $tahun_terkini){
    $insert = $koneksi->prepare("INSERT INTO `rekap` (`nama_murabbi`, `nama_kelompok`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
      $insert->bind_param("sss", $nama_murabbi, $nama_kelompok, $tahun_sekarang);
      $insert->execute();

      $select = $koneksi->prepare("SELECT nama_mutarabbi, nama_kelompok, nama_murabbi from rekap_mutarabbi WHERE nama_murabbi = '$nama_murabbi' AND nama_kelompok='$nama_kelompok' ORDER BY nama_mutarabbi  ASC;");
        $select->execute();
        $select->store_result();
        $select->bind_result($nama_mutarabbi_update, $nama_kelompok_update, $nama_murabbi_update);
        while($select->fetch())
        {

      $insert = $koneksi->prepare("INSERT INTO `rekap_mutarabbi` (`nama_mutarabbi`, `nama_kelompok`, `nama_murabbi`, `tahun`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5`) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
      $insert->bind_param("ssss", $nama_mutarabbi_update, $nama_kelompok_update, $nama_murabbi_update, $tahun_sekarang);
      $insert->execute();
    }
}
else
{

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
    <title>Capaian Madah</title>

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
            <li class="active"><a href="data_murabbi.php">Data Murabbi</a></li>
            <li><a href="rekap_laporan.php">Rekap Laporan</a></li>      
            <li><a href="pemantauan.php">Pemantauan</a></li>
            <li><a href="pusat_madah.php">Pusat Madah</a></li>      
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a href="cari.php"><i class="material-icons">search</i></a></li>
            <li><a href="unduh_r.php">Data R</a></li>
            <li><a href="#"><strong>LTT</strong></a></li>
            <li><a href="keluar.php">Keluar</a></li>
        </ul>
        <ul class="right hide-on-large-only">
            <li><a href="index.php"><i class="material-icons">arrow_back</i></a></li>
        </ul>
        
        <ul class="side-nav" id="mobile-mode">
            <li class="active"><a href="data_murabbi.php">Data Murabbi</a></li>
            <li><a href="rekap_laporan.php">Rekap Laporan</a></li>
            <li><a href="pemantauan.php">Pemantauan</a></li>  
            <li><a href="pusat_madah.php">Pusat Madah</a></li> 
            <div class="divider"></div>
              <li><a href="cari.php"><i class="material-icons">search</i></a></li>
              <li><a href="unduh_r.php">Data R</a></li>
              <li><a href="#"><strong>LTT</strong></a></li>
            <div class="divider"></div>
            <li><a href="keluar.php">Keluar</a></li>
        </ul>
        </div>
    </nav>
</header>

<!-- Headline -->
    <div class="section teal lighten-5 z-depth-1">
        <div class="container">
            <p class="flow-text">Dashboard Admin</p>
        </div>
    </div>

    <!-- Breacrumb Navigation -->
    <nav class="hide-on-med-and-down">
      <div class="nav-wrapper teal darken-3">
      <div class="container">
          <div class="col s12">
            <a href="index.php" class="breadcrumb"><i class="material-icons">home</i></a>
            <a href="data_murabbi.php" class="breadcrumb">Data Murabbi</a>
            <a href="lihat_kelompok.php?id=<?=$id_murabbi;?>" class="breadcrumb">Data Kelompok</a>
            <a href="data_mutarabbi.php?nama=<?=$nama_kelompok;?>&angkatan_kelompok=<?=$angkatan_kelompok;?>" class="breadcrumb">Data Mutarabbi</a>
            <a href="" class="breadcrumb">Capaian Madah</a>
          </div>
        </div>
      </div>
    </nav>   

<div class="container">
<h3>Capaian Madah</h3>
Nama Murabbi: <?=$nama_murabbi;?></br>
Nama Mutarabbi: <?=$nama_mutarabbi;?></br>
Nama Kelompok: <?= stripslashes($nama_kelompok);?></br>
Angkatan Kelompok: <?=$angkatan_kelompok;?></br>
Kelas: <?=$jenjang;?></br>
Jenis Kelamin: <?=$jenis_kelamin;?></br>
<div class="table-responsive">
<table class="bordered striped">
  <tr>
    <th>No.</th>
    <th>Hari, tanggal</th>
    <th>Madah</th>
    <th>Keterangan</th>
  </tr>
  <?php
  $i = 1;
  $select = $koneksi->prepare("SELECT hari, tanggal, bulan, tahun, madah, keterangan from laporan WHERE nama_mutarabbi = '$nama_mutarabbi' and kehadiran = 'Ya' ORDER BY id_laporan ASC;");
        $select->execute();
        $select->store_result();
        $select->bind_result($hari, $tanggal, $bulan, $tahun, $madah, $keterangan);
        while($select->fetch())
        {
        ?>
  <tr>
    <td><?=$i++;?></td>
    <td><?=$hari . ", " . $tanggal . " " . $bulan . " " . $tahun;?></td>
    <td><?=$madah;?></td>
    <td><?=$keterangan;?></td>
  </tr>
  <?php
        }
        ?>
</table>
</div><br>
</div><br>

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
    </script>
</body>
</html>