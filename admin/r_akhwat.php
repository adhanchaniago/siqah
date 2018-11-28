<?php
include '../koneksi.php';
include 'akses.php';
?>

<table border="1 solid black">
  <tr>
    <th>No.</th>
    <th>Nama Mutarabbi</th>
    <th>Prodi</th>
    <th>Angkatan</th>
    <th>Nama Murabbi</th>
    <th>Jenjang</th>
    <th>Nama Kelompok</th>
    <th>No. HP</th>
    <th>Alamat</th>
  </tr>
  <?php
  $i = 1;
  $select = $koneksi->prepare("SELECT mutarabbi.nama_mutarabbi, mutarabbi.prodi, mutarabbi.angkatan, mutarabbi.nama_murabbi, mutarabbi.jenjang, mutarabbi.nama_kelompok, mutarabbi.no_hp, mutarabbi.alamat FROM mutarabbi, murabbi WHERE mutarabbi.nama_murabbi = murabbi.nama_murabbi AND murabbi.jenis_kelamin = 'Akhwat' ORDER BY nama_murabbi, nama_kelompok, nama_mutarabbi ASC;");
        $select->execute();
        $select->store_result();
        $select->bind_result($nama_mutarabbi, $prodi, $angkatan, $nama_murabbi, $jenjang, $nama_kelompok, $no_hp, $alamat);
        while($select->fetch())
        {
        ?>
  <tr>
    <td><?=$i++;?></td>
    <td><?=$nama_mutarabbi;?></td>
    <td><?=$prodi;?></td>
    <td><?=$angkatan;?></td>
    <td><?=$nama_murabbi;?></td>
    <td><?=$jenjang;?></td>
    <td><?=$nama_kelompok;?></td>
    <td><?=$no_hp;?></td>
    <td><?=$alamat;?></td>
  </tr>
  <?php
        }
        ?>
</table>