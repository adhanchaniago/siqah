<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];

if(!isset($_GET['tahun'])){
    $tahun_pilihan = date("Y");
}
else
{
    $tahun_pilihan = $_GET['tahun'];
}

$tahun_sekarang = date("Y");

$bulan_sekarang = date("m") + 1 - 1;

$bulan_lalu = date("m") - 1;

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
$select = $koneksi->prepare("SELECT nama_murabbi FROM murabbi WHERE nama_pengguna='$nama_pengguna';");
$select->execute();
$select->store_result();
$select->bind_result($nama_murabbi);
$select->fetch();

$kelompok = array();
$i = 1;
//Dapatkan user
$select = $koneksi->prepare("select nama_kelompok from mutarabbi where nama_murabbi='$nama_murabbi' GROUP BY nama_kelompok;");
$select->execute();
$select->store_result();
$select->bind_result($nama_kelompok);
while($select->fetch()){
    $kelompok[$i] = $nama_kelompok;
    $i++;
}
                $sql = "SELECT count(nama_kelompok) from mutarabbi WHERE nama_murabbi = '$nama_murabbi' GROUP BY nama_kelompok"; // syntax SQL
                
                $result = $koneksi->query($sql); // eksekusi perintah SQL
                
                $jumlah_kelompok = $result->num_rows;


                $nonaktif = 0;
                $nasihat = 0;
                $alasan = 0;
                $select = $koneksi->prepare("select `nama_mutarabbi` from `rekap_mutarabbi` where `nama_murabbi`='$nama_murabbi' and `nama_kelompok`='$nama_kelompok' and `tahun`='$tahun_pilihan' ORDER BY nama_kelompok, nama_mutarabbi ASC");
                $select->execute();
                $select->store_result();
                $select->bind_result($nama_mutarabbi);
                while($select->fetch())
                {
                    $sql = "SELECT * FROM `laporan` where bulan = '$bulan[$bulan_lalu]' and kehadiran = 'Tidak' and tahun = '$tahun_sekarang' and nama_murabbi = '$nama_murabbi' and nama_mutarabbi = '$nama_mutarabbi' order by pekan ASC;"; // syntax SQL
                    $sql2 = "SELECT * FROM `laporan` where bulan = '$bulan[$bulan_sekarang]' and kehadiran = 'Tidak' and tahun = '$tahun_sekarang' and nama_murabbi = '$nama_murabbi' and nama_mutarabbi = '$nama_mutarabbi' order by pekan ASC;"; // syntax SQL
                
                    $result = $koneksi->query($sql); // eksekusi perintah SQL
                    $result2 = $koneksi->query($sql2); // eksekusi perintah SQL
                    
                    $jumlah_absen = $result->num_rows;
                    $jumlah_absen2 = $result2->num_rows;

                    if($jumlah_absen == 4){
                        $nonaktif ++;
                    }
                    if($jumlah_absen == 3){
                        $nasihat ++;
                    }
                    if($jumlah_absen2 >= 1){
                        $alasan ++;
                    }
                }

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
	<title>Sistem Informasi Halaqah</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"  media="screen,projection"/>

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
<body class="teal darken-3">
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
            <li style="padding-left: 15px;">Dashboard Murabbi</li>
        </ul>
        
        <ul class="right hide-on-med-and-down">
            <li><a href="#"><strong><?=$nama_murabbi;?></strong></a></li>
            <li><a href="keluar.php">Keluar</a></li>
        </ul>
        
        <ul class="side-nav" id="mobile-mode">
            <li><a href="lihat_mutarabbi.php">Data Kelompok</a></li>
            <li><a href="laporan_halaqah.php">Laporan Halaqah</a></li>
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

<div class="row hide-on-med-and-down">
        <div class="col s12 m7" style="margin-left: 300px; margin-right: 300px;">
          <div class="card teal lighten-4">
            <div class="card-image">
              <img src="../images/Screen.png" style="width: 100%;">
            </div>
            <div class="card-action center" style="padding-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px;">
            <div class="row">
            <div class="col s3 hoverable">
            <a href="lihat_mutarabbi.php">            
                <img src="../icons/Data_Kelompok.png" style="width:50%;"><br>
                <h6 style="color: black;"><strong>Data Kelompok</strong></h6>                    
            </a>
            </div>
            <div class="col s3 hoverable">
            <a href="laporan_halaqah.php">
                <img src="../icons/Laporan_Halaqah.png" style="width:50%;"><br>
                <h6 style="color: black;"><strong>Laporan Halaqah</strong></h6> 
            </a>
            </div>
            <div class="col s3 hoverable">
            <a href="rekap_presensi.php">
                    <img src="../icons/Rekap_Presensi.png" style="width:50%;"><br>
                    <h6 style="color: black;"><strong>Rekap Presensi</strong></h6>                    
            </a>
            </div>
            <div class="col s3 hoverable">
            <a href="pusat_madah.php">
                    <img src="../icons/Pusat madah.png" style="width:50%;"><br>
                    <h6 style="color: black;"><strong>Pusat Madah</strong></h6>                    
            </a>
            </div>
            </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row hide-on-large-only">
        <div class="col s12 m7">
          <div class="card teal lighten-4">
            <div class="card-image">
              <img src="../images/Screen.png" style="width: 100%;">
            </div>
            <div class="card-action center" style="padding-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px;">
            <div class="row hoverable">
            <a href="lihat_mutarabbi.php">            
                <img src="../icons/Data_Kelompok.png" style="width:10%;">
                <strong style="color: black;">Data Kelompok</strong>                   
            </a>
            </div>
            <div class="row hoverable">
            <a href="laporan_halaqah.php">
                <img src="../icons/Laporan_Halaqah.png" style="width:10%;">
                <strong style="color: black;">Laporan Halaqah</strong>
            </a>
            </div>
            <div class="row hoverable">
            <a href="rekap_presensi.php">
                    <img src="../icons/Rekap_Presensi.png" style="width:10%;">
                    <strong style="color: black;">Rekap Presensi</strong>                
            </a>
            </div>
            <div class="row hoverable">
            <a href="pusat_madah.php">
                    <img src="../icons/Pusat madah.png" style="width:10%;">
                    <strong style="color: black;">Pusat Madah</strong>                
            </a>
            </div>
            </div>
            </div>
          </div>
        </div>
      </div>

      <button id="tombolScrollTop" class="btn-floating waves-effect waves-light" onclick="scrolltotop()" style="float: right; margin: 0 20px 20px 0;"><i class="material-icons">arrow_upward</i></button>



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