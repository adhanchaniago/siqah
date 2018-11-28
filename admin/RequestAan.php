<?php
include '../koneksi.php';
include 'akses.php';
?>

<!DOCTYPE html>
<html>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<head>
  <title></title>
</head>
<body>

<table border="1">
  <tr>
    <th>No.</th>
    <th>Jenis Kelamin</th>
    <th>Prodi</th>
    <th>Angkatan</th>    
    <th>Nama Murabbi</th>
    <th>Nama Mutarabbi</th>
    <th>januari 1</th>
    <th>januari 2</th>
    <th>januari 3</th>
    <th>januari 4</th>
    <th>januari 5</th>
  </tr>
  <?php
  $i = 1;
  $select = $koneksi->prepare("SELECT murabbi.jenis_kelamin, mutarabbi.prodi, mutarabbi.angkatan, mutarabbi.nama_murabbi, mutarabbi.nama_mutarabbi, rekap_mutarabbi.januari_1, rekap_mutarabbi.januari_2, rekap_mutarabbi.januari_3, rekap_mutarabbi.januari_4, rekap_mutarabbi.januari_5 FROM mutarabbi, murabbi, rekap_mutarabbi WHERE rekap_mutarabbi.tahun = '2018' AND murabbi.nama_murabbi = mutarabbi.nama_murabbi AND mutarabbi.nama_mutarabbi = rekap_mutarabbi.nama_mutarabbi ORDER BY murabbi.jenis_kelamin ASC");
        $select->execute();
        $select->store_result();
        $select->bind_result($jenis_kelamin, $prodi, $angkatan, $nama_murabbi, $nama_mutarabbi, $januari_1, $januari_2, $januari_3, $januari_4, $januari_5);
        while($select->fetch())
        {
        ?>
  <tr>
    <td><?=$i++;?></td>
    <td><?=$jenis_kelamin;?></td>
    <td><?=$prodi;?></td>
    <td><?=$angkatan;?></td>
    <td><?=$nama_murabbi;?></td>
    <td><?=$nama_mutarabbi;?></td>
    <td><?=$januari_1;?></td>
    <td><?=$januari_2;?></td>
    <td><?=$januari_3;?></td>
    <td><?=$januari_4;?></td>
    <td><?=$januari_5;?></td>
  </tr>
  <?php
        }
        ?>
</table>

</body>
</html>