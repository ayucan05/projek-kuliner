<?php
include '../config/koneksi.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM kuliner WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

// Tangani form submit sebelum ada output apapun
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $alamat = $_POST['alamat'];
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];

    if ($_FILES['foto']['name'] != '') {
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, "../assets/img/" . $foto);
    } else {
        $foto = $data['foto'];
    }

    mysqli_query($koneksi, "UPDATE kuliner SET 
        nama_tempat='$nama', 
        deskripsi='$deskripsi', 
        alamat='$alamat', 
        latitude='$lat', 
        longitude='$lng', 
        foto='$foto' 
        WHERE id='$id'");

    header("Location: data_kuliner.php");
    exit;
}

include 'header.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Kuliner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Edit Data Kuliner</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">
        <div class="mb-3">
            <label>Nama Tempat</label>
            <input type="text" name="nama" class="form-control" value="<?= $data['nama_tempat']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required><?= $data['deskripsi']; ?></textarea>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required><?= $data['alamat']; ?></textarea>
        </div>
         <div class="mb-3">
            <label>Kategori</label>
            <textarea name="kategori" class="form-control" required><?= $data['kategori']; ?></textarea>
        </div>
        <div class="mb-3">
            <label>Latitude</label>
            <input type="text" name="latitude" class="form-control" value="<?= $data['latitude']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Longitude</label>
            <input type="text" name="longitude" class="form-control" value="<?= $data['longitude']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Foto (opsional)</label><br>
            <img src="../assets/img/<?= $data['foto']; ?>" width="100"><br>
            <input type="file" name="foto" class="form-control mt-2">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="data_kuliner.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
