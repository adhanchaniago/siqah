<?php
include "../koneksi.php";
include "akses.php";
$nama_kelompok = mysqli_real_escape_string($koneksi, $_GET['nama']);

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

if(!isset($_POST['pilih_bulan'])){
    $pilih_bulan = $bulan[(date('m'))];
}
else{
    $pilih_bulan = $_POST['pilih_bulan'];
}

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
$select = $koneksi->prepare("SELECT nama_murabbi FROM rekap WHERE nama_kelompok='$nama_kelompok';");
$select->execute();
$select->store_result();
$select->bind_result($nama_murabbi);
$select->fetch();

//Dapatkan user
$select = $koneksi->prepare("SELECT id_murabbi FROM murabbi WHERE nama_murabbi='$nama_murabbi';");
$select->execute();
$select->store_result();
$select->bind_result($id_murabbi);
$select->fetch();

$select = $koneksi->prepare("select tahun from laporan group by tahun order by tahun ASC;");
$select->execute();
$select->store_result();
$select->bind_result($pilih_tahun);
$select->fetch();

$kelompok = array();
$i = 1;
//Dapatkan user
$select = $koneksi->prepare("select nama_kelompok from mutarabbi where nama_murabbi='$nama_murabbi' GROUP BY nama_kelompok;");
$select->execute();
$select->store_result();
$select->bind_result($nama_kelompoknya);
while($select->fetch()){
    $kelompok[$i] = $nama_kelompoknya;
    $i++;
}
                $sql = "SELECT count(nama_kelompok) from mutarabbi WHERE nama_murabbi = '$nama_murabbi' GROUP BY nama_kelompok"; // syntax SQL
                
                $result = $koneksi->query($sql); // eksekusi perintah SQL
                
                $jumlah_kelompok = $result->num_rows;
                


$spongebob = mysqli_query($koneksi, "SELECT pekan, count(nama_mutarabbi), nama_kelompok FROM laporan WHERE nama_kelompok='Spongebob' GROUP BY nama_kelompok, pekan ORDER by pekan ASC");

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
	<title>Rekapitulasi Presensi</title>
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
        overflow-y: visible;
        overflow-x: scroll;
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
            <a href="" class="breadcrumb">Rekap Presensi</a>
          </div>
        </div>
      </div>
    </nav>       

<div class="container">
<h2>Rekapitulasi Presensi</h2>


<?php
//for($k=1;$k<=$jumlah_kelompok;$k++){
    $sql2 = "SELECT nama_mutarabbi from mutarabbi where nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok' and status='Aktif' ORDER BY nama_mutarabbi";
    $sql3 = "SELECT nama_mutarabbi from mutarabbi where nama_murabbi='$nama_murabbi' and nama_kelompok='$nama_kelompok' and status='Nonaktif' ORDER BY nama_mutarabbi";
    $result2 = $koneksi->query($sql2);
    $result3 = $koneksi->query($sql3);
    $jumlah_binaan = $result2->num_rows;
    $jumlah_binaan_non = $result3->num_rows;
    ?>
    Nama Murabbi: <?=$nama_murabbi;?><br>
    Nama Kelompok: <?= stripslashes($nama_kelompok);?><br>
    Jumlah Anggota: <?=$jumlah_binaan;?><br>
    Non-Aktif: <?=$jumlah_binaan_non;?>
    <?php
    if($bulan_pilihan == 1){
        ?>
        <center><a href="hasil_rekap_presensi.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan + 11;?>&tahun=<?=$tahun_pilihan - 1;?>"> < </a> Bulan:  <?=$bulan_pilihan;?> <a href="hasil_rekap_presensi.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan + 1 ;?>&tahun=<?=$tahun_pilihan;?>">
        <?php    
    }
    else if($bulan_pilihan == 12){
        ?>
        <center><a href="hasil_rekap_presensi.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan -1;?>&tahun=<?=$tahun_pilihan;?>"> < </a> Bulan:  <?=$bulan_pilihan;?> <a href="hasil_rekap_presensi.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan - 11;?>&tahun=<?=$tahun_pilihan + 1;?>">
        <?php
    }
    else{
        ?>
        <center><a href="hasil_rekap_presensi.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan - 1;?>&tahun=<?=$tahun_pilihan;?>"> < </a> Bulan:  <?=$bulan_pilihan;?> <a href="hasil_rekap_presensi.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan + 1;?>&tahun=<?=$tahun_pilihan;?>">
        <?php
    }    
    if($tahun_pilihan < $tahun_sekarang){
        echo ">";
    }
    if($bulan_pilihan < $bulan_sekarang){
        echo ">";
    } 
    ?></a></center>
    <center><a href="hasil_rekap_presensi.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan;?>&tahun=<?=$tahun_pilihan - 1;?>"> < </a> Tahun:  <?=$tahun_pilihan;?> <a href="hasil_rekap_presensi.php?nama=<?= stripslashes($nama_kelompok);?>&bulan=<?=$bulan_pilihan;?>&tahun=<?=$tahun_pilihan + 1;?>"> 
    <?php
    if($tahun_pilihan < $tahun_sekarang){
        echo ">";
    } 
    ?></a></center>

