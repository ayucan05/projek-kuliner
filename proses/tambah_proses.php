<?php
include '../config/koneksi.php';

$nama      = $_POST['nama_tempat'];
$deskripsi = $_POST['deskripsi'];
$alamat    = $_POST['alamat'];
$kategori  = $_POST['kategori'];
$lat       = $_POST['latitude'];
$lng       = $_POST['longitude'];

// Upload foto
$foto = $_FILES['foto']['name'];
$tmp  = $_FILES['foto']['tmp_name'];
$path = "../assets/img/" . $foto;

if (move_uploaded_file($tmp, $path)) {
    $query = "INSERT INTO kuliner (nama_tempat, deskripsi, alamat, kategori, latitude, longitude, foto) 
              VALUES ('$nama', '$deskripsi', '$alamat', '$kategori', '$lat', '$lng', '$foto')";
    $insert = mysqli_query($koneksi, $query);

    if ($insert) {
        header("Location: ../admin/data_kuliner.php?status=berhasil");
    } else {
        echo "Gagal simpan ke database.";
    }
} else {
    echo "Gagal upload gambar.";
}
?>
