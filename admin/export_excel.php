
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data_kuliner.xls");
include '../config/koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM kuliner");
?>

<table border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Kategori</th>
        <th>Latitude</th>
        <th>Longitude</th>
    </tr>
    <?php $no = 1; while($data = mysqli_fetch_array($query)) { ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $data['nama_tempat'] ?></td>
        <td><?= $data['alamat'] ?></td>
        <td><?= $data['kategori'] ?></td>
        <td><?= $data['latitude'] ?></td>
        <td><?= $data['longitude'] ?></td>
    </tr>
    <?php } ?>
</table>
