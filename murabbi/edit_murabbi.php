<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];
$id_murabbi = $_GET['id'];

//Dapatkan data lengkap murabbi
$select = $koneksi->prepare("SELECT nama_murabbi, prodi, angkatan, nama_pengguna, kata_sandi FROM murabbi WHERE id_murabbi=$id_murabbi;");
$select->execute();
$select->store_result();
$select->bind_result($nama_murabbi, $prodi, $angkatan, $nama_pengguna_baru, $kata_sandi_baru);
$select->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
	<title>Edit Data Murabbi</title>

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
            <li><a href="data_mutarabbi.php">Data Mutarabbi</a></li>
            <li><a href="rekap_laporan.php">Rekap Laporan</a></li>            
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a href="#"><strong>LTT</strong></a></li>
            <li><a href="keluar.php">Keluar</a></li>
        </ul>
        <ul class="right hide-on-large-only">
            <li><a href="data_murabbi.php"><i class="material-icons">arrow_back</i></a></li>
        </ul>
        
        <ul class="side-nav" id="mobile-mode">
            <li class="active"><a href="data_murabbi.php">Data Murabbi</a></li>
            <li><a href="data_mutarabbi.php">Data Mutarabbi</a></li>
            <li><a href="rekap_laporan.php">Rekap Laporan</a></li>   
            <div class="divider"></div>
            <li><a href="#"><strong>LTT</strong></a></li>
            <div class="divider"></div>
            <li><a href="#">Pengaturan</a></li>
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
            <a href="" class="breadcrumb">Edit Data</a>
          </div>
        </div>
      </div>
    </nav>      

<div class="container">
<h2>Edit Murabbi</h2>
<form method="post" action="proses_edit_murabbi.php" onsubmit="return confirm('Yakin Ingin Mengedit Murabbi?');">
	<input type="hidden" name="id_murabbi" value="<?=$id_murabbi;?>">
	<div class="row">
        <div class="input-field col s12">
            <input type="text" name="nama_murabbi" value="<?=$nama_murabbi;?>" required></br>
            <label for="nama_murabbi">Nama Murabbi</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s4">
            <select name="prodi" id="prodi">
            <?php
            $select = $koneksi->prepare("SELECT prodi FROM prodi ORDER BY id_prodi ASC;");
                        $select->execute();
                        $select->store_result();
                        $select->bind_result($prodi_db);
                        while($select->fetch())
                        {
                        ?>
                <option value="<?=$prodi_db;?>"><?=$prodi_db;?></option>
                <?php
                }?>
            </select>
            <label>Prodi</label>
        </div>
        <div class="input-field col s4">
            <input type="text" name="angkatan" value="<?=$angkatan;?>" required></br>
            <label>Angkatan</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input type="text" name="nama_pengguna_baru" value="<?=$nama_pengguna_baru;?>" required></br>
            <label for="nama_pengguna_baru">Nama Pengguna</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input type="text" name="kata_sandi_baru" value="<?=$kata_sandi_baru;?>" required></br>
            <label for="kata_sandi_baru">Kata Sandi</label>
        </div>
    </div>
	<button type="submit" class="waves-effect waves-light btn z-depth-3" name="edit">Edit</button> 
</form>
</div>
<br>

<button id="tombolScrollTop" class="btn-floating waves-effect waves-light" onclick="scrolltotop()" style="float: right; margin: 0 20px 20px 0;"><i class="material-icons">arrow_upward</i></button>

<footer class="page-footer teal darken-4">
          <div class="footer-copyright">
            <div class="container">
                © 2017 Copyright MR
            <a class="grey-text text-lighten-4 right" href="#!">Tutorial Penggunaan</a>
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

        $('#prodi option[value="<?=$prodi;?>"]').attr('selected','selected');
    </script>
</body>
</html>