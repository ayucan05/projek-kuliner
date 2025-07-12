<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT foto FROM kuliner WHERE id='$id'");
$row = mysqli_fetch_assoc($data);
if ($row['foto']) {
    unlink("assets/img/" . $row['foto']); // hapus file
}

mysqli_query($koneksi, "DELETE FROM kuliner WHERE id='$id'");
header("Location: data_kuliner.php");
?>
