<?php
include "../koneksi.php";
include "akses.php";
$nama_pengguna = $_SESSION['nama_pengguna'];

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

if(!isset($_POST['Lihat'])){
  $angkatan_kelompok_pilih = "2016 keatas";
  $jenis_kelamin_pilih = "Ikhwan";
  $jenjang_pilih = '1';
  $bulan_pilih = $bulan[date("m")];
  $tahun_pilih = date("Y");
}
else{
  $angkatan_kelompok_pilih = $_POST['angkatan_kelompok_pilih'];
  $jenis_kelamin_pilih = $_POST['jenis_kelamin_pilih'];
  $jenjang_pilih = $_POST['jenjang_pilih'];
  $bulan_pilih = $_POST['bulan_pilih'];
  $tahun_pilih = $_POST['tahun_pilih'];
}

//Dapatkan user
$select = $koneksi->prepare("SELECT nama_murabbi FROM murabbi WHERE nama_pengguna='$nama_pengguna';");
$select->execute();
$select->store_result();
$select->bind_result($nama_murabbi);
$select->fetch();

//Dapatkan jumlah murabbi
$queryJumlahMurabbi = "SELECT * FROM `rekap` where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and jenis_kelamin = '$jenis_kelamin_pilih' and angkatan_kelompok = '$angkatan_kelompok_pilih' and jenjang = '$jenjang_pilih' GROUP BY nama_murabbi";

if ($result = mysqli_query($koneksi, $queryJumlahMurabbi)) {

    /* determine number of rows result set */
    $row_cnt = mysqli_num_rows($result);

    $jumlah_murabbi = $row_cnt;

    /* close result set */
    mysqli_free_result($result);
}

//Dapatkan jumlah kelompok
$queryJumlahKelompok = "SELECT * FROM `rekap` where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and jenis_kelamin = '$jenis_kelamin_pilih' and angkatan_kelompok = '$angkatan_kelompok_pilih' and jenjang = '$jenjang_pilih' GROUP BY nama_kelompok";

if ($result2 = mysqli_query($koneksi, $queryJumlahKelompok)) {

    /* determine number of rows result set */
    $row_cnt2 = mysqli_num_rows($result2);

    $jumlah_kelompok = $row_cnt2;

    /* close result set */
    mysqli_free_result($result2);
}

//Dapatkan jumlah mutarabbi
$queryJumlahMutarabbi = "SELECT mutarabbi.nama_mutarabbi, mutarabbi.nama_murabbi from mutarabbi, rekap where rekap.nama_murabbi!='LTT' and rekap.nama_murabbi!='Uji Coba' and rekap.angkatan_kelompok ='$angkatan_kelompok_pilih' and rekap.jenis_kelamin ='$jenis_kelamin_pilih' and rekap.jenjang = '$jenjang_pilih' and mutarabbi.nama_kelompok=rekap.nama_kelompok and mutarabbi.status='Aktif' GROUP BY mutarabbi.nama_mutarabbi, mutarabbi.nama_murabbi";

if ($result3 = mysqli_query($koneksi, $queryJumlahMutarabbi)) {

    /* determine number of rows result set */
    $row_cnt3 = mysqli_num_rows($result3);

    $jumlah_mutarabbi = $row_cnt3;

    /* close result set */
    mysqli_free_result($result3);
}

//Dapatkan jumlah mutarabbi
$queryJumlahMutarabbiNon = "SELECT mutarabbi.nama_mutarabbi, mutarabbi.nama_murabbi from mutarabbi, rekap where rekap.nama_murabbi!='LTT' and rekap.nama_murabbi!='Uji Coba' and rekap.angkatan_kelompok ='$angkatan_kelompok_pilih' and rekap.jenis_kelamin ='$jenis_kelamin_pilih' and rekap.jenjang = '$jenjang_pilih' and mutarabbi.nama_kelompok=rekap.nama_kelompok and mutarabbi.status='Nonaktif' GROUP BY mutarabbi.nama_mutarabbi, mutarabbi.nama_murabbi";

