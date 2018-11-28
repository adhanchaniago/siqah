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

  $angkatan_kelompok_pilih = $_POST['angkatan_kelompok_pilih'];
  $jenis_kelamin_pilih = $_POST['jenis_kelamin_pilih'];
  $jenjang_pilih = $_POST['jenjang_pilih'];
  $bulan_pilih = $_POST['bulan_pilih'];
//  echo $angkatan_kelompok_pilih . $jenis_kelamin_pilih . $jenjang_pilih . $bulan_pilih;

if(!isset($_GET['tahun'])){
    $tahun_pilihan = date("Y");
}
else
{
    $tahun_pilihan = $_GET['tahun'];
}

$tahun_sekarang = date("Y");

//Dapatkan user
$select = $koneksi->prepare("SELECT nama_murabbi FROM murabbi WHERE nama_pengguna='$nama_pengguna';");
$select->execute();
$select->store_result();
$select->bind_result($nama_murabbi);
$select->fetch();

//Dapatkan jumlah murabbi
$select = $koneksi->prepare("SELECT count(nama_murabbi) from rekap where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin='$jenis_kelamin_pilih' and jenjang='$jenjang_pilih';");
$select->execute();
$select->store_result();
$select->bind_result($jumlah_murabbi);
$select->fetch();

//Dapatkan jumlah kelompok
$select = $koneksi->prepare("SELECT count(nama_kelompok) from rekap where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin='$jenis_kelamin_pilih' and jenjang='$jenjang_pilih';");
$select->execute();
$select->store_result();
$select->bind_result($jumlah_kelompok);
$select->fetch();

//Dapatkan jumlah mutarabbi
$select = $koneksi->prepare("SELECT count(nama_mutarabbi) from mutarabbi, rekap where rekap.nama_murabbi!='LTT' and rekap.nama_murabbi!='Uji Coba' and rekap.angkatan_kelompok ='$angkatan_kelompok_pilih' and rekap.jenis_kelamin ='$jenis_kelamin_pilih' and rekap.jenjang = '$jenjang_pilih' and mutarabbi.nama_kelompok=rekap.nama_kelompok;");
$select->execute();
$select->store_result();
$select->bind_result($jumlah_mutarabbi);
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
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
    <title>Rekapitulasi Laporan</title>
</head>
<body>

