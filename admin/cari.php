<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
	<title>Pencarian Data</title>

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
            <li><a href="data_murabbi.php">Data Murabbi</a></li>
            <li><a href="rekap_laporan.php">Rekap Laporan</a></li>      
            <li><a href="pemantauan.php">Pemantauan</a></li>
            <li><a href="pusat_madah.php">Pusat Madah</a></li>      
        </ul>
        <ul class="right hide-on-med-and-down">
            <li class="active"><a href="cari.php"><i class="material-icons">search</i></a></li>
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
              <li class="active"><a href="cari.php"><i class="material-icons">search</i></a></li>
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
                <a href="" class="breadcrumb">Pencarian Data</a>
            </div>
        </div>
      </div>
    </nav>

<div class="container">
<h2>Pencarian Data</h2>
<form method="post" action="cari.php">
<div class="row">
  <div class="input-field col s6">
    <input type="text" name="yangdicari">
    <label>Cari</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s6">
    <select name="kategori" id="kategori">
          <option value="Nama Murabbi">Nama Murabbi</option>
          <option value="Nama Mutarabbi">Nama Mutarabbi</option>
          <option value="Prodi Murabbi">Prodi Murabbi</option>
          <option value="Prodi Mutarabbi">Prodi Mutarabbi</option>
          <option value="Angkatan Murabbi">Angkatan Murabbi</option>
          <option value="Angkatan Mutarabbi">Angkatan Mutarabbi</option>
    </select>
    <label>Kategori</label>
  </div>
</div>
<div class="row">
<div class="input-field col s2">
<button type="submit" class="waves-effect waves-light btn z-depth-3" name="cari">Cari</button>
</div>
</div>
</form>

<?php
if(!isset($_POST['yangdicari'])){
  echo 'Tidak Ada Yang Dicari';
  $kategori = "Nama Murabbi";
}
else{
  $yangdicari = $_POST['yangdicari'];  
  $kategori = $_POST['kategori'];
  $like = '%' . $yangdicari . '%';

  if($kategori == "Nama Murabbi"){
    $uber = "select nama_murabbi, prodi, angkatan, jenis_kelamin, nama_pengguna from murabbi where nama_murabbi like '$like';";
    $mirip = "select count(nama_murabbi) from murabbi where nama_murabbi like '$like';";
  }
  else if($kategori == "Nama Mutarabbi"){
   $uber = "select mutarabbi.nama_mutarabbi, mutarabbi.prodi, mutarabbi.angkatan, murabbi.jenis_kelamin, mutarabbi.nama_murabbi from mutarabbi, murabbi where mutarabbi.nama_murabbi = murabbi.nama_murabbi and mutarabbi.nama_mutarabbi like '$like';"; 
   $mirip = "select count(nama_mutarabbi) from mutarabbi where nama_mutarabbi like '$like';";
  }
  else if($kategori == "Prodi Murabbi"){
   $uber = "select nama_murabbi, prodi, angkatan, jenis_kelamin, nama_pengguna from murabbi where prodi like '$like';"; 
   $mirip = "select count(nama_murabbi) from murabbi where prodi like '$like';";
  }
  else if($kategori == "Prodi Mutarabbi"){
   $uber = "select mutarabbi.nama_mutarabbi, mutarabbi.prodi, mutarabbi.angkatan, murabbi.jenis_kelamin, mutarabbi.nama_murabbi from mutarabbi, murabbi where mutarabbi.nama_murabbi = murabbi.nama_murabbi and mutarabbi.prodi like '$like';"; 
   $mirip = "select count(nama_mutarabbi) from mutarabbi where prodi like '$like';";
  }
  else if($kategori == "Angkatan Murabbi"){
   $uber = "select nama_murabbi, prodi, angkatan, jenis_kelamin, nama_pengguna from murabbi where angkatan like '$like';"; 
   $mirip = "select count(nama_murabbi) from murabbi where angkatan like '$like';";
  }
  else if($kategori == "Angkatan Mutarabbi"){
   $uber = "select mutarabbi.nama_mutarabbi, mutarabbi.prodi, mutarabbi.angkatan, murabbi.jenis_kelamin, mutarabbi.nama_murabbi from mutarabbi, murabbi where mutarabbi.nama_murabbi = murabbi.nama_murabbi and mutarabbi.angkatan like '$like';"; 
   $mirip = "select count(nama_mutarabbi) from mutarabbi where angkatan like '$like';";
  }
  //Dapatkan jumlah pencarian
$select = $koneksi->prepare($mirip);
$select->execute();
$select->store_result();
$select->bind_result($jumlah_pencarian);
$select->fetch();
?>
Pencarian <?=$kategori?> untuk <?=$yangdicari?></br>
Jumlah: <?=$jumlah_pencarian;?> orang
<div class="table-responsive">
<table class="border striped">
	<tr>
		<th>No.</th>
		<th>Nama</th>
		<th>Prodi</th>
		<th>Angkatan</th>
    <th>Jenis Kelamin</th>
    <th>Status</th>
	</tr>
	<?php
	$i = 1;
	$select = $koneksi->prepare($uber);
				$select->execute();
				$select->store_result();
				$select->bind_result($nama, $prodi, $angkatan, $jenis_kelamin, $status);
				while($select->fetch())
				{
				?>
	<tr>
		<td><?=$i++;?></td>
		<td><?=$nama;?></td>
		<td><?=$prodi;?></td>
		<td><?=$angkatan;?></td>
    <td><?=$jenis_kelamin;?></td>
    <td><?=$status;?></td>
	</tr>
	<?php
				}
				?>
</table>
<?php
}
?>
<br>
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

        $('#kategori option[value="<?=$kategori;?>"]').attr('selected','selected');
    </script>

</body>
</html>