<?php
include '../config/koneksi.php';
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

if (!empty($_FILES['file_excel']['tmp_name'])) {
    $spreadsheet = IOFactory::load($_FILES['file_excel']['tmp_name']);

    // Gunakan array keyed by huruf kolom supaya lebih jelas
    $rows = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    //                  ↑     ↑     ↑     ↑
    //   null = kosong → isikan null,   true = formula dikonversi, …
    // Baris: ['A'=>..., 'B'=>..., ...]

    $berhasil = 0; $gagal = 0;

    foreach ($rows as $i => $row) {
        if ($i === 1) continue;                    // lewati header

        // Validasi kolom wajib
        if (empty($row['A']) || empty($row['E']) || empty($row['F'])) {
            $gagal++;  // catat gagal tapi lanjut
            continue;
        }

        $nama_tempat = mysqli_real_escape_string($koneksi, trim($row['A']));
        $deskripsi   = mysqli_real_escape_string($koneksi, trim($row['B'] ?? ''));
        $alamat      = mysqli_real_escape_string($koneksi, trim($row['C'] ?? ''));
        $kategori    = mysqli_real_escape_string($koneksi, trim($row['D'] ?? ''));
        $latitude    = floatval($row['E']);
        $longitude   = floatval($row['F']);

        // Siapkan query
        $sql = "INSERT INTO kuliner (nama_tempat, deskripsi, alamat, kategori, latitude, longitude)
                VALUES ('$nama_tempat', '$deskripsi', '$alamat', '$kategori', '$latitude', '$longitude')";

        if (mysqli_query($koneksi, $sql)) {
            $berhasil++;
        } else {
            $gagal++;
        }
    }

    header("Location: data_kuliner.php?status=import-success&ok=$berhasil&fail=$gagal");
    exit();
}
?>
