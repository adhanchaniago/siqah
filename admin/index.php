<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];

//Dapatkan user
$select = $koneksi->prepare("SELECT nama_murabbi FROM murabbi WHERE nama_pengguna='$nama_pengguna';");
$select->execute();
$select->store_result();
$select->bind_result($nama_murabbi);
$select->fetch();

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

if(!isset($_POST['pilih_murabbi'])){
    $data_murabbi = "Mujahid Robbani Sholahudin";
}
else{
    $data_murabbi = $_POST['pilih_murabbi'];
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

$kelompok = array();
$i = 1;
//Dapatkan user
$select = $koneksi->prepare("select nama_kelompok from mutarabbi where nama_murabbi='$data_murabbi' GROUP BY nama_kelompok;");
$select->execute();
$select->store_result();
$select->bind_result($nama_kelompok);
while($select->fetch()){
    $kelompok[$i] = $nama_kelompok;
    $i++;
}


$petir = mysqli_query($koneksi, "SELECT pekan, count(nama_mutarabbi), nama_kelompok FROM laporan WHERE nama_kelompok='Petir' GROUP BY nama_kelompok, pekan ORDER by pekan ASC");

$spongebob = mysqli_query($koneksi, "SELECT pekan, count(nama_mutarabbi), nama_kelompok FROM laporan WHERE nama_kelompok='Spongebob' GROUP BY nama_kelompok, pekan ORDER by pekan ASC");

                $sql = "SELECT count(nama_kelompok) from mutarabbi WHERE nama_murabbi = '$data_murabbi' GROUP BY nama_kelompok"; // syntax SQL
                
                $result = $koneksi->query($sql); // eksekusi perintah SQL
                
                $jumlah_kelompok = $result->num_rows;
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
            <li style="padding-left: 15px;">Dashboard Admin</li>     
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
            <li><a href="data_murabbi.php">Data Murabbi</a></li>
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

    <div class="row hide-on-med-and-down">
        <div class="col s12 m7" style="margin-left: 300px; margin-right: 300px;">
          <div class="card teal lighten-4">
            <div class="card-image">
              <img src="../images/Screen.png" style="width: 100%;">
            </div>
            <div class="card-action center" style="padding-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px;">
            <div class="row">
            <div class="col s3 hoverable">
            <a href="data_murabbi.php">            
                <img src="../icons/Data_Murabbi.png" style="width:50%;"><br>
                <h6 style="color: black;"><strong>Data Murabbi</strong></h6>                    
            </a>
            </div>
            <div class="col s3 hoverable">
            <a href="rekap_laporan.php">
                    <img src="../icons/Rekap_Laporan.png" style="width:50%;"><br>
                    <h6 style="color: black;"><strong>Rekap Laporan</strong></h6>                    
            </a>
            </div>
            <div class="col s3 hoverable">
            <a href="pemantauan.php">
                    <img src="../icons/Pemantauan.png" style="width:50%;"><br>
                    <h6 style="color: black;"><strong>Pemantauan</strong></h6>                    
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
            <a href="data_murabbi.php">            
                <img src="../icons/Data_Murabbi.png" style="width:10%;">
                <strong style="color: black;">Data Murabbi</strong>                   
            </a>
            </div>
            <div class="row hoverable">
            <a href="rekap_laporan.php">
                    <img src="../icons/Rekap_Laporan.png" style="width:10%;">
                    <strong style="color: black;">Rekap Laporan</strong>                
            </a>
            </div>
            <div class="row hoverable">
            <a href="pemantauan.php">
                    <img src="../icons/Pemantauan.png" style="width:10%;">
                    <strong style="color: black;">Pemantauan</strong>                
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