<?php
$host = "localhost";
$user = "informa1_kulinerdb";
$pass = "Ayuzahra321";
$db   = "informa1_kuliner_db";

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
