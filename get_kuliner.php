<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Coba koneksi ke DB
include_once('config/koneksi.php');

$data = [];

// Test koneksi
if (!$koneksi) {
    echo json_encode(["error" => "Koneksi ke database gagal."]);
    exit;
}

// Jalankan query
$query = mysqli_query($koneksi, "SELECT * FROM kuliner");

// Test query
if (!$query) {
    echo json_encode(["error" => "Query SQL gagal."]);
    exit;
}

// Ambil data
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);
