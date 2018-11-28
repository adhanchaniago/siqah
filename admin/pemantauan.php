<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];
$tahun = date("Y");

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

if(!isset($_POST['jenis_kelamin_pilih'])){
  $jenis_kelamin_pilih = "Ikhwan";
  $angkatan_pilih = "2015 keatas";
  $jenjang_pilih = "1";
  $tahun_pilih = "2017";
  if( date('d') % 7 == 0){
    $pekan_pilih = date('d')/7;
  }
  else{
    $pekan_pilih = (int)(date('d')/7)+1;
  }
  $bulan_pilih = $bulan[date("m")];
  $tahun_pilih = $tahun;
}
else{
  $jenis_kelamin_pilih = $_POST['jenis_kelamin_pilih'];
  $angkatan_pilih = $_POST['angkatan_pilih'];
  $pekan_pilih = $_POST['pekan_pilih'];
  $bulan_pilih = $_POST['bulan_pilih'];
  $jenjang_pilih = $_POST['jenjang_pilih'];
  $tahun_pilih = $_POST['tahun_pilih'];
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

//Dapatkan jumlah kelompok
$queryJumlahKelompok = "SELECT * FROM `rekap` where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and jenis_kelamin = '$jenis_kelamin_pilih' and angkatan_kelompok = '$angkatan_pilih' and jenjang = '$jenjang_pilih' GROUP BY nama_kelompok";

if ($result2 = mysqli_query($koneksi, $queryJumlahKelompok)) {

    /* determine number of rows result set */
    $row_cnt2 = mysqli_num_rows($result2);

    $jumlah_kelompok = $row_cnt2;

    /* close result set */
    mysqli_free_result($result2);
}

//Dapatkan jumlah yang lapor
$queryJumlahLaporan = "SELECT rekap.nama_murabbi, status_laporan.nama_kelompok, laporan, berjalan FROM status_laporan, rekap where status_laporan.nama_murabbi = rekap.nama_murabbi and status_laporan.nama_kelompok = rekap.nama_kelompok and status_laporan.pekan='$pekan_pilih' and status_laporan.bulan='$bulan_pilih' and status_laporan.tahun='$tahun_pilih' and jenis_kelamin = '$jenis_kelamin_pilih' and rekap.angkatan_kelompok = '$angkatan_pilih' and rekap.jenjang = '$jenjang_pilih' and rekap.nama_murabbi = status_laporan.nama_murabbi GROUP BY status_laporan.nama_kelompok;";

if ($result = mysqli_query($koneksi, $queryJumlahLaporan)) {

    /* determine number of rows result set */
    $row_cnt = mysqli_num_rows($result);

    $jumlah_laporan = $row_cnt;

    /* close result set */
    mysqli_free_result($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
	<title>Pemantauan</title>

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
            <li class="active"><a href="pemantauan.php">Pemantauan</a></li>
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
            <li><a href="data_murabbi.php">Data Murabbi</a></li>
            <li><a href="rekap_laporan.php">Rekap Laporan</a></li>
            <li class="active"><a href="pemantauan.php">Pemantauan</a></li>  
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
                <a href="" class="breadcrumb">Pemantauan</a>
            </div>
        </div>
      </div>
    </nav>

<div class="container">
<h2>Pemantauan</h2>
<form method="post" action="pemantauan.php">
<div class="row">
<div class="input-field col s4">
<select name="jenis_kelamin_pilih" id="jenis_kelamin_pilih">
      <option value="Ikhwan">Ikhwan</option>
      <option value="Akhwat">Akhwat</option>
</select>
<label>Jenis Kelamin</label>
</div>
<div class="input-field col s4">
<select name="angkatan_pilih" id="angkatan_pilih">
      <option value="2015 keatas">2015 keatas</option>
      <option value="2016">2016</option>
      <option value="2017">2017</option>
</select>
<label>Angkatan</label>
</div>
<div class="input-field col s4">
<select name="jenjang_pilih" id="jenjang_pilih">
      <option value="1">1</option>
      <option value="2">2</option>
</select>
<label>Kelas</label>
</div>
</div>
<div class="row">
<div class="input-field col s4">
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
<div class="input-field col s4">
<select name="tahun_pilih" id="tahun_pilih">
      <?php
            for($i=2017; $i<=$tahun; $i++)
            {
            ?>
        <option value="<?=$i;?>"><?=$i;?></option>
        <?php
        }?>
</select>
<label>Tahun</label>
</div>
</div>
<div class="row">
<div class="input-field col s2">
<button type="submit" class="waves-effect waves-light btn z-depth-3" name="Lihat">Lihat</button>
</div>
</div>
</form>
Jumlah Laporan: <?=$jumlah_laporan;?> kelompok
<div class="table-responsive">
<table class="border striped">
	<tr>
		<th>No.</th>
		<th>Nama Murabbi</th>
		<th>Nama Kelompok</th>
		<th>Laporan</th>
		<th>Berjalan</th>
	</tr>
	<?php
	$i = 1;
	$select = $koneksi->prepare("SELECT rekap.nama_murabbi, rekap.nama_kelompok, laporan, berjalan FROM status_laporan, rekap where status_laporan.nama_murabbi = rekap.nama_murabbi and status_laporan.nama_kelompok = rekap.nama_kelompok and status_laporan.pekan='$pekan_pilih' and status_laporan.bulan='$bulan_pilih' and status_laporan.tahun='$tahun_pilih' and jenis_kelamin = '$jenis_kelamin_pilih' and rekap.angkatan_kelompok = '$angkatan_pilih' and rekap.jenjang = '$jenjang_pilih' and rekap.nama_murabbi = status_laporan.nama_murabbi GROUP BY status_laporan.nama_kelompok ORDER BY rekap.nama_murabbi ASC;");
				$select->execute();
				$select->store_result();
				$select->bind_result($nama_murabbi, $nama_kelompok, $laporan, $berjalan);
        while ($select->fetch()) {
          $nama_murabbi_lapor[$i] = $nama_murabbi;
          $nama_kelompok_lapor[$i] = $nama_kelompok;
				?>
	<tr>
		<td><?=$i++;?></td>
		<td><?=$nama_murabbi;?></td>
		<td><?=$nama_kelompok;?></td>  
		<td><?=$laporan;?></td>
		<td><?=$berjalan;?></td>
	</tr>
<?php
}
?>
</table>
</div>
<h4>Yang Belum Laporan: <?=$jumlah_kelompok - $jumlah_laporan;?> kelompok</h4>
<div class="table-responsive">
<table class="border striped">
  <tr>
    <th>No.</th>
    <th>Nama Murabbi</th>
    <th>Nama Kelompok</th>
  </tr>
  <?php
  if($jumlah_laporan == 0){
    $i = 1;
  $select = $koneksi->prepare("SELECT nama_murabbi, nama_kelompok FROM `rekap` where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and jenis_kelamin = '$jenis_kelamin_pilih' and angkatan_kelompok = '$angkatan_pilih' and jenjang = '$jenjang_pilih' GROUP BY nama_kelompok;");
        $select->execute();
        $select->store_result();
        $select->bind_result($nama_murabbi, $nama_kelompok);
        while ($select->fetch()) {
        ?>
  <tr>
    <td><?=$i++;?></td>
    <td><?=$nama_murabbi;?></td>
    <td><?=$nama_kelompok;?></td>  
  </tr>
  <?php
  }
}
  else{
  $k = 1;
  $select = $koneksi->prepare("SELECT nama_murabbi, nama_kelompok FROM `rekap` where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and jenis_kelamin = '$jenis_kelamin_pilih' and angkatan_kelompok = '$angkatan_pilih' and jenjang = '$jenjang_pilih' GROUP BY nama_kelompok ORDER BY nama_murabbi");
        $select->execute();
        $select->store_result();
        $select->bind_result($nama_murabbi, $nama_kelompok);
        while ($select->fetch()) {
          $nama_murabbi_all[$k] = $nama_murabbi;
          $nama_kelompok_all[$k] = $nama_kelompok;
          $k++;
        }
        $a = 1;
//        print_r($nama_murabbi_all); echo "<br>";
//        print_r($nama_murabbi_lapor); echo "<br>";
//        print_r($nama_kelompok_all); echo "<br>";
//        print_r($nama_kelompok_lapor); echo "<br>";
          $TampungArray = array_diff($nama_murabbi_all, $nama_murabbi_lapor);
          $TampungArray2 = array_diff($nama_kelompok_all, $nama_kelompok_lapor);
//        print_r($TampungArray); echo "<br>";
//        print_r($TampungArray2); echo "<br>";
//          $KeyTampungArray = array_keys($TampungArray);
//          $KeyTampungArray2 = array_keys($TampungArray2);
//          print_r($KeyTampungArray); echo "<br>";
//          print_r($KeyTampungArray2); echo "<br>";
//          $Bandingkan = array_diff($KeyTampungArray2, $KeyTampungArray);
//          print_r($Bandingkan); echo "<br>";
        foreach ($TampungArray2 as $hasil2) {
          $select = $koneksi->prepare("SELECT nama_murabbi FROM `rekap_mutarabbi` where nama_kelompok = '$hasil2' group by nama_kelompok");
        $select->execute();
        $select->store_result();
        $select->bind_result($hasil1);
        while ($select->fetch()) {
  ?>
        <tr>
          <td><?=$a++;?></td>
          <td><?=$hasil1;?></td>  
          <td><?=$hasil2;?></td>
        </tr>
        <?php
        }
        }
      }
        ?>
</table>
</div>
</div>
<br>
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

        $('#jenis_kelamin_pilih option[value="<?=$jenis_kelamin_pilih;?>"]').attr('selected','selected');
        $('#angkatan_pilih option[value="<?=$angkatan_pilih;?>"]').attr('selected','selected');
        $('#pekan_pilih option[value="<?=$pekan_pilih;?>"]').attr('selected','selected');
        $('#bulan_pilih option[value="<?=$bulan_pilih;?>"]').attr('selected','selected');
        $('#tahun_pilih option[value="<?=$tahun_pilih;?>"]').attr('selected','selected');
        $('#jenjang_pilih option[value="<?=$jenjang_pilih;?>"]').attr('selected','selected');
    </script>

</body>
</html>