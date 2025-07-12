<?php
include 'config/koneksi.php';

// Ambil keyword pencarian
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

// Query pencarian
$query = "SELECT * FROM kuliner WHERE 
          nama_tempat LIKE '%$searchTerm%' OR 
          kategori LIKE '%$searchTerm%' OR 
          alamat LIKE '%$searchTerm%'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
        ?>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden kuliner-item">
            <?php if (!empty($data['foto'])): ?>
                <img src="assets/img/<?= htmlspecialchars($data['foto']) ?>" 
                     alt="<?= htmlspecialchars($data['nama_tempat']) ?>" 
                     class="w-full h-64 object-cover">
            <?php else: ?>
                <img src="https://via.placeholder.com/400x300?text=No+Image" 
                     alt="No Image" 
                     class="w-full h-64 object-cover">
            <?php endif; ?>
            <div class="p-4">
                <h3 class="text-xl font-semibold text-gray-800 mb-2 kuliner-nama">
                    <?= htmlspecialchars($data['nama_tempat']) ?>
                </h3>
                <!-- <p class="text-gray-600 mb-4 kuliner-kategori"><?= htmlspecialchars($data['kategori']) ?></p> -->
                <div class="flex justify-between">
                    <?php if (!empty($data['nomor_wa'])): ?>
                        <a href="https://wa.me/<?= htmlspecialchars($data['nomor_wa']) ?>/?text=Halo%20saya%20mau%20pesan%20kuliner%20<?= urlencode($data['nama_tempat']) ?>"
                           class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                            Pesan
                        </a>
                    <?php endif; ?>
                    <a href="detailkuliner.php?id=<?= $data['id'] ?>"
                       class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition">
                        Detail Kuliner
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo '<p class="col-span-full text-center text-red-500">Tidak ditemukan hasil pencarian.</p>';
}
?>