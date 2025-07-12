<?php
include "config/koneksi.php"; // ganti sesuai struktur kamu
?>
<div class="container">
    <h1>Detail Kuliner</h1>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $koneksi->prepare("SELECT * FROM kuliner WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $kuliner = $result->fetch_assoc();

        if ($kuliner) {
            echo '<h2>' . htmlspecialchars($kuliner['nama_tempat']) . '</h2>';

            if (!empty($kuliner['foto'])) {
                echo '<img src="assets/img/' . htmlspecialchars($kuliner['foto']) . '" width="500" height="300" style="object-fit:cover; margin-bottom: 20px;">';
            }

            echo '<p><strong>Deskripsi:</strong> ' . nl2br(htmlspecialchars($kuliner['deskripsi'])) . '</p>';
            echo '<p><strong>Alamat:</strong> ' . htmlspecialchars($kuliner['alamat']) . '</p>';
            echo '<p><strong>Kategori:</strong> ' . htmlspecialchars($kuliner['kategori']) . '</p>';
            echo '<p><strong>Koordinat:</strong> ' . htmlspecialchars($kuliner['latitude']) . ', ' . htmlspecialchars($kuliner['longitude']) . '</p>';
        } else {
            echo '<p>Data kuliner tidak ditemukan.</p>';
        }
    } else {
        echo '<p>ID kuliner tidak ditemukan.</p>';
    }
    ?>
    <a href="index.php" class="text-gray-700 hover:text-orange-600">Kembali</a>
</div>