<div class="table-responsive">
    <table class="border striped">
    <tr>
        <th rowspan="2">No.</th>
        <th rowspan="2">Nama Mutarabbi</th>
        <?php
        if($bulan_pilihan == "1"){
            ?>
        <th colspan="5" style="text-align: center;">Januari</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilihan == "2"){
            ?>
        <th colspan="5" style="text-align: center;">Februari</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilihan == "3"){
            ?>
        <th colspan="5" style="text-align: center;">Maret</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilihan == "4"){
            ?>
        <th colspan="5" style="text-align: center;">April</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilihan == "5"){
            ?>
        <th colspan="5" style="text-align: center;">Mei</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilihan == "6"){
            ?>
        <th colspan="5" style="text-align: center;">Juni</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilihan == "7"){
            ?>
        <th colspan="5" style="text-align: center;">Juli</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilihan == "8"){
            ?>
        <th colspan="5" style="text-align: center;">Agustus</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilihan == "9"){
            ?>
        <th colspan="5" style="text-align: center;">September</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilihan == "10"){
            ?>
        <th colspan="5" style="text-align: center;">Oktober</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilihan == "11"){
            ?>
        <th colspan="5" style="text-align: center;">November</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilihan == "12"){
            ?>
        <th colspan="5" style="text-align: center;">Desember</th>
        <?php
        }
        ?>
        <th rowspan="2">Total Bulanan</th>
        <th rowspan="2">Total Tahunan</th>
        <th rowspan="2">Tidak Hadir</th>
    </tr>
    <tr>
        <?php
                for($p=1;$p<=5;$p++){
                    echo "<th>" . $p . "</th>";
                }
        ?>
    </tr>
    <?php
    $i = 1;
    $select = $koneksi->prepare("select `mutarabbi`.`nama_mutarabbi`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5` from `rekap_mutarabbi`, `mutarabbi` where `rekap_mutarabbi`.`nama_mutarabbi` = `mutarabbi`.`nama_mutarabbi` and `mutarabbi`.`nama_murabbi`='$nama_murabbi' and `rekap_mutarabbi`.`nama_kelompok`='$nama_kelompok' and `tahun`='$tahun_sekarang' and `status` = 'Aktif' ORDER BY rekap_mutarabbi.nama_kelompok, mutarabbi.nama_mutarabbi ASC");
                $select->execute();
                $select->store_result();
                $select->bind_result($nama_mutarabbi, $januari_1, $januari_2, $januari_3, $januari_4, $januari_5, $februari_1, $februari_2, $februari_3, $februari_4, $februari_5, $maret_1, $maret_2, $maret_3, $maret_4, $maret_5, $april_1, $april_2, $april_3, $april_4, $april_5, $mei_1, $mei_2, $mei_3, $mei_4, $mei_5, $juni_1, $juni_2, $juni_3, $juni_4, $juni_5, $juli_1, $juli_2, $juli_3, $juli_4, $juli_5, $agustus_1, $agustus_2, $agustus_3, $agustus_4, $agustus_5, $september_1, $september_2, $september_3, $september_4, $september_5, $oktober_1, $oktober_2, $oktober_3, $oktober_4, $oktober_5, $november_1, $november_2, $november_3, $november_4, $november_5, $desember_1, $desember_2, $desember_3, $desember_4, $desember_5);
                while($select->fetch())
                {
                    $sql = "SELECT * FROM `laporan` where bulan = '$bulan[$bulan_pilihan]' and kehadiran = 'Tidak' and tahun = '$tahun_sekarang' and nama_murabbi = '$nama_murabbi' and nama_mutarabbi = '$nama_mutarabbi' order by pekan ASC;"; // syntax SQL
                
                    $result = $koneksi->query($sql); // eksekusi perintah SQL
                    
                    $jumlah_absen = $result->num_rows;
                ?>
    
    <tr>
        <td><?=$i++;?></td>
        <td><?=$nama_mutarabbi;?></td>
        <?php
            if($bulan_pilihan == "1"){
                ?>
                <td><?=$januari_1;?></td>
                <td><?=$januari_2;?></td>
                <td><?=$januari_3;?></td>
                <td><?=$januari_4;?></td>
                <td><?=$januari_5;?></td>
                <td><?=$total_per_bulan = $januari_1 + $januari_2 + $januari_3 + $januari_4 + $januari_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "2"){
                ?>
                <td><?=$februari_1;?></td>
                <td><?=$februari_2;?></td>
                <td><?=$februari_3;?></td>
                <td><?=$februari_4;?></td>
                <td><?=$februari_5;?></td>
                <td><?=$total_per_bulan = $februari_1 + $februari_2 + $februari_3 + $februari_4 + $februari_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "3"){
                ?>
                <td><?=$maret_1;?></td>
                <td><?=$maret_2;?></td>
                <td><?=$maret_3;?></td>
                <td><?=$maret_4;?></td>
                <td><?=$maret_5;?></td>
                <td><?=$total_per_bulan = $maret_1 + $maret_2 + $maret_3 + $maret_4 + $maret_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "4"){
                ?>
                <td><?=$april_1;?></td>
                <td><?=$april_2;?></td>
                <td><?=$april_3;?></td>
                <td><?=$april_4;?></td>
                <td><?=$april_5;?></td>
                <td><?=$total_per_bulan = $april_1 + $april_2 + $april_3 + $april_4 + $april_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "5"){
                ?>
                <td><?=$mei_1;?></td>
                <td><?=$mei_2;?></td>
                <td><?=$mei_3;?></td>
                <td><?=$mei_4;?></td>
                <td><?=$mei_5;?></td>
                <td><?=$total_per_bulan = $mei_1 + $mei_2 + $mei_3 + $mei_4 + $mei_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "6"){
                ?>
                <td><?=$juni_1;?></td>
                <td><?=$juni_2;?></td>
                <td><?=$juni_3;?></td>
                <td><?=$juni_4;?></td>
                <td><?=$juni_5;?></td>
                <td><?=$total_per_bulan = $juni_1 + $juni_2 + $juni_3 + $juni_4 + $juni_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "7"){
                ?>
                <td><?=$juli_1;?></td>
                <td><?=$juli_2;?></td>
                <td><?=$juli_3;?></td>
                <td><?=$juli_4;?></td>
                <td><?=$juli_5;?></td>
                <td><?=$total_per_bulan = $juli_1 + $juli_2 + $juli_3 + $juli_4 + $juli_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "8"){
                ?>
                <td><?=$agustus_1;?></td>
                <td><?=$agustus_2;?></td>
                <td><?=$agustus_3;?></td>
                <td><?=$agustus_4;?></td>
                <td><?=$agustus_5;?></td>
                <td><?=$total_per_bulan = $agustus_1 + $agustus_2 + $agustus_3 + $agustus_4 + $agustus_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "9"){
                ?>
                <td><?=$september_1;?></td>
                <td><?=$september_2;?></td>
                <td><?=$september_3;?></td>
                <td><?=$september_4;?></td>
                <td><?=$september_5;?></td>
                <td><?=$total_per_bulan = $september_1 + $september_2 + $september_3 + $september_4 + $september_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "10"){
                ?>
                <td><?=$oktober_1;?></td>
                <td><?=$oktober_2;?></td>
                <td><?=$oktober_3;?></td>
                <td><?=$oktober_4;?></td>
                <td><?=$oktober_5;?></td>
                <td><?=$total_per_bulan = $oktober_1 + $oktober_2 + $oktober_3 + $oktober_4 + $oktober_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "11"){
                ?>
                <td><?=$november_1;?></td>
                <td><?=$november_2;?></td>
                <td><?=$november_3;?></td>
                <td><?=$november_4;?></td>
                <td><?=$november_5;?></td>
                <td><?=$total_per_bulan = $november_1 + $november_2 + $november_3 + $november_4 + $november_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "12"){
                ?>
                <td><?=$desember_1;?></td>
                <td><?=$desember_2;?></td>
                <td><?=$desember_3;?></td>
                <td><?=$desember_4;?></td>
                <td><?=$desember_5;?></td>
                <td><?=$total_per_bulan = $desember_1 + $desember_2 + $desember_3 + $desember_4 + $desember_5;?></td>
        <?php
            }
        ?>
        <td><?=$total_per_mutarabbi = $januari_1 + $januari_2 + $januari_3 + $januari_4 + $januari_5 + $februari_1 + $februari_2 + $februari_3 + $februari_4 + $februari_5 + $maret_1 + $maret_2 + $maret_3 + $maret_4 + $maret_5 + $april_1 + $april_2 + $april_3 + $april_4 + $april_5 + $mei_1 + $mei_2 + $mei_3 + $mei_4 + $mei_5 + $juni_1 + $juni_2 + $juni_3 + $juni_4 + $juni_5 + $juli_1 + $juli_2 + $juli_3 + $juli_4 + $juli_5 + $agustus_1 + $agustus_2 + $agustus_3 + $agustus_4 + $agustus_5 + $september_1 + $september_2 + $september_3 + $september_4 + $september_5 + $oktober_1 + $oktober_2 + $oktober_3 + $oktober_4 + $oktober_5 + $november_1 + $november_2 + $november_3 + $november_4 + $november_5 + $desember_1 + $desember_2 + $desember_3 + $desember_4 + $desember_5;?></td>
        <?php
            if($jumlah_absen == '2'){
                ?>
            <td bgcolor= 'green' style="color: white;"><?=$jumlah_absen;?> kali</td>
            <?php
            }
            if($jumlah_absen == '3'){
                ?>
            <td bgcolor= 'yellow'><?=$jumlah_absen;?> kali</td>
            <?php
            }
            if($jumlah_absen >= '4'){
                ?>
            <td bgcolor= 'red' style="color: white;"><?=$jumlah_absen;?> kali</td>
            <?php
            }
            else if($jumlah_absen < '2'){
                ?>
                <td></td>
                <?php
            }
            ?>
    </tr>
    <?php
                }
                ?>
    <tr>
        <td colspan="2">Jumlah Kehadiran</td>
        <?php
        $select = $koneksi->prepare("select sum(januari_1), sum(januari_2), sum(januari_3), sum(januari_4), sum(januari_5), sum(februari_1), sum(februari_2), sum(februari_3), sum(februari_4), sum(februari_5), sum(maret_1), sum(maret_2), sum(maret_3), sum(maret_4), sum(maret_5), sum(april_1), sum(april_2), sum(april_3), sum(april_4), sum(april_5), sum(mei_1), sum(mei_2), sum(mei_3), sum(mei_4), sum(mei_5), sum(juni_1), sum(juni_2), sum(juni_3), sum(juni_4), sum(juni_5), sum(juli_1), sum(juli_2), sum(juli_3), sum(juli_4), sum(juli_5), sum(agustus_1), sum(agustus_2), sum(agustus_3), sum(agustus_4), sum(agustus_5), sum(september_1), sum(september_2), sum(september_3), sum(september_4), sum(september_5), sum(oktober_1), sum(oktober_2), sum(oktober_3), sum(oktober_4), sum(oktober_5), sum(november_1), sum(november_2), sum(november_3), sum(november_4), sum(november_5), sum(desember_1), sum(desember_2), sum(desember_3), sum(desember_4), sum(desember_5) from rekap_mutarabbi where nama_kelompok='$nama_kelompok' and `tahun`='$tahun_pilihan';");
                $select->execute();
                $select->store_result();
                $select->bind_result($binaan_hadir_januari_1, $binaan_hadir_januari_2, $binaan_hadir_januari_3, $binaan_hadir_januari_4, $binaan_hadir_januari_5, $binaan_hadir_februari_1, $binaan_hadir_februari_2, $binaan_hadir_februari_3, $binaan_hadir_februari_4, $binaan_hadir_februari_5, $binaan_hadir_maret_1, $binaan_hadir_maret_2, $binaan_hadir_maret_3, $binaan_hadir_maret_4, $binaan_hadir_maret_5, $binaan_hadir_april_1, $binaan_hadir_april_2, $binaan_hadir_april_3, $binaan_hadir_april_4, $binaan_hadir_april_5, $binaan_hadir_mei_1, $binaan_hadir_mei_2, $binaan_hadir_mei_3, $binaan_hadir_mei_4, $binaan_hadir_mei_5, $binaan_hadir_juni_1, $binaan_hadir_juni_2, $binaan_hadir_juni_3, $binaan_hadir_juni_4, $binaan_hadir_juni_5, $binaan_hadir_juli_1, $binaan_hadir_juli_2, $binaan_hadir_juli_3, $binaan_hadir_juli_4, $binaan_hadir_juli_5, $binaan_hadir_agustus_1, $binaan_hadir_agustus_2, $binaan_hadir_agustus_3, $binaan_hadir_agustus_4, $binaan_hadir_agustus_5, $binaan_hadir_september_1, $binaan_hadir_september_2, $binaan_hadir_september_3, $binaan_hadir_september_4, $binaan_hadir_september_5, $binaan_hadir_oktober_1, $binaan_hadir_oktober_2, $binaan_hadir_oktober_3, $binaan_hadir_oktober_4, $binaan_hadir_oktober_5, $binaan_hadir_november_1, $binaan_hadir_november_2, $binaan_hadir_november_3, $binaan_hadir_november_4, $binaan_hadir_november_5, $binaan_hadir_desember_1, $binaan_hadir_desember_2, $binaan_hadir_desember_3, $binaan_hadir_desember_4, $binaan_hadir_desember_5);
                while($select->fetch())
                {
            ?>
            <?php
            if($bulan_pilihan == "1"){
                ?>
                <td><?=$binaan_hadir_januari_1;?></td>
                <td><?=$binaan_hadir_januari_2;?></td>
                <td><?=$binaan_hadir_januari_3;?></td>
                <td><?=$binaan_hadir_januari_4;?></td>
                <td><?=$binaan_hadir_januari_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "2"){
                ?>
                <td><?=$binaan_hadir_februari_1;?></td>
                <td><?=$binaan_hadir_februari_2;?></td>
                <td><?=$binaan_hadir_februari_3;?></td>
                <td><?=$binaan_hadir_februari_4;?></td>
                <td><?=$binaan_hadir_februari_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "3"){
                ?>
                <td><?=$binaan_hadir_maret_1;?></td>
                <td><?=$binaan_hadir_maret_2;?></td>
                <td><?=$binaan_hadir_maret_3;?></td>
                <td><?=$binaan_hadir_maret_4;?></td>
                <td><?=$binaan_hadir_maret_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "4"){
                ?>
                <td><?=$binaan_hadir_april_1;?></td>
                <td><?=$binaan_hadir_april_2;?></td>
                <td><?=$binaan_hadir_april_3;?></td>
                <td><?=$binaan_hadir_april_4;?></td>
                <td><?=$binaan_hadir_april_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "5"){
                ?>
                <td><?=$binaan_hadir_mei_1;?></td>
                <td><?=$binaan_hadir_mei_2;?></td>
                <td><?=$binaan_hadir_mei_3;?></td>
                <td><?=$binaan_hadir_mei_4;?></td>
                <td><?=$binaan_hadir_mei_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "6"){
                ?>
                <td><?=$binaan_hadir_juni_1;?></td>
                <td><?=$binaan_hadir_juni_2;?></td>
                <td><?=$binaan_hadir_juni_3;?></td>
                <td><?=$binaan_hadir_juni_4;?></td>
                <td><?=$binaan_hadir_juni_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "7"){
                ?>
                <td><?=$binaan_hadir_juli_1;?></td>
                <td><?=$binaan_hadir_juli_2;?></td>
                <td><?=$binaan_hadir_juli_3;?></td>
                <td><?=$binaan_hadir_juli_4;?></td>
                <td><?=$binaan_hadir_juli_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "8"){
                ?>
                <td><?=$binaan_hadir_agustus_1;?></td>
                <td><?=$binaan_hadir_agustus_2;?></td>
                <td><?=$binaan_hadir_agustus_3;?></td>
                <td><?=$binaan_hadir_agustus_4;?></td>
                <td><?=$binaan_hadir_agustus_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "9"){
                ?>
                <td><?=$binaan_hadir_september_1;?></td>
                <td><?=$binaan_hadir_september_2;?></td>
                <td><?=$binaan_hadir_september_3;?></td>
                <td><?=$binaan_hadir_september_4;?></td>
                <td><?=$binaan_hadir_september_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "10"){
                ?>
                <td><?=$binaan_hadir_oktober_1;?></td>
                <td><?=$binaan_hadir_oktober_2;?></td>
                <td><?=$binaan_hadir_oktober_3;?></td>
                <td><?=$binaan_hadir_oktober_4;?></td>
                <td><?=$binaan_hadir_oktober_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "11"){
                ?>
                <td><?=$binaan_hadir_november_1;?></td>
                <td><?=$binaan_hadir_november_2;?></td>
                <td><?=$binaan_hadir_november_3;?></td>
                <td><?=$binaan_hadir_november_4;?></td>
                <td><?=$binaan_hadir_november_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "12"){
                ?>
                <td><?=$binaan_hadir_desember_1;?></td>
                <td><?=$binaan_hadir_desember_2;?></td>
                <td><?=$binaan_hadir_desember_3;?></td>
                <td><?=$binaan_hadir_desember_4;?></td>
                <td><?=$binaan_hadir_desember_5;?></td>
        <?php
            }
            }
            ?>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
    </tr>
    <tr>
        <td colspan="2">Persentase Kehadiran</td>
        <?php
        $select = $koneksi->prepare("select sum(januari_1), sum(januari_2), sum(januari_3), sum(januari_4), sum(januari_5), sum(februari_1), sum(februari_2), sum(februari_3), sum(februari_4), sum(februari_5), sum(maret_1), sum(maret_2), sum(maret_3), sum(maret_4), sum(maret_5), sum(april_1), sum(april_2), sum(april_3), sum(april_4), sum(april_5), sum(mei_1), sum(mei_2), sum(mei_3), sum(mei_4), sum(mei_5), sum(juni_1), sum(juni_2), sum(juni_3), sum(juni_4), sum(juni_5), sum(juli_1), sum(juli_2), sum(juli_3), sum(juli_4), sum(juli_5), sum(agustus_1), sum(agustus_2), sum(agustus_3), sum(agustus_4), sum(agustus_5), sum(september_1), sum(september_2), sum(september_3), sum(september_4), sum(september_5), sum(oktober_1), sum(oktober_2), sum(oktober_3), sum(oktober_4), sum(oktober_5), sum(november_1), sum(november_2), sum(november_3), sum(november_4), sum(november_5), sum(desember_1), sum(desember_2), sum(desember_3), sum(desember_4), sum(desember_5) from rekap_mutarabbi where nama_kelompok='$nama_kelompok' and `tahun`='$tahun_pilihan';");
                $select->execute();
                $select->store_result();
                $select->bind_result($binaan_hadir_januari_1, $binaan_hadir_januari_2, $binaan_hadir_januari_3, $binaan_hadir_januari_4, $binaan_hadir_januari_5, $binaan_hadir_februari_1, $binaan_hadir_februari_2, $binaan_hadir_februari_3, $binaan_hadir_februari_4, $binaan_hadir_februari_5, $binaan_hadir_maret_1, $binaan_hadir_maret_2, $binaan_hadir_maret_3, $binaan_hadir_maret_4, $binaan_hadir_maret_5, $binaan_hadir_april_1, $binaan_hadir_april_2, $binaan_hadir_april_3, $binaan_hadir_april_4, $binaan_hadir_april_5, $binaan_hadir_mei_1, $binaan_hadir_mei_2, $binaan_hadir_mei_3, $binaan_hadir_mei_4, $binaan_hadir_mei_5, $binaan_hadir_juni_1, $binaan_hadir_juni_2, $binaan_hadir_juni_3, $binaan_hadir_juni_4, $binaan_hadir_juni_5, $binaan_hadir_juli_1, $binaan_hadir_juli_2, $binaan_hadir_juli_3, $binaan_hadir_juli_4, $binaan_hadir_juli_5, $binaan_hadir_agustus_1, $binaan_hadir_agustus_2, $binaan_hadir_agustus_3, $binaan_hadir_agustus_4, $binaan_hadir_agustus_5, $binaan_hadir_september_1, $binaan_hadir_september_2, $binaan_hadir_september_3, $binaan_hadir_september_4, $binaan_hadir_september_5, $binaan_hadir_oktober_1, $binaan_hadir_oktober_2, $binaan_hadir_oktober_3, $binaan_hadir_oktober_4, $binaan_hadir_oktober_5, $binaan_hadir_november_1, $binaan_hadir_november_2, $binaan_hadir_november_3, $binaan_hadir_november_4, $binaan_hadir_november_5, $binaan_hadir_desember_1, $binaan_hadir_desember_2, $binaan_hadir_desember_3, $binaan_hadir_desember_4, $binaan_hadir_desember_5);
                while($select->fetch())
                {
            ?>
<?php
            if($bulan_pilihan == "1"){
                ?>
            <td><?php if($binaan_hadir_januari_1 != 0){ echo number_format(($binaan_hadir_januari_1/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_januari_2 != 0){ echo number_format(($binaan_hadir_januari_2/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_januari_3 != 0){ echo number_format(($binaan_hadir_januari_3/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_januari_4 != 0){ echo number_format(($binaan_hadir_januari_4/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_januari_5 != 0){ echo number_format(($binaan_hadir_januari_5/$jumlah_binaan)*100) . "%";}?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "2"){
                ?>
            <td><?php if($binaan_hadir_februari_1 != 0){ echo number_format(($binaan_hadir_februari_1/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_februari_2 != 0){ echo number_format(($binaan_hadir_februari_2/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_februari_3 != 0){ echo number_format(($binaan_hadir_februari_3/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_februari_4 != 0){ echo number_format(($binaan_hadir_februari_4/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_februari_5 != 0){ echo number_format(($binaan_hadir_februari_5/$jumlah_binaan)*100) . "%";}?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "3"){
                ?>
            <td><?php if($binaan_hadir_maret_1 != 0){ echo number_format(($binaan_hadir_maret_1/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_maret_2 != 0){ echo number_format(($binaan_hadir_maret_2/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_maret_3 != 0){ echo number_format(($binaan_hadir_maret_3/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_maret_4 != 0){ echo number_format(($binaan_hadir_maret_4/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_maret_5 != 0){ echo number_format(($binaan_hadir_maret_5/$jumlah_binaan)*100) . "%";}?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "4"){
                ?>
            <td><?php if($binaan_hadir_april_1 != 0){ echo number_format(($binaan_hadir_april_1/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_april_2 != 0){ echo number_format(($binaan_hadir_april_2/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_april_3 != 0){ echo number_format(($binaan_hadir_april_3/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_april_4 != 0){ echo number_format(($binaan_hadir_april_4/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_april_5 != 0){ echo number_format(($binaan_hadir_april_5/$jumlah_binaan)*100) . "%";}?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "5"){
                ?>
            <td><?php if($binaan_hadir_mei_1 != 0){ echo number_format(($binaan_hadir_mei_1/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_mei_2 != 0){ echo number_format(($binaan_hadir_mei_2/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_mei_3 != 0){ echo number_format(($binaan_hadir_mei_3/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_mei_4 != 0){ echo number_format(($binaan_hadir_mei_4/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_mei_5 != 0){ echo number_format(($binaan_hadir_mei_5/$jumlah_binaan)*100) . "%";}?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "6"){
                ?>
            <td><?php if($binaan_hadir_juni_1 != 0){ echo number_format(($binaan_hadir_juni_1/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_juni_2 != 0){ echo number_format(($binaan_hadir_juni_2/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_juni_3 != 0){ echo number_format(($binaan_hadir_juni_3/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_juni_4 != 0){ echo number_format(($binaan_hadir_juni_4/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_juni_5 != 0){ echo number_format(($binaan_hadir_juni_5/$jumlah_binaan)*100) . "%";}?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "7"){
                ?>
            <td><?php if($binaan_hadir_juli_1 != 0){ echo number_format(($binaan_hadir_juli_1/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_juli_2 != 0){ echo number_format(($binaan_hadir_juli_2/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_juli_3 != 0){ echo number_format(($binaan_hadir_juli_3/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_juli_4 != 0){ echo number_format(($binaan_hadir_juli_4/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_juli_5 != 0){ echo number_format(($binaan_hadir_juli_5/$jumlah_binaan)*100) . "%";}?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "8"){
                ?>
            <td><?php if($binaan_hadir_agustus_1 != 0){ echo number_format(($binaan_hadir_agustus_1/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_agustus_2 != 0){ echo number_format(($binaan_hadir_agustus_2/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_agustus_3 != 0){ echo number_format(($binaan_hadir_agustus_3/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_agustus_4 != 0){ echo number_format(($binaan_hadir_agustus_4/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_agustus_5 != 0){ echo number_format(($binaan_hadir_agustus_5/$jumlah_binaan)*100) . "%";}?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "9"){
                ?>
            <td><?php if($binaan_hadir_september_1 != 0){ echo number_format(($binaan_hadir_september_1/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_september_2 != 0){ echo number_format(($binaan_hadir_september_2/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_september_3 != 0){ echo number_format(($binaan_hadir_september_3/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_september_4 != 0){ echo number_format(($binaan_hadir_september_4/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_september_5 != 0){ echo number_format(($binaan_hadir_september_5/$jumlah_binaan)*100) . "%";}?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "10"){
                ?>
            <td><?php if($binaan_hadir_oktober_1 != 0){ echo number_format(($binaan_hadir_oktober_1/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_oktober_2 != 0){ echo number_format(($binaan_hadir_oktober_2/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_oktober_3 != 0){ echo number_format(($binaan_hadir_oktober_3/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_oktober_4 != 0){ echo number_format(($binaan_hadir_oktober_4/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_oktober_5 != 0){ echo number_format(($binaan_hadir_oktober_5/$jumlah_binaan)*100) . "%";}?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "11"){
                ?>
            <td><?php if($binaan_hadir_november_1 != 0){ echo number_format(($binaan_hadir_november_1/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_november_2 != 0){ echo number_format(($binaan_hadir_november_2/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_november_3 != 0){ echo number_format(($binaan_hadir_november_3/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_november_4 != 0){ echo number_format(($binaan_hadir_november_4/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_november_5 != 0){ echo number_format(($binaan_hadir_november_5/$jumlah_binaan)*100) . "%";}?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilihan == "12"){
                ?>
            <td><?php if($binaan_hadir_desember_1 != 0){ echo number_format(($binaan_hadir_desember_1/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_desember_2 != 0){ echo number_format(($binaan_hadir_desember_2/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_desember_3 != 0){ echo number_format(($binaan_hadir_desember_3/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_desember_4 != 0){ echo number_format(($binaan_hadir_desember_4/$jumlah_binaan)*100) . "%";}?></td>
            <td><?php if($binaan_hadir_desember_5 != 0){ echo number_format(($binaan_hadir_desember_5/$jumlah_binaan)*100) . "%";}?></td>
        <?php
            }
        }
            ?>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
    </tr>
</table>
</br>

<?php
//    }
?>
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
    </script>
</body>
</html>