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

//Dapatkan jumlah murabbi
$select = $koneksi->prepare("SELECT count(nama_murabbi) from murabbi WHERE nama_murabbi!='LTT' and nama_murabbi!='Uji Coba';");
$select->execute();
$select->store_result();
$select->bind_result($jumlah_murabbi);
$select->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
	<title>Data Murabbi</title>

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
            <li><a href="data_mutarabbi.php">Data Mutarabbi</a></li>
            <li><a href="rekap_laporan.php">Rekap Laporan</a></li>            
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a href="#"><strong><?=$nama_murabbi;?></strong></a></li>
            <li><a href="keluar.php">Keluar</a></li>
        </ul>
        <ul class="right hide-on-large-only">
            <li><a href="index.php"><i class="material-icons">arrow_back</i></a></li>
        </ul>
        
        <ul class="side-nav" id="mobile-mode">
            <li class="active"><a href="data_murabbi.php">Data Murabbi</a></li>
            <li><a href="data_mutarabbi.php">Data Mutarabbi</a></li>
            <li><a href="rekap_laporan.php">Rekap Laporan</a></li>   
            <div class="divider"></div>
              <li><a href="#"><strong><?=$nama_murabbi;?></strong></a></li>
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
            </div>
        </div>
      </div>
    </nav>

<div class="container">
<h2>Data Murabbi</h2>
Jumlah: <?=$jumlah_murabbi;?> orang
<div class="table-responsive">
<table class="border striped">
	<tr>
		<th>No.</th>
		<th>Nama</th>
		<th>Prodi</th>
		<th>Angkatan</th>
		<th>Jumlah Kelompok</th>
		<th>Jumlah Binaan</th>
		<th>Tindakan</th>
	</tr>
	<?php
	$i = 1;
	$select = $koneksi->prepare("SELECT murabbi.id_murabbi, murabbi.nama_murabbi, murabbi.prodi, murabbi.angkatan from murabbi WHERE murabbi.nama_murabbi != 'LTT' and murabbi.nama_murabbi != 'Uji Coba' GROUP BY murabbi.nama_murabbi ORDER BY murabbi.nama_murabbi ASC;");
				$select->execute();
				$select->store_result();
				$select->bind_result($id_murabbi, $nama_murabbi, $prodi, $angkatan);
				while($select->fetch())
				{
				$sql = "SELECT count(nama_kelompok) from mutarabbi WHERE nama_murabbi = '$nama_murabbi' GROUP BY nama_kelompok"; // syntax SQL
				$sql2 = "SELECT mutarabbi.nama_mutarabbi from mutarabbi where mutarabbi.nama_murabbi='$nama_murabbi' ORDER BY mutarabbi.nama_mutarabbi";
 
				$result = $koneksi->query($sql); // eksekusi perintah SQL
				$result2 = $koneksi->query($sql2);
				$jumlah_kelompok = $result->num_rows;
				$jumlah_binaan = $result2->num_rows;
				?>
	<tr>
		<td><?=$i++;?></td>
		<td><?=$nama_murabbi;?></td>
		<td><?=$prodi;?></td>
		<td><?=$angkatan;?></td>
		<td><?=$jumlah_kelompok;?></td>
		<td><?=$jumlah_binaan;?></td>
		<td><a href="lihat_binaan.php?id=<?=$id_murabbi;?>">Lihat Binaan</a> | <a href="edit_murabbi.php?id=<?=$id_murabbi;?>">Edit</a> | <a href="hapus_murabbi.php?id=<?=$id_murabbi;?>" onclick="return confirm('Yakin Ingin Menghapus Murabbi?');"">Hapus</a></td>
	</tr>
	<?php
				}
				?>
</table>
<br>
</div>
  <a href="tambah_murabbi.php" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a><label> Tambah Murabbi</label>
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
    </script>

</body>
</html>