if ($result4 = mysqli_query($koneksi, $queryJumlahMutarabbiNon)) {

    /* determine number of rows result set */
    $row_cnt4 = mysqli_num_rows($result4);

    $jumlah_mutarabbi_non = $row_cnt4;

    /* close result set */
    mysqli_free_result($result4);
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
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
	<title>Rekapitulasi Laporan</title>
	<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>

    <meta charset="utf-8">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Import Chart-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

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
            <li class="active"><a href="rekap_laporan.php">Rekap Laporan</a></li>      
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
            <li><a href="data_murabbi.php">Data Murabbi</a></li>
            <li class="active"><a href="rekap_laporan.php">Rekap Laporan</a></li>
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
                <a href="rekap_laporan.php" class="breadcrumb">Rekap Laporan</a>
            </div>
        </div>
      </div>
    </nav>

<div class="container">
<h2>Rekapitulasi Laporan</h2>
<form method="post" action="rekap_laporan.php">
<div class="row">
<div class="input-field col s2">
<select name="jenis_kelamin_pilih" id="jenis_kelamin_pilih">
      <option value="Ikhwan">Ikhwan</option>
      <option value="Akhwat">Akhwat</option>
</select>
<label>Jenis Kelamin</label>
</div>
<div class="input-field col s3">
<select name="angkatan_kelompok_pilih" id="angkatan_kelompok_pilih">
      <option value="2016 keatas">2016 keatas</option>
      <option value="2017">2017</option>
</select>
<label>Angkatan Kelompok</label>
</div>
<div class="input-field col s2">
<select name="jenjang_pilih" id="jenjang_pilih">
      <option value="1">1</option>
      <option value="2">2</option>
</select>
<label>Kelas</label>
</div>
<div class="input-field col s3">
<select name="bulan_pilih" id="bulan_pilih">
    <?php
    for($i=1;$i<=12;$i++){
        ?>
      <option value="<?=$bulan[$i];?>"><?=$bulan[$i];?></option>
    <?php
    }
    ?>
</select>
<label>Bulan</label>
</div>
<div class="input-field col s2">
<select name="tahun_pilih" id="tahun_pilih">
    <?php
    for($i=2017;$i<=date("Y");$i++){
        ?>
      <option value="<?=$i;?>"><?=$i?></option>
    <?php
    }
    ?>
</select>
<label>Tahun</label>
</div>
</div>
<center>
<div class="input-field col s2">
<button type="submit" class="waves-effect waves-light btn z-depth-3" name="Lihat">Lihat</button>
<button type="submit" class="waves-effect waves-light btn z-depth-3" name="Cetak" formaction="export_rekap.php?jenis_kelamin_pilih=<?=$jenis_kelamin_pilih;?>&angkatan_kelompok_pilih=<?=$angkatan_kelompok_pilih;?>&jenjang_pilih=<?=$jenjang_pilih;?>&bulan_pilih=<?=$bulan_pilih;?>&tahun_pilih=<?=$tahun_pilih;?>">Cetak</button>
</div>
</center>
</form>
<br>
<center>
<canvas id="myChart" style="position: relative; height:30vh; width:60vw"></canvas>
</center>

Jenis Kelamin: <?=$jenis_kelamin_pilih;?> </br>
Angkatan Kelompok: <?=$angkatan_kelompok_pilih;?> </br>
Kelas: <?=$jenjang_pilih;?> </br>
Jumlah Murabbi: <?=$jumlah_murabbi;?> orang </br>
Jumlah Mutarabbi Aktif: <?=$jumlah_mutarabbi;?> orang </br>
Jumlah Mutarabbi Non-Aktif: <?=$jumlah_mutarabbi_non;?> orang </br>
Jumlah Kelompok: <?=$jumlah_kelompok;?> kelompok </br>

<div class="table-responsive">
<table class="bordered striped">
	<tr>
		<th rowspan="2">No.</th>
		<th rowspan="2">Nama Murabbi</th>
		<th rowspan="2">Nama Kelompok</th>
		<th rowspan="2">Jumlah Binaan</th>
		<?php
        if($bulan_pilih == "Januari"){
            ?>
        <th colspan="5" style="text-align: center;">Januari</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilih == "Februari"){
            ?>
        <th colspan="5" style="text-align: center;">Februari</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilih == "Maret"){
            ?>
        <th colspan="5" style="text-align: center;">Maret</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilih == "April"){
            ?>
        <th colspan="5" style="text-align: center;">April</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilih == "Mei"){
            ?>
        <th colspan="5" style="text-align: center;">Mei</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilih == "Juni"){
            ?>
        <th colspan="5" style="text-align: center;">Juni</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilih == "Juli"){
            ?>
        <th colspan="5" style="text-align: center;">Juli</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilih == "Agustus"){
            ?>
        <th colspan="5" style="text-align: center;">Agustus</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilih == "September"){
            ?>
        <th colspan="5" style="text-align: center;">September</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilih == "Oktober"){
            ?>
        <th colspan="5" style="text-align: center;">Oktober</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilih == "November"){
            ?>
        <th colspan="5" style="text-align: center;">November</th>
        <?php
        }
        ?>

        <?php
        if($bulan_pilih == "Desember"){
            ?>
        <th colspan="5" style="text-align: center;">Desember</th>
        <?php
        }
        ?>
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
	$select = $koneksi->prepare("select `nama_murabbi`, `nama_kelompok`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5` from `rekap` where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin='$jenis_kelamin_pilih' and jenjang='$jenjang_pilih' and tahun='$tahun_pilih'");
				$select->execute();
				$select->store_result();
				$select->bind_result($nama_murabbi, $nama_kelompok, $januari_1, $januari_2, $januari_3, $januari_4, $januari_5, $februari_1, $februari_2, $februari_3, $februari_4, $februari_5, $maret_1, $maret_2, $maret_3, $maret_4, $maret_5, $april_1, $april_2, $april_3, $april_4, $april_5, $mei_1, $mei_2, $mei_3, $mei_4, $mei_5, $juni_1, $juni_2, $juni_3, $juni_4, $juni_5, $juli_1, $juli_2, $juli_3, $juli_4, $juli_5, $agustus_1, $agustus_2, $agustus_3, $agustus_4, $agustus_5, $september_1, $september_2, $september_3, $september_4, $september_5, $oktober_1, $oktober_2, $oktober_3, $oktober_4, $oktober_5, $november_1, $november_2, $november_3, $november_4, $november_5, $desember_1, $desember_2, $desember_3, $desember_4, $desember_5);
				while($select->fetch())
				{
        $nama_kelompok = mysqli_real_escape_string($koneksi, $nama_kelompok);
				$sql2 = "SELECT nama_mutarabbi from mutarabbi where nama_murabbi='$nama_murabbi' and nama_kelompok = '$nama_kelompok' and status = 'Aktif' ORDER BY nama_mutarabbi";

				$result2 = $koneksi->query($sql2);
				$jumlah_binaan = $result2->num_rows;
				?>
	
	<tr>
		<td><?=$i++;?></td>
		<td><?=$nama_murabbi;?></td>
		<td><?= stripslashes($nama_kelompok);?></td>
		<td><?=$jumlah_binaan;?></td>
		<?php
            if($bulan_pilih == "Januari"){
                ?>
                <td><?=$januari_1;?></td>
                <td><?=$januari_2;?></td>
                <td><?=$januari_3;?></td>
                <td><?=$januari_4;?></td>
                <td><?=$januari_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Februari"){
                ?>
                <td><?=$februari_1;?></td>
                <td><?=$februari_2;?></td>
                <td><?=$februari_3;?></td>
                <td><?=$februari_4;?></td>
                <td><?=$februari_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Maret"){
                ?>
                <td><?=$maret_1;?></td>
                <td><?=$maret_2;?></td>
                <td><?=$maret_3;?></td>
                <td><?=$maret_4;?></td>
                <td><?=$maret_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "April"){
                ?>
                <td><?=$april_1;?></td>
                <td><?=$april_2;?></td>
                <td><?=$april_3;?></td>
                <td><?=$april_4;?></td>
                <td><?=$april_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Mei"){
                ?>
                <td><?=$mei_1;?></td>
                <td><?=$mei_2;?></td>
                <td><?=$mei_3;?></td>
                <td><?=$mei_4;?></td>
                <td><?=$mei_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Juni"){
                ?>
                <td><?=$juni_1;?></td>
                <td><?=$juni_2;?></td>
                <td><?=$juni_3;?></td>
                <td><?=$juni_4;?></td>
                <td><?=$juni_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Juli"){
                ?>
                <td><?=$juli_1;?></td>
                <td><?=$juli_2;?></td>
                <td><?=$juli_3;?></td>
                <td><?=$juli_4;?></td>
                <td><?=$juli_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Agustus"){
                ?>
                <td><?=$agustus_1;?></td>
                <td><?=$agustus_2;?></td>
                <td><?=$agustus_3;?></td>
                <td><?=$agustus_4;?></td>
                <td><?=$agustus_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "September"){
                ?>
                <td><?=$september_1;?></td>
                <td><?=$september_2;?></td>
                <td><?=$september_3;?></td>
                <td><?=$september_4;?></td>
                <td><?=$september_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Oktober"){
                ?>
                <td><?=$oktober_1;?></td>
                <td><?=$oktober_2;?></td>
                <td><?=$oktober_3;?></td>
                <td><?=$oktober_4;?></td>
                <td><?=$oktober_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "November"){
                ?>
                <td><?=$november_1;?></td>
                <td><?=$november_2;?></td>
                <td><?=$november_3;?></td>
                <td><?=$november_4;?></td>
                <td><?=$november_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Desember"){
                ?>
                <td><?=$desember_1;?></td>
                <td><?=$desember_2;?></td>
                <td><?=$desember_3;?></td>
                <td><?=$desember_4;?></td>
                <td><?=$desember_5;?></td>
        <?php
            }
        ?>
	</tr>
	<?php
				}
				?>
	<tr>
		<td colspan="4">Jumlah Kelompok Berjalan</td>
		<?php
		$select = $koneksi->prepare("select count(januari_1), count(januari_2), count(januari_3), count(januari_4), count(januari_5), count(februari_1), count(februari_2), count(februari_3), count(februari_4), count(februari_5), count(maret_1), count(maret_2), count(maret_3), count(maret_4), count(maret_5), count(april_1), count(april_2), count(april_3), count(april_4), count(april_5), count(mei_1), count(mei_2), count(mei_3), count(mei_4), count(mei_5), count(juni_1), count(juni_2), count(juni_3), count(juni_4), count(juni_5), count(juli_1), count(juli_2), count(juli_3), count(juli_4), count(juli_5), count(agustus_1), count(agustus_2), count(agustus_3), count(agustus_4), count(agustus_5), count(september_1), count(september_2), count(september_3), count(september_4), count(september_5), count(oktober_1), count(oktober_2), count(oktober_3), count(oktober_4), count(oktober_5), count(november_1), count(november_2), count(november_3), count(november_4), count(november_5), count(desember_1), count(desember_2), count(desember_3), count(desember_4), count(desember_5) from rekap where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin = '$jenis_kelamin_pilih' and jenjang = '$jenjang_pilih'  and tahun='$tahun_pilih';");
				$select->execute();
				$select->store_result();
				$select->bind_result($kelompok_berjalan_januari_1, $kelompok_berjalan_januari_2, $kelompok_berjalan_januari_3, $kelompok_berjalan_januari_4, $kelompok_berjalan_januari_5, $kelompok_berjalan_februari_1, $kelompok_berjalan_februari_2, $kelompok_berjalan_februari_3, $kelompok_berjalan_februari_4, $kelompok_berjalan_februari_5, $kelompok_berjalan_maret_1, $kelompok_berjalan_maret_2, $kelompok_berjalan_maret_3, $kelompok_berjalan_maret_4, $kelompok_berjalan_maret_5, $kelompok_berjalan_april_1, $kelompok_berjalan_april_2, $kelompok_berjalan_april_3, $kelompok_berjalan_april_4, $kelompok_berjalan_april_5, $kelompok_berjalan_mei_1, $kelompok_berjalan_mei_2, $kelompok_berjalan_mei_3, $kelompok_berjalan_mei_4, $kelompok_berjalan_mei_5, $kelompok_berjalan_juni_1, $kelompok_berjalan_juni_2, $kelompok_berjalan_juni_3, $kelompok_berjalan_juni_4, $kelompok_berjalan_juni_5, $kelompok_berjalan_juli_1, $kelompok_berjalan_juli_2, $kelompok_berjalan_juli_3, $kelompok_berjalan_juli_4, $kelompok_berjalan_juli_5, $kelompok_berjalan_agustus_1, $kelompok_berjalan_agustus_2, $kelompok_berjalan_agustus_3, $kelompok_berjalan_agustus_4, $kelompok_berjalan_agustus_5, $kelompok_berjalan_september_1, $kelompok_berjalan_september_2, $kelompok_berjalan_september_3, $kelompok_berjalan_september_4, $kelompok_berjalan_september_5, $kelompok_berjalan_oktober_1, $kelompok_berjalan_oktober_2, $kelompok_berjalan_oktober_3, $kelompok_berjalan_oktober_4, $kelompok_berjalan_oktober_5, $kelompok_berjalan_november_1, $kelompok_berjalan_november_2, $kelompok_berjalan_november_3, $kelompok_berjalan_november_4, $kelompok_berjalan_november_5, $kelompok_berjalan_desember_1, $kelompok_berjalan_desember_2, $kelompok_berjalan_desember_3, $kelompok_berjalan_desember_4, $kelompok_berjalan_desember_5);
				while($select->fetch())
				{
			?>
			<?php
            if($bulan_pilih == "Januari"){
                ?>
                <td><?=$kelompok_berjalan_januari_1;?></td>
                <td><?=$kelompok_berjalan_januari_2;?></td>
                <td><?=$kelompok_berjalan_januari_3;?></td>
                <td><?=$kelompok_berjalan_januari_4;?></td>
                <td><?=$kelompok_berjalan_januari_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Februari"){
                ?>
                <td><?=$kelompok_berjalan_februari_1;?></td>
                <td><?=$kelompok_berjalan_februari_2;?></td>
                <td><?=$kelompok_berjalan_februari_3;?></td>
                <td><?=$kelompok_berjalan_februari_4;?></td>
                <td><?=$kelompok_berjalan_februari_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Maret"){
                ?>
                <td><?=$kelompok_berjalan_maret_1;?></td>
                <td><?=$kelompok_berjalan_maret_2;?></td>
                <td><?=$kelompok_berjalan_maret_3;?></td>
                <td><?=$kelompok_berjalan_maret_4;?></td>
                <td><?=$kelompok_berjalan_maret_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "April"){
                ?>
                <td><?=$kelompok_berjalan_april_1;?></td>
                <td><?=$kelompok_berjalan_april_2;?></td>
                <td><?=$kelompok_berjalan_april_3;?></td>
                <td><?=$kelompok_berjalan_april_4;?></td>
                <td><?=$kelompok_berjalan_april_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Mei"){
                ?>
                <td><?=$kelompok_berjalan_mei_1;?></td>
                <td><?=$kelompok_berjalan_mei_2;?></td>
                <td><?=$kelompok_berjalan_mei_3;?></td>
                <td><?=$kelompok_berjalan_mei_4;?></td>
                <td><?=$kelompok_berjalan_mei_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Juni"){
                ?>
                <td><?=$kelompok_berjalan_juni_1;?></td>
                <td><?=$kelompok_berjalan_juni_2;?></td>
                <td><?=$kelompok_berjalan_juni_3;?></td>
                <td><?=$kelompok_berjalan_juni_4;?></td>
                <td><?=$kelompok_berjalan_juni_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Juli"){
                ?>
                <td><?=$kelompok_berjalan_juli_1;?></td>
                <td><?=$kelompok_berjalan_juli_2;?></td>
                <td><?=$kelompok_berjalan_juli_3;?></td>
                <td><?=$kelompok_berjalan_juli_4;?></td>
                <td><?=$kelompok_berjalan_juli_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Agustus"){
                ?>
                <td><?=$kelompok_berjalan_agustus_1;?></td>
                <td><?=$kelompok_berjalan_agustus_2;?></td>
                <td><?=$kelompok_berjalan_agustus_3;?></td>
                <td><?=$kelompok_berjalan_agustus_4;?></td>
                <td><?=$kelompok_berjalan_agustus_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "September"){
                ?>
                <td><?=$kelompok_berjalan_september_1;?></td>
                <td><?=$kelompok_berjalan_september_2;?></td>
                <td><?=$kelompok_berjalan_september_3;?></td>
                <td><?=$kelompok_berjalan_september_4;?></td>
                <td><?=$kelompok_berjalan_september_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Oktober"){
                ?>
                <td><?=$kelompok_berjalan_oktober_1;?></td>
                <td><?=$kelompok_berjalan_oktober_2;?></td>
                <td><?=$kelompok_berjalan_oktober_3;?></td>
                <td><?=$kelompok_berjalan_oktober_4;?></td>
                <td><?=$kelompok_berjalan_oktober_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "November"){
                ?>
                <td><?=$kelompok_berjalan_november_1;?></td>
                <td><?=$kelompok_berjalan_november_2;?></td>
                <td><?=$kelompok_berjalan_november_3;?></td>
                <td><?=$kelompok_berjalan_november_4;?></td>
                <td><?=$kelompok_berjalan_november_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Desember"){
                ?>
                <td><?=$kelompok_berjalan_desember_1;?></td>
                <td><?=$kelompok_berjalan_desember_2;?></td>
                <td><?=$kelompok_berjalan_desember_3;?></td>
                <td><?=$kelompok_berjalan_desember_4;?></td>
                <td><?=$kelompok_berjalan_desember_5;?></td>
        <?php
            }
        }
			?>
	</tr>
	<tr>
		<td colspan="4">Persentase Kelompok Berjalan</td>
		<?php
		$select = $koneksi->prepare("select count(januari_1), count(januari_2), count(januari_3), count(januari_4), count(januari_5), count(februari_1), count(februari_2), count(februari_3), count(februari_4), count(februari_5), count(maret_1), count(maret_2), count(maret_3), count(maret_4), count(maret_5), count(april_1), count(april_2), count(april_3), count(april_4), count(april_5), count(mei_1), count(mei_2), count(mei_3), count(mei_4), count(mei_5), count(juni_1), count(juni_2), count(juni_3), count(juni_4), count(juni_5), count(juli_1), count(juli_2), count(juli_3), count(juli_4), count(juli_5), count(agustus_1), count(agustus_2), count(agustus_3), count(agustus_4), count(agustus_5), count(september_1), count(september_2), count(september_3), count(september_4), count(september_5), count(oktober_1), count(oktober_2), count(oktober_3), count(oktober_4), count(oktober_5), count(november_1), count(november_2), count(november_3), count(november_4), count(november_5), count(desember_1), count(desember_2), count(desember_3), count(desember_4), count(desember_5) from rekap where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin = '$jenis_kelamin_pilih' and jenjang = '$jenjang_pilih' and tahun='$tahun_pilih';");
				$select->execute();
				$select->store_result();
				$select->bind_result($kelompok_berjalan_januari_1, $kelompok_berjalan_januari_2, $kelompok_berjalan_januari_3, $kelompok_berjalan_januari_4, $kelompok_berjalan_januari_5, $kelompok_berjalan_februari_1, $kelompok_berjalan_februari_2, $kelompok_berjalan_februari_3, $kelompok_berjalan_februari_4, $kelompok_berjalan_februari_5, $kelompok_berjalan_maret_1, $kelompok_berjalan_maret_2, $kelompok_berjalan_maret_3, $kelompok_berjalan_maret_4, $kelompok_berjalan_maret_5, $kelompok_berjalan_april_1, $kelompok_berjalan_april_2, $kelompok_berjalan_april_3, $kelompok_berjalan_april_4, $kelompok_berjalan_april_5, $kelompok_berjalan_mei_1, $kelompok_berjalan_mei_2, $kelompok_berjalan_mei_3, $kelompok_berjalan_mei_4, $kelompok_berjalan_mei_5, $kelompok_berjalan_juni_1, $kelompok_berjalan_juni_2, $kelompok_berjalan_juni_3, $kelompok_berjalan_juni_4, $kelompok_berjalan_juni_5, $kelompok_berjalan_juli_1, $kelompok_berjalan_juli_2, $kelompok_berjalan_juli_3, $kelompok_berjalan_juli_4, $kelompok_berjalan_juli_5, $kelompok_berjalan_agustus_1, $kelompok_berjalan_agustus_2, $kelompok_berjalan_agustus_3, $kelompok_berjalan_agustus_4, $kelompok_berjalan_agustus_5, $kelompok_berjalan_september_1, $kelompok_berjalan_september_2, $kelompok_berjalan_september_3, $kelompok_berjalan_september_4, $kelompok_berjalan_september_5, $kelompok_berjalan_oktober_1, $kelompok_berjalan_oktober_2, $kelompok_berjalan_oktober_3, $kelompok_berjalan_oktober_4, $kelompok_berjalan_oktober_5, $kelompok_berjalan_november_1, $kelompok_berjalan_november_2, $kelompok_berjalan_november_3, $kelompok_berjalan_november_4, $kelompok_berjalan_november_5, $kelompok_berjalan_desember_1, $kelompok_berjalan_desember_2, $kelompok_berjalan_desember_3, $kelompok_berjalan_desember_4, $kelompok_berjalan_desember_5);
				while($select->fetch())
				{
			?>
      <?php
            if($bulan_pilih == "Januari"){
                ?>
      <td><?=number_format(($kelompok_berjalan_januari_1/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_januari_2/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_januari_3/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_januari_4/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_januari_5/$jumlah_kelompok)*100) . "%";?></td>
        <?php
        $terlaksana1 = number_format(($kelompok_berjalan_januari_1/$jumlah_kelompok)*100);
        $terlaksana2 = number_format(($kelompok_berjalan_januari_2/$jumlah_kelompok)*100);
        $terlaksana3 = number_format(($kelompok_berjalan_januari_3/$jumlah_kelompok)*100);
        $terlaksana4 = number_format(($kelompok_berjalan_januari_4/$jumlah_kelompok)*100);
        $terlaksana5 = number_format(($kelompok_berjalan_januari_5/$jumlah_kelompok)*100);

        $terlaksana = $terlaksana1 . ", " . $terlaksana2 . ", " . $terlaksana3 . ", " . $terlaksana4 . ", " . $terlaksana5;
            }
        ?>

        <?php
            if($bulan_pilih == "Februari"){
                ?>
      <td><?=number_format(($kelompok_berjalan_februari_1/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_februari_2/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_februari_3/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_februari_4/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_februari_5/$jumlah_kelompok)*100) . "%";?></td>
        <?php
        $terlaksana1 = number_format(($kelompok_berjalan_februari_1/$jumlah_kelompok)*100);
        $terlaksana2 = number_format(($kelompok_berjalan_februari_2/$jumlah_kelompok)*100);
        $terlaksana3 = number_format(($kelompok_berjalan_februari_3/$jumlah_kelompok)*100);
        $terlaksana4 = number_format(($kelompok_berjalan_februari_4/$jumlah_kelompok)*100);
        $terlaksana5 = number_format(($kelompok_berjalan_februari_5/$jumlah_kelompok)*100);

        $terlaksana = $terlaksana1 . ", " . $terlaksana2 . ", " . $terlaksana3 . ", " . $terlaksana4 . ", " . $terlaksana5;
            }
        ?>

        <?php
            if($bulan_pilih == "Maret"){
                ?>
      <td><?=number_format(($kelompok_berjalan_maret_1/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_maret_2/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_maret_3/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_maret_4/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_maret_5/$jumlah_kelompok)*100) . "%";?></td>
        <?php
        $terlaksana1 = number_format(($kelompok_berjalan_maret_1/$jumlah_kelompok)*100);
        $terlaksana2 = number_format(($kelompok_berjalan_maret_2/$jumlah_kelompok)*100);
        $terlaksana3 = number_format(($kelompok_berjalan_maret_3/$jumlah_kelompok)*100);
        $terlaksana4 = number_format(($kelompok_berjalan_maret_4/$jumlah_kelompok)*100);
        $terlaksana5 = number_format(($kelompok_berjalan_maret_5/$jumlah_kelompok)*100);

        $terlaksana = $terlaksana1 . ", " . $terlaksana2 . ", " . $terlaksana3 . ", " . $terlaksana4 . ", " . $terlaksana5;
            }
        ?>

        <?php
            if($bulan_pilih == "April"){
                ?>
      <td><?=number_format(($kelompok_berjalan_april_1/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_april_2/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_april_3/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_april_4/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_april_5/$jumlah_kelompok)*100) . "%";?></td>
        <?php
        $terlaksana1 = number_format(($kelompok_berjalan_april_1/$jumlah_kelompok)*100);
        $terlaksana2 = number_format(($kelompok_berjalan_april_2/$jumlah_kelompok)*100);
        $terlaksana3 = number_format(($kelompok_berjalan_april_3/$jumlah_kelompok)*100);
        $terlaksana4 = number_format(($kelompok_berjalan_april_4/$jumlah_kelompok)*100);
        $terlaksana5 = number_format(($kelompok_berjalan_april_5/$jumlah_kelompok)*100);

        $terlaksana = $terlaksana1 . ", " . $terlaksana2 . ", " . $terlaksana3 . ", " . $terlaksana4 . ", " . $terlaksana5;
            }
        ?>

        <?php
            if($bulan_pilih == "Mei"){
                ?>
      <td><?=number_format(($kelompok_berjalan_mei_1/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_mei_2/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_mei_3/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_mei_4/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_mei_5/$jumlah_kelompok)*100) . "%";?></td>
        <?php
        $terlaksana1 = number_format(($kelompok_berjalan_mei_1/$jumlah_kelompok)*100);
        $terlaksana2 = number_format(($kelompok_berjalan_mei_2/$jumlah_kelompok)*100);
        $terlaksana3 = number_format(($kelompok_berjalan_mei_3/$jumlah_kelompok)*100);
        $terlaksana4 = number_format(($kelompok_berjalan_mei_4/$jumlah_kelompok)*100);
        $terlaksana5 = number_format(($kelompok_berjalan_mei_5/$jumlah_kelompok)*100);

        $terlaksana = $terlaksana1 . ", " . $terlaksana2 . ", " . $terlaksana3 . ", " . $terlaksana4 . ", " . $terlaksana5;
            }
        ?>

        <?php
            if($bulan_pilih == "Juni"){
                ?>
      <td><?=number_format(($kelompok_berjalan_juni_1/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_juni_2/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_juni_3/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_juni_4/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_juni_5/$jumlah_kelompok)*100) . "%";?></td>
        <?php
        $terlaksana1 = number_format(($kelompok_berjalan_juni_1/$jumlah_kelompok)*100);
        $terlaksana2 = number_format(($kelompok_berjalan_juni_2/$jumlah_kelompok)*100);
        $terlaksana3 = number_format(($kelompok_berjalan_juni_3/$jumlah_kelompok)*100);
        $terlaksana4 = number_format(($kelompok_berjalan_juni_4/$jumlah_kelompok)*100);
        $terlaksana5 = number_format(($kelompok_berjalan_juni_5/$jumlah_kelompok)*100);

        $terlaksana = $terlaksana1 . ", " . $terlaksana2 . ", " . $terlaksana3 . ", " . $terlaksana4 . ", " . $terlaksana5;
            }
        ?>

        <?php
            if($bulan_pilih == "Juli"){
                ?>
      <td><?=number_format(($kelompok_berjalan_juli_1/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_juli_2/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_juli_3/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_juli_4/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_juli_5/$jumlah_kelompok)*100) . "%";?></td>
        <?php
        $terlaksana1 = number_format(($kelompok_berjalan_juli_1/$jumlah_kelompok)*100);
        $terlaksana2 = number_format(($kelompok_berjalan_juli_2/$jumlah_kelompok)*100);
        $terlaksana3 = number_format(($kelompok_berjalan_juli_3/$jumlah_kelompok)*100);
        $terlaksana4 = number_format(($kelompok_berjalan_juli_4/$jumlah_kelompok)*100);
        $terlaksana5 = number_format(($kelompok_berjalan_juli_5/$jumlah_kelompok)*100);

        $terlaksana = $terlaksana1 . ", " . $terlaksana2 . ", " . $terlaksana3 . ", " . $terlaksana4 . ", " . $terlaksana5;
            }
        ?>

        <?php
            if($bulan_pilih == "Agustus"){
                ?>
      <td><?=number_format(($kelompok_berjalan_agustus_1/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_agustus_2/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_agustus_3/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_agustus_4/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_agustus_5/$jumlah_kelompok)*100) . "%";?></td>
        <?php
        $terlaksana1 = number_format(($kelompok_berjalan_agustus_1/$jumlah_kelompok)*100);
        $terlaksana2 = number_format(($kelompok_berjalan_agustus_2/$jumlah_kelompok)*100);
        $terlaksana3 = number_format(($kelompok_berjalan_agustus_3/$jumlah_kelompok)*100);
        $terlaksana4 = number_format(($kelompok_berjalan_agustus_4/$jumlah_kelompok)*100);
        $terlaksana5 = number_format(($kelompok_berjalan_agustus_5/$jumlah_kelompok)*100);

        $terlaksana = $terlaksana1 . ", " . $terlaksana2 . ", " . $terlaksana3 . ", " . $terlaksana4 . ", " . $terlaksana5;
            }
        ?>

        <?php
            if($bulan_pilih == "September"){
                ?>
      <td><?=number_format(($kelompok_berjalan_september_1/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_september_2/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_september_3/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_september_4/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_september_5/$jumlah_kelompok)*100) . "%";?></td>
        <?php
        $terlaksana1 = number_format(($kelompok_berjalan_september_1/$jumlah_kelompok)*100);
        $terlaksana2 = number_format(($kelompok_berjalan_september_2/$jumlah_kelompok)*100);
        $terlaksana3 = number_format(($kelompok_berjalan_september_3/$jumlah_kelompok)*100);
        $terlaksana4 = number_format(($kelompok_berjalan_september_4/$jumlah_kelompok)*100);
        $terlaksana5 = number_format(($kelompok_berjalan_september_5/$jumlah_kelompok)*100);

        $terlaksana = $terlaksana1 . ", " . $terlaksana2 . ", " . $terlaksana3 . ", " . $terlaksana4 . ", " . $terlaksana5;
            }
        ?>

        <?php
            if($bulan_pilih == "Oktober"){
                ?>
      <td><?=number_format(($kelompok_berjalan_oktober_1/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_oktober_2/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_oktober_3/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_oktober_4/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_oktober_5/$jumlah_kelompok)*100) . "%";?></td>
        <?php
        $terlaksana1 = number_format(($kelompok_berjalan_oktober_1/$jumlah_kelompok)*100);
        $terlaksana2 = number_format(($kelompok_berjalan_oktober_2/$jumlah_kelompok)*100);
        $terlaksana3 = number_format(($kelompok_berjalan_oktober_3/$jumlah_kelompok)*100);
        $terlaksana4 = number_format(($kelompok_berjalan_oktober_4/$jumlah_kelompok)*100);
        $terlaksana5 = number_format(($kelompok_berjalan_oktober_5/$jumlah_kelompok)*100);

        $terlaksana = $terlaksana1 . ", " . $terlaksana2 . ", " . $terlaksana3 . ", " . $terlaksana4 . ", " . $terlaksana5;
            }
        ?>

        <?php
            if($bulan_pilih == "November"){
                ?>
      <td><?=number_format(($kelompok_berjalan_november_1/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_november_2/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_november_3/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_november_4/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_november_5/$jumlah_kelompok)*100) . "%";?></td>
        <?php
        $terlaksana1 = number_format(($kelompok_berjalan_november_1/$jumlah_kelompok)*100);
        $terlaksana2 = number_format(($kelompok_berjalan_november_2/$jumlah_kelompok)*100);
        $terlaksana3 = number_format(($kelompok_berjalan_november_3/$jumlah_kelompok)*100);
        $terlaksana4 = number_format(($kelompok_berjalan_november_4/$jumlah_kelompok)*100);
        $terlaksana5 = number_format(($kelompok_berjalan_november_5/$jumlah_kelompok)*100);

        $terlaksana = $terlaksana1 . ", " . $terlaksana2 . ", " . $terlaksana3 . ", " . $terlaksana4 . ", " . $terlaksana5;
            }
        ?>

        <?php
            if($bulan_pilih == "Desember"){
                ?>
      <td><?=number_format(($kelompok_berjalan_desember_1/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_desember_2/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_desember_3/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_desember_4/$jumlah_kelompok)*100) . "%";?></td>
      <td><?=number_format(($kelompok_berjalan_desember_5/$jumlah_kelompok)*100) . "%";?></td>
        <?php
        $terlaksana1 = number_format(($kelompok_berjalan_desember_1/$jumlah_kelompok)*100);
        $terlaksana2 = number_format(($kelompok_berjalan_desember_2/$jumlah_kelompok)*100);
        $terlaksana3 = number_format(($kelompok_berjalan_desember_3/$jumlah_kelompok)*100);
        $terlaksana4 = number_format(($kelompok_berjalan_desember_4/$jumlah_kelompok)*100);
        $terlaksana5 = number_format(($kelompok_berjalan_desember_5/$jumlah_kelompok)*100);

        $terlaksana = $terlaksana1 . ", " . $terlaksana2 . ", " . $terlaksana3 . ", " . $terlaksana4 . ", " . $terlaksana5;
            }
			}
			?>	
	</tr>
	<tr>	
		<td colspan="4">Jumlah Kelompok Tidak Berjalan</td>	
		<?php
		$select = $koneksi->prepare("select count(januari_1), count(januari_2), count(januari_3), count(januari_4), count(januari_5), count(februari_1), count(februari_2), count(februari_3), count(februari_4), count(februari_5), count(maret_1), count(maret_2), count(maret_3), count(maret_4), count(maret_5), count(april_1), count(april_2), count(april_3), count(april_4), count(april_5), count(mei_1), count(mei_2), count(mei_3), count(mei_4), count(mei_5), count(juni_1), count(juni_2), count(juni_3), count(juni_4), count(juni_5), count(juli_1), count(juli_2), count(juli_3), count(juli_4), count(juli_5), count(agustus_1), count(agustus_2), count(agustus_3), count(agustus_4), count(agustus_5), count(september_1), count(september_2), count(september_3), count(september_4), count(september_5), count(oktober_1), count(oktober_2), count(oktober_3), count(oktober_4), count(oktober_5), count(november_1), count(november_2), count(november_3), count(november_4), count(november_5), count(desember_1), count(desember_2), count(desember_3), count(desember_4), count(desember_5) from rekap where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin = '$jenis_kelamin_pilih' and jenjang = '$jenjang_pilih' and tahun='$tahun_pilih';");
				$select->execute();
				$select->store_result();
				$select->bind_result($kelompok_berjalan_januari_1, $kelompok_berjalan_januari_2, $kelompok_berjalan_januari_3, $kelompok_berjalan_januari_4, $kelompok_berjalan_januari_5, $kelompok_berjalan_februari_1, $kelompok_berjalan_februari_2, $kelompok_berjalan_februari_3, $kelompok_berjalan_februari_4, $kelompok_berjalan_februari_5, $kelompok_berjalan_maret_1, $kelompok_berjalan_maret_2, $kelompok_berjalan_maret_3, $kelompok_berjalan_maret_4, $kelompok_berjalan_maret_5, $kelompok_berjalan_april_1, $kelompok_berjalan_april_2, $kelompok_berjalan_april_3, $kelompok_berjalan_april_4, $kelompok_berjalan_april_5, $kelompok_berjalan_mei_1, $kelompok_berjalan_mei_2, $kelompok_berjalan_mei_3, $kelompok_berjalan_mei_4, $kelompok_berjalan_mei_5, $kelompok_berjalan_juni_1, $kelompok_berjalan_juni_2, $kelompok_berjalan_juni_3, $kelompok_berjalan_juni_4, $kelompok_berjalan_juni_5, $kelompok_berjalan_juli_1, $kelompok_berjalan_juli_2, $kelompok_berjalan_juli_3, $kelompok_berjalan_juli_4, $kelompok_berjalan_juli_5, $kelompok_berjalan_agustus_1, $kelompok_berjalan_agustus_2, $kelompok_berjalan_agustus_3, $kelompok_berjalan_agustus_4, $kelompok_berjalan_agustus_5, $kelompok_berjalan_september_1, $kelompok_berjalan_september_2, $kelompok_berjalan_september_3, $kelompok_berjalan_september_4, $kelompok_berjalan_september_5, $kelompok_berjalan_oktober_1, $kelompok_berjalan_oktober_2, $kelompok_berjalan_oktober_3, $kelompok_berjalan_oktober_4, $kelompok_berjalan_oktober_5, $kelompok_berjalan_november_1, $kelompok_berjalan_november_2, $kelompok_berjalan_november_3, $kelompok_berjalan_november_4, $kelompok_berjalan_november_5, $kelompok_berjalan_desember_1, $kelompok_berjalan_desember_2, $kelompok_berjalan_desember_3, $kelompok_berjalan_desember_4, $kelompok_berjalan_desember_5);
				while($select->fetch())
				{
			?>
			     <?php
            if($bulan_pilih == "Januari"){
                ?>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_januari_1;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_januari_2;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_januari_3;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_januari_4;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_januari_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Februari"){
                ?>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_februari_1;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_februari_2;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_februari_3;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_februari_4;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_februari_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Maret"){
                ?>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_maret_1;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_maret_2;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_maret_3;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_maret_4;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_maret_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "April"){
                ?>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_april_1;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_april_2;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_april_3;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_april_4;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_april_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Mei"){
                ?>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_mei_1;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_mei_2;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_mei_3;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_mei_4;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_mei_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Juni"){
                ?>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_juni_1;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_juni_2;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_juni_3;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_juni_4;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_juni_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Juli"){
                ?>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_juli_1;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_juli_2;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_juli_3;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_juli_4;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_juli_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Agustus"){
                ?>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_agustus_1;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_agustus_2;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_agustus_3;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_agustus_4;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_agustus_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "September"){
                ?>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_september_1;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_september_2;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_september_3;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_september_4;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_september_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Oktober"){
                ?>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_oktober_1;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_oktober_2;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_oktober_3;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_oktober_4;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_oktober_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "November"){
                ?>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_november_1;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_november_2;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_november_3;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_november_4;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_november_5;?></td>
        <?php
            }
        ?>

        <?php
            if($bulan_pilih == "Desember"){
                ?>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_desember_1;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_desember_2;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_desember_3;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_desember_4;?></td>
                <td><?=$jumlah_kelompok - $kelompok_berjalan_desember_5;?></td>
        <?php
            }
        }
      ?>
	</tr>
	<tr>
		<td colspan="4">Jumlah Binaan Hadir</td>
		<?php
		$select = $koneksi->prepare("select sum(januari_1), sum(januari_2), sum(januari_3), sum(januari_4), sum(januari_5), sum(februari_1), sum(februari_2), sum(februari_3), sum(februari_4), sum(februari_5), sum(maret_1), sum(maret_2), sum(maret_3), sum(maret_4), sum(maret_5), sum(april_1), sum(april_2), sum(april_3), sum(april_4), sum(april_5), sum(mei_1), sum(mei_2), sum(mei_3), sum(mei_4), sum(mei_5), sum(juni_1), sum(juni_2), sum(juni_3), sum(juni_4), sum(juni_5), sum(juli_1), sum(juli_2), sum(juli_3), sum(juli_4), sum(juli_5), sum(agustus_1), sum(agustus_2), sum(agustus_3), sum(agustus_4), sum(agustus_5), sum(september_1), sum(september_2), sum(september_3), sum(september_4), sum(september_5), sum(oktober_1), sum(oktober_2), sum(oktober_3), sum(oktober_4), sum(oktober_5), sum(november_1), sum(november_2), sum(november_3), sum(november_4), sum(november_5), sum(desember_1), sum(desember_2), sum(desember_3), sum(desember_4), sum(desember_5) from rekap where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin = '$jenis_kelamin_pilih' and jenjang = '$jenjang_pilih' and tahun='$tahun_pilih';");
				$select->execute();
				$select->store_result();
				$select->bind_result($binaan_hadir_januari_1, $binaan_hadir_januari_2, $binaan_hadir_januari_3, $binaan_hadir_januari_4, $binaan_hadir_januari_5, $binaan_hadir_februari_1, $binaan_hadir_februari_2, $binaan_hadir_februari_3, $binaan_hadir_februari_4, $binaan_hadir_februari_5, $binaan_hadir_maret_1, $binaan_hadir_maret_2, $binaan_hadir_maret_3, $binaan_hadir_maret_4, $binaan_hadir_maret_5, $binaan_hadir_april_1, $binaan_hadir_april_2, $binaan_hadir_april_3, $binaan_hadir_april_4, $binaan_hadir_april_5, $binaan_hadir_mei_1, $binaan_hadir_mei_2, $binaan_hadir_mei_3, $binaan_hadir_mei_4, $binaan_hadir_mei_5, $binaan_hadir_juni_1, $binaan_hadir_juni_2, $binaan_hadir_juni_3, $binaan_hadir_juni_4, $binaan_hadir_juni_5, $binaan_hadir_juli_1, $binaan_hadir_juli_2, $binaan_hadir_juli_3, $binaan_hadir_juli_4, $binaan_hadir_juli_5, $binaan_hadir_agustus_1, $binaan_hadir_agustus_2, $binaan_hadir_agustus_3, $binaan_hadir_agustus_4, $binaan_hadir_agustus_5, $binaan_hadir_september_1, $binaan_hadir_september_2, $binaan_hadir_september_3, $binaan_hadir_september_4, $binaan_hadir_september_5, $binaan_hadir_oktober_1, $binaan_hadir_oktober_2, $binaan_hadir_oktober_3, $binaan_hadir_oktober_4, $binaan_hadir_oktober_5, $binaan_hadir_november_1, $binaan_hadir_november_2, $binaan_hadir_november_3, $binaan_hadir_november_4, $binaan_hadir_november_5, $binaan_hadir_desember_1, $binaan_hadir_desember_2, $binaan_hadir_desember_3, $binaan_hadir_desember_4, $binaan_hadir_desember_5);
				while($select->fetch())
				{
			?>
			<?php
            if($bulan_pilih == "Januari"){
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
            if($bulan_pilih == "Februari"){
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
            if($bulan_pilih == "Maret"){
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
            if($bulan_pilih == "April"){
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
            if($bulan_pilih == "Mei"){
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
            if($bulan_pilih == "Juni"){
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
            if($bulan_pilih == "Juli"){
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
            if($bulan_pilih == "Agustus"){
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
            if($bulan_pilih == "September"){
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
            if($bulan_pilih == "Oktober"){
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
            if($bulan_pilih == "November"){
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
            if($bulan_pilih == "Desember"){
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
	</tr>
	<tr>
		<td colspan="4">Persentase Kehadiran</td>
		<?php
		$select = $koneksi->prepare("select sum(januari_1), sum(januari_2), sum(januari_3), sum(januari_4), sum(januari_5), sum(februari_1), sum(februari_2), sum(februari_3), sum(februari_4), sum(februari_5), sum(maret_1), sum(maret_2), sum(maret_3), sum(maret_4), sum(maret_5), sum(april_1), sum(april_2), sum(april_3), sum(april_4), sum(april_5), sum(mei_1), sum(mei_2), sum(mei_3), sum(mei_4), sum(mei_5), sum(juni_1), sum(juni_2), sum(juni_3), sum(juni_4), sum(juni_5), sum(juli_1), sum(juli_2), sum(juli_3), sum(juli_4), sum(juli_5), sum(agustus_1), sum(agustus_2), sum(agustus_3), sum(agustus_4), sum(agustus_5), sum(september_1), sum(september_2), sum(september_3), sum(september_4), sum(september_5), sum(oktober_1), sum(oktober_2), sum(oktober_3), sum(oktober_4), sum(oktober_5), sum(november_1), sum(november_2), sum(november_3), sum(november_4), sum(november_5), sum(desember_1), sum(desember_2), sum(desember_3), sum(desember_4), sum(desember_5) from rekap where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin = '$jenis_kelamin_pilih' and jenjang = '$jenjang_pilih' and tahun='$tahun_pilih';");
				$select->execute();
				$select->store_result();
				$select->bind_result($binaan_hadir_januari_1, $binaan_hadir_januari_2, $binaan_hadir_januari_3, $binaan_hadir_januari_4, $binaan_hadir_januari_5, $binaan_hadir_februari_1, $binaan_hadir_februari_2, $binaan_hadir_februari_3, $binaan_hadir_februari_4, $binaan_hadir_februari_5, $binaan_hadir_maret_1, $binaan_hadir_maret_2, $binaan_hadir_maret_3, $binaan_hadir_maret_4, $binaan_hadir_maret_5, $binaan_hadir_april_1, $binaan_hadir_april_2, $binaan_hadir_april_3, $binaan_hadir_april_4, $binaan_hadir_april_5, $binaan_hadir_mei_1, $binaan_hadir_mei_2, $binaan_hadir_mei_3, $binaan_hadir_mei_4, $binaan_hadir_mei_5, $binaan_hadir_juni_1, $binaan_hadir_juni_2, $binaan_hadir_juni_3, $binaan_hadir_juni_4, $binaan_hadir_juni_5, $binaan_hadir_juli_1, $binaan_hadir_juli_2, $binaan_hadir_juli_3, $binaan_hadir_juli_4, $binaan_hadir_juli_5, $binaan_hadir_agustus_1, $binaan_hadir_agustus_2, $binaan_hadir_agustus_3, $binaan_hadir_agustus_4, $binaan_hadir_agustus_5, $binaan_hadir_september_1, $binaan_hadir_september_2, $binaan_hadir_september_3, $binaan_hadir_september_4, $binaan_hadir_september_5, $binaan_hadir_oktober_1, $binaan_hadir_oktober_2, $binaan_hadir_oktober_3, $binaan_hadir_oktober_4, $binaan_hadir_oktober_5, $binaan_hadir_november_1, $binaan_hadir_november_2, $binaan_hadir_november_3, $binaan_hadir_november_4, $binaan_hadir_november_5, $binaan_hadir_desember_1, $binaan_hadir_desember_2, $binaan_hadir_desember_3, $binaan_hadir_desember_4, $binaan_hadir_desember_5);
				while($select->fetch())
				{

			?>
      <?php
            if($bulan_pilih == "Januari"){
                ?>
      <td><?=number_format(($binaan_hadir_januari_1/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_januari_2/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_januari_3/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_januari_4/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_januari_5/$jumlah_mutarabbi)*100) . "%";?></td>
        <?php
        $data1 = number_format(($binaan_hadir_januari_1/$jumlah_mutarabbi)*100);
        $data2 = number_format(($binaan_hadir_januari_2/$jumlah_mutarabbi)*100);
        $data3 = number_format(($binaan_hadir_januari_3/$jumlah_mutarabbi)*100);
        $data4 = number_format(($binaan_hadir_januari_4/$jumlah_mutarabbi)*100);
        $data5 = number_format(($binaan_hadir_januari_5/$jumlah_mutarabbi)*100);

        $data = $data1 . ", " . $data2 . ", " . $data3 . ", " . $data4 . ", " . $data5;
            }
        ?>

        <?php
            if($bulan_pilih == "Februari"){
                ?>
      <td><?=number_format(($binaan_hadir_februari_1/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_februari_2/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_februari_3/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_februari_4/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_februari_5/$jumlah_mutarabbi)*100) . "%";?></td>
        <?php
        $data1 = number_format(($binaan_hadir_februari_1/$jumlah_mutarabbi)*100);
        $data2 = number_format(($binaan_hadir_februari_2/$jumlah_mutarabbi)*100);
        $data3 = number_format(($binaan_hadir_februari_3/$jumlah_mutarabbi)*100);
        $data4 = number_format(($binaan_hadir_februari_4/$jumlah_mutarabbi)*100);
        $data5 = number_format(($binaan_hadir_februari_5/$jumlah_mutarabbi)*100);

        $data = $data1 . ", " . $data2 . ", " . $data3 . ", " . $data4 . ", " . $data5;
            }
        ?>

        <?php
            if($bulan_pilih == "Maret"){
                ?>
      <td><?=number_format(($binaan_hadir_maret_1/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_maret_2/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_maret_3/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_maret_4/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_maret_5/$jumlah_mutarabbi)*100) . "%";?></td>
        <?php
        $data1 = number_format(($binaan_hadir_maret_1/$jumlah_mutarabbi)*100);
        $data2 = number_format(($binaan_hadir_maret_2/$jumlah_mutarabbi)*100);
        $data3 = number_format(($binaan_hadir_maret_3/$jumlah_mutarabbi)*100);
        $data4 = number_format(($binaan_hadir_maret_4/$jumlah_mutarabbi)*100);
        $data5 = number_format(($binaan_hadir_maret_5/$jumlah_mutarabbi)*100);

        $data = $data1 . ", " . $data2 . ", " . $data3 . ", " . $data4 . ", " . $data5;
            }
        ?>

        <?php
            if($bulan_pilih == "April"){
                ?>
      <td><?=number_format(($binaan_hadir_april_1/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_april_2/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_april_3/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_april_4/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_april_5/$jumlah_mutarabbi)*100) . "%";?></td>
        <?php
        $data1 = number_format(($binaan_hadir_april_1/$jumlah_mutarabbi)*100);
        $data2 = number_format(($binaan_hadir_april_2/$jumlah_mutarabbi)*100);
        $data3 = number_format(($binaan_hadir_april_3/$jumlah_mutarabbi)*100);
        $data4 = number_format(($binaan_hadir_april_4/$jumlah_mutarabbi)*100);
        $data5 = number_format(($binaan_hadir_april_5/$jumlah_mutarabbi)*100);

        $data = $data1 . ", " . $data2 . ", " . $data3 . ", " . $data4 . ", " . $data5;
            }
        ?>

        <?php
            if($bulan_pilih == "Mei"){
                ?>
      <td><?=number_format(($binaan_hadir_mei_1/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_mei_2/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_mei_3/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_mei_4/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_mei_5/$jumlah_mutarabbi)*100) . "%";?></td>
        <?php
        $data1 = number_format(($binaan_hadir_mei_1/$jumlah_mutarabbi)*100);
        $data2 = number_format(($binaan_hadir_mei_2/$jumlah_mutarabbi)*100);
        $data3 = number_format(($binaan_hadir_mei_3/$jumlah_mutarabbi)*100);
        $data4 = number_format(($binaan_hadir_mei_4/$jumlah_mutarabbi)*100);
        $data5 = number_format(($binaan_hadir_mei_5/$jumlah_mutarabbi)*100);

        $data = $data1 . ", " . $data2 . ", " . $data3 . ", " . $data4 . ", " . $data5;
            }
        ?>

        <?php
            if($bulan_pilih == "Juni"){
                ?>
      <td><?=number_format(($binaan_hadir_juni_1/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_juni_2/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_juni_3/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_juni_4/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_juni_5/$jumlah_mutarabbi)*100) . "%";?></td>
        <?php
        $data1 = number_format(($binaan_hadir_juni_1/$jumlah_mutarabbi)*100);
        $data2 = number_format(($binaan_hadir_juni_2/$jumlah_mutarabbi)*100);
        $data3 = number_format(($binaan_hadir_juni_3/$jumlah_mutarabbi)*100);
        $data4 = number_format(($binaan_hadir_juni_4/$jumlah_mutarabbi)*100);
        $data5 = number_format(($binaan_hadir_juni_5/$jumlah_mutarabbi)*100);

        $data = $data1 . ", " . $data2 . ", " . $data3 . ", " . $data4 . ", " . $data5;
            }
        ?>

        <?php
            if($bulan_pilih == "Juli"){
                ?>
      <td><?=number_format(($binaan_hadir_juli_1/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_juli_2/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_juli_3/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_juli_4/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_juli_5/$jumlah_mutarabbi)*100) . "%";?></td>
        <?php
        $data1 = number_format(($binaan_hadir_juli_1/$jumlah_mutarabbi)*100);
        $data2 = number_format(($binaan_hadir_juli_2/$jumlah_mutarabbi)*100);
        $data3 = number_format(($binaan_hadir_juli_3/$jumlah_mutarabbi)*100);
        $data4 = number_format(($binaan_hadir_juli_4/$jumlah_mutarabbi)*100);
        $data5 = number_format(($binaan_hadir_juli_5/$jumlah_mutarabbi)*100);

        $data = $data1 . ", " . $data2 . ", " . $data3 . ", " . $data4 . ", " . $data5;
            }
        ?>

        <?php
            if($bulan_pilih == "Agustus"){
                ?>
      <td><?=number_format(($binaan_hadir_agustus_1/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_agustus_2/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_agustus_3/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_agustus_4/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_agustus_5/$jumlah_mutarabbi)*100) . "%";?></td>
        <?php
        $data1 = number_format(($binaan_hadir_agustus_1/$jumlah_mutarabbi)*100);
        $data2 = number_format(($binaan_hadir_agustus_2/$jumlah_mutarabbi)*100);
        $data3 = number_format(($binaan_hadir_agustus_3/$jumlah_mutarabbi)*100);
        $data4 = number_format(($binaan_hadir_agustus_4/$jumlah_mutarabbi)*100);
        $data5 = number_format(($binaan_hadir_agustus_5/$jumlah_mutarabbi)*100);

        $data = $data1 . ", " . $data2 . ", " . $data3 . ", " . $data4 . ", " . $data5;
            }
        ?>

        <?php
            if($bulan_pilih == "September"){
                ?>
      <td><?=number_format(($binaan_hadir_september_1/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_september_2/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_september_3/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_september_4/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_september_5/$jumlah_mutarabbi)*100) . "%";?></td>
        <?php
        $data1 = number_format(($binaan_hadir_september_1/$jumlah_mutarabbi)*100);
        $data2 = number_format(($binaan_hadir_september_2/$jumlah_mutarabbi)*100);
        $data3 = number_format(($binaan_hadir_september_3/$jumlah_mutarabbi)*100);
        $data4 = number_format(($binaan_hadir_september_4/$jumlah_mutarabbi)*100);
        $data5 = number_format(($binaan_hadir_september_5/$jumlah_mutarabbi)*100);

        $data = $data1 . ", " . $data2 . ", " . $data3 . ", " . $data4 . ", " . $data5;
            }
        ?>

        <?php
            if($bulan_pilih == "Oktober"){
                ?>
      <td><?=number_format(($binaan_hadir_oktober_1/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_oktober_2/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_oktober_3/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_oktober_4/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_oktober_5/$jumlah_mutarabbi)*100) . "%";?></td>
        <?php
        $data1 = number_format(($binaan_hadir_oktober_1/$jumlah_mutarabbi)*100);
        $data2 = number_format(($binaan_hadir_oktober_2/$jumlah_mutarabbi)*100);
        $data3 = number_format(($binaan_hadir_oktober_3/$jumlah_mutarabbi)*100);
        $data4 = number_format(($binaan_hadir_oktober_4/$jumlah_mutarabbi)*100);
        $data5 = number_format(($binaan_hadir_oktober_5/$jumlah_mutarabbi)*100);

        $data = $data1 . ", " . $data2 . ", " . $data3 . ", " . $data4 . ", " . $data5;
            }
        ?>

        <?php
            if($bulan_pilih == "November"){
                ?>
      <td><?=number_format(($binaan_hadir_november_1/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_november_2/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_november_3/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_november_4/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_november_5/$jumlah_mutarabbi)*100) . "%";?></td>
        <?php
        $data1 = number_format(($binaan_hadir_november_1/$jumlah_mutarabbi)*100);
        $data2 = number_format(($binaan_hadir_november_2/$jumlah_mutarabbi)*100);
        $data3 = number_format(($binaan_hadir_november_3/$jumlah_mutarabbi)*100);
        $data4 = number_format(($binaan_hadir_november_4/$jumlah_mutarabbi)*100);
        $data5 = number_format(($binaan_hadir_november_5/$jumlah_mutarabbi)*100);

        $data = $data1 . ", " . $data2 . ", " . $data3 . ", " . $data4 . ", " . $data5;
            }
        ?>

        <?php
            if($bulan_pilih == "Desember"){
                ?>
      <td><?=number_format(($binaan_hadir_desember_1/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_desember_2/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_desember_3/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_desember_4/$jumlah_mutarabbi)*100) . "%";?></td>
      <td><?=number_format(($binaan_hadir_desember_5/$jumlah_mutarabbi)*100) . "%";?></td>
        <?php
        $data1 = number_format(($binaan_hadir_desember_1/$jumlah_mutarabbi)*100);
        $data2 = number_format(($binaan_hadir_desember_2/$jumlah_mutarabbi)*100);
        $data3 = number_format(($binaan_hadir_desember_3/$jumlah_mutarabbi)*100);
        $data4 = number_format(($binaan_hadir_desember_4/$jumlah_mutarabbi)*100);
        $data5 = number_format(($binaan_hadir_desember_5/$jumlah_mutarabbi)*100);

        $data = $data1 . ", " . $data2 . ", " . $data3 . ", " . $data4 . ", " . $data5;
            }
        }
			?>
	</tr>
</table>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    
    <!-- Custom Javasciprt -->
    <script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["1", "2", "3", "4", "5"],
        datasets: [{
            label: 'Persentase Keterlaksanaan',
            data: [<?=$terlaksana;?>],
            backgroundColor: [
                'green'
            ],
            borderColor: [
                'blue'
            ],
            borderWidth: 3,
            fill: false
        },{
            label: 'Persentase Kehadiran',
            data: [<?=$data;?>],
            backgroundColor: [
                'blue'
            ],
            borderColor: [
                'green'
            ],
            borderWidth: 3,
            fill: false
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    callback: function(value, index, values) {
                        return value + '%';
                    }
                }
            }],
            xAxes: [{
                ticks: {
                    callback: function(value, index, values) {
                        return 'Pekan-' + value;
                    }
                }
            }]
        }
    }
});
</script>
    <script>
        $( document ).ready(function(){
            $(".button-collapse").sideNav();
        })

        $(document).ready(function() {
            $('select').material_select();
        });

        $('#angkatan_kelompok_pilih option[value="<?=$angkatan_kelompok_pilih;?>"]').attr('selected','selected');
        $('#jenis_kelamin_pilih option[value="<?=$jenis_kelamin_pilih;?>"]').attr('selected','selected');
        $('#jenjang_pilih option[value="<?=$jenjang_pilih;?>"]').attr('selected','selected');
        $('#bulan_pilih option[value="<?=$bulan_pilih;?>"]').attr('selected','selected');
        $('#tahun_pilih option[value="<?=$tahun_pilih;?>"]').attr('selected','selected');
    </script>

</body>
</html>