<table border="1">
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
    $select = $koneksi->prepare("select `nama_murabbi`, `nama_kelompok`, `januari_1`, `januari_2`, `januari_3`, `januari_4`, `januari_5`, `februari_1`, `februari_2`, `februari_3`, `februari_4`, `februari_5`, `maret_1`, `maret_2`, `maret_3`, `maret_4`, `maret_5`, `april_1`, `april_2`, `april_3`, `april_4`, `april_5`, `mei_1`, `mei_2`, `mei_3`, `mei_4`, `mei_5`, `juni_1`, `juni_2`, `juni_3`, `juni_4`, `juni_5`, `juli_1`, `juli_2`, `juli_3`, `juli_4`, `juli_5`, `agustus_1`, `agustus_2`, `agustus_3`, `agustus_4`, `agustus_5`, `september_1`, `september_2`, `september_3`, `september_4`, `september_5`, `oktober_1`, `oktober_2`, `oktober_3`, `oktober_4`, `oktober_5`, `november_1`, `november_2`, `november_3`, `november_4`, `november_5`, `desember_1`, `desember_2`, `desember_3`, `desember_4`, `desember_5` from `rekap` where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin = '$jenis_kelamin_pilih' and jenjang = '$jenjang_pilih';");
                $select->execute();
                $select->store_result();
                $select->bind_result($nama_murabbi_pilihan, $nama_kelompok_pilihan, $januari_1, $januari_2, $januari_3, $januari_4, $januari_5, $februari_1, $februari_2, $februari_3, $februari_4, $februari_5, $maret_1, $maret_2, $maret_3, $maret_4, $maret_5, $april_1, $april_2, $april_3, $april_4, $april_5, $mei_1, $mei_2, $mei_3, $mei_4, $mei_5, $juni_1, $juni_2, $juni_3, $juni_4, $juni_5, $juli_1, $juli_2, $juli_3, $juli_4, $juli_5, $agustus_1, $agustus_2, $agustus_3, $agustus_4, $agustus_5, $september_1, $september_2, $september_3, $september_4, $september_5, $oktober_1, $oktober_2, $oktober_3, $oktober_4, $oktober_5, $november_1, $november_2, $november_3, $november_4, $november_5, $desember_1, $desember_2, $desember_3, $desember_4, $desember_5);
                while($select->fetch())
                {
        $nama_kelompok_pilihan = mysqli_real_escape_string($koneksi, $nama_kelompok_pilihan);
                $sql2 = "SELECT nama_mutarabbi from mutarabbi where nama_murabbi='$nama_murabbi_pilihan' and nama_kelompok = '$nama_kelompok_pilihan' ORDER BY nama_mutarabbi";

                $result2 = $koneksi->query($sql2);
                $jumlah_binaan_pilihan = $result2->num_rows;
                ?>
    
    <tr>
        <td><?=$i++;?></td>
        <td><?=$nama_murabbi_pilihan;?></td>
        <td><?= stripslashes($nama_kelompok_pilihan);?></td>
        <td><?=$jumlah_binaan_pilihan;?></td>
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
        $select = $koneksi->prepare("select count(januari_1), count(januari_2), count(januari_3), count(januari_4), count(januari_5), count(februari_1), count(februari_2), count(februari_3), count(februari_4), count(februari_5), count(maret_1), count(maret_2), count(maret_3), count(maret_4), count(maret_5), count(april_1), count(april_2), count(april_3), count(april_4), count(april_5), count(mei_1), count(mei_2), count(mei_3), count(mei_4), count(mei_5), count(juni_1), count(juni_2), count(juni_3), count(juni_4), count(juni_5), count(juli_1), count(juli_2), count(juli_3), count(juli_4), count(juli_5), count(agustus_1), count(agustus_2), count(agustus_3), count(agustus_4), count(agustus_5), count(september_1), count(september_2), count(september_3), count(september_4), count(september_5), count(oktober_1), count(oktober_2), count(oktober_3), count(oktober_4), count(oktober_5), count(november_1), count(november_2), count(november_3), count(november_4), count(november_5), count(desember_1), count(desember_2), count(desember_3), count(desember_4), count(desember_5) from rekap where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin = '$jenis_kelamin_pilih' and jenjang = '$jenjang_pilih';");
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
        $select = $koneksi->prepare("select count(januari_1), count(januari_2), count(januari_3), count(januari_4), count(januari_5), count(februari_1), count(februari_2), count(februari_3), count(februari_4), count(februari_5), count(maret_1), count(maret_2), count(maret_3), count(maret_4), count(maret_5), count(april_1), count(april_2), count(april_3), count(april_4), count(april_5), count(mei_1), count(mei_2), count(mei_3), count(mei_4), count(mei_5), count(juni_1), count(juni_2), count(juni_3), count(juni_4), count(juni_5), count(juli_1), count(juli_2), count(juli_3), count(juli_4), count(juli_5), count(agustus_1), count(agustus_2), count(agustus_3), count(agustus_4), count(agustus_5), count(september_1), count(september_2), count(september_3), count(september_4), count(september_5), count(oktober_1), count(oktober_2), count(oktober_3), count(oktober_4), count(oktober_5), count(november_1), count(november_2), count(november_3), count(november_4), count(november_5), count(desember_1), count(desember_2), count(desember_3), count(desember_4), count(desember_5) from rekap where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin = '$jenis_kelamin_pilih' and jenjang = '$jenjang_pilih';");
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
            }
            }
            ?>  
    </tr>
    <tr>    
        <td colspan="4">Jumlah Kelompok Tidak Berjalan</td> 
        <?php
        $select = $koneksi->prepare("select count(januari_1), count(januari_2), count(januari_3), count(januari_4), count(januari_5), count(februari_1), count(februari_2), count(februari_3), count(februari_4), count(februari_5), count(maret_1), count(maret_2), count(maret_3), count(maret_4), count(maret_5), count(april_1), count(april_2), count(april_3), count(april_4), count(april_5), count(mei_1), count(mei_2), count(mei_3), count(mei_4), count(mei_5), count(juni_1), count(juni_2), count(juni_3), count(juni_4), count(juni_5), count(juli_1), count(juli_2), count(juli_3), count(juli_4), count(juli_5), count(agustus_1), count(agustus_2), count(agustus_3), count(agustus_4), count(agustus_5), count(september_1), count(september_2), count(september_3), count(september_4), count(september_5), count(oktober_1), count(oktober_2), count(oktober_3), count(oktober_4), count(oktober_5), count(november_1), count(november_2), count(november_3), count(november_4), count(november_5), count(desember_1), count(desember_2), count(desember_3), count(desember_4), count(desember_5) from rekap where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin = '$jenis_kelamin_pilih' and jenjang = '$jenjang_pilih';");
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
        $select = $koneksi->prepare("select sum(januari_1), sum(januari_2), sum(januari_3), sum(januari_4), sum(januari_5), sum(februari_1), sum(februari_2), sum(februari_3), sum(februari_4), sum(februari_5), sum(maret_1), sum(maret_2), sum(maret_3), sum(maret_4), sum(maret_5), sum(april_1), sum(april_2), sum(april_3), sum(april_4), sum(april_5), sum(mei_1), sum(mei_2), sum(mei_3), sum(mei_4), sum(mei_5), sum(juni_1), sum(juni_2), sum(juni_3), sum(juni_4), sum(juni_5), sum(juli_1), sum(juli_2), sum(juli_3), sum(juli_4), sum(juli_5), sum(agustus_1), sum(agustus_2), sum(agustus_3), sum(agustus_4), sum(agustus_5), sum(september_1), sum(september_2), sum(september_3), sum(september_4), sum(september_5), sum(oktober_1), sum(oktober_2), sum(oktober_3), sum(oktober_4), sum(oktober_5), sum(november_1), sum(november_2), sum(november_3), sum(november_4), sum(november_5), sum(desember_1), sum(desember_2), sum(desember_3), sum(desember_4), sum(desember_5) from rekap where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin = '$jenis_kelamin_pilih' and jenjang = '$jenjang_pilih';");
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
        $select = $koneksi->prepare("select sum(januari_1), sum(januari_2), sum(januari_3), sum(januari_4), sum(januari_5), sum(februari_1), sum(februari_2), sum(februari_3), sum(februari_4), sum(februari_5), sum(maret_1), sum(maret_2), sum(maret_3), sum(maret_4), sum(maret_5), sum(april_1), sum(april_2), sum(april_3), sum(april_4), sum(april_5), sum(mei_1), sum(mei_2), sum(mei_3), sum(mei_4), sum(mei_5), sum(juni_1), sum(juni_2), sum(juni_3), sum(juni_4), sum(juni_5), sum(juli_1), sum(juli_2), sum(juli_3), sum(juli_4), sum(juli_5), sum(agustus_1), sum(agustus_2), sum(agustus_3), sum(agustus_4), sum(agustus_5), sum(september_1), sum(september_2), sum(september_3), sum(september_4), sum(september_5), sum(oktober_1), sum(oktober_2), sum(oktober_3), sum(oktober_4), sum(oktober_5), sum(november_1), sum(november_2), sum(november_3), sum(november_4), sum(november_5), sum(desember_1), sum(desember_2), sum(desember_3), sum(desember_4), sum(desember_5) from rekap where nama_murabbi!='LTT' and nama_murabbi!='Uji Coba' and angkatan_kelompok ='$angkatan_kelompok_pilih' and jenis_kelamin = '$jenis_kelamin_pilih' and jenjang = '$jenjang_pilih';");
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
            }
        }
            ?>
    </tr>
</table>

</body>
</html>