<?php
include_once('config/koneksi.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$allData = [];
$query = mysqli_query($koneksi, "SELECT * FROM kuliner");

if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
        $allData[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO.KULINER BOGOR - Sistem Informasi Geografis Wisata Kuliner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        #map { height: 500px; }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .testimonial-bg {
            background-image: url('https://images.unsplash.com/photo-1514933651103-005eec06c04b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.1;
        }
        .mobile-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            padding: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .mobile-menu.active {
            display: block;
        }
        .mobile-menu a {
            display: block;
            padding: 0.75rem 0;
            color: #4b5563;
        }
        .mobile-menu a:hover {
            color: #ea580c;
        }
    </style>
</head>
<body class="font-sans bg-gray-50">
    <!-- Header/Navbar -->
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="#" class="flex items-center">
                <span class="text-2xl font-bold text-orange-600">GO.KULINER</span>
            </a>
            
            <nav class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-orange-600 font-medium">Beranda</a>
                <a href="#about" class="text-gray-700 hover:text-orange-600">Tentang</a>
                <a href="#features" class="text-gray-700 hover:text-orange-600">List Kuliner</a>
                <a href="#map-section" class="text-gray-700 hover:text-orange-600">Peta Kuliner</a>
                <!-- <a href="#testimonials" class="text-gray-700 hover:text-orange-600">Ulasan</a> -->
                <a href="#contact" class="text-gray-700 hover:text-orange-600">Kontak</a>
            </nav>
            
            <button id="mobile-menu-button" class="md:hidden text-gray-700">
                <i class="ri-menu-line text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu md:hidden">
            <a href="#home" class="text-orange-600">Beranda</a>
            <a href="#about" class="text-gray-700">Tentang</a>
            <a href="#features" class="text-gray-700">List Kuliner</a>
            <a href="#map-section" class="text-gray-700">Peta Kuliner</a>
            <a href="#testimonials" class="text-gray-700">Ulasan</a>
            <a href="#contact" class="text-gray-700">Kontak</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="py-20 bg-gradient-to-r from-orange-50 to-amber-50">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    Temukan <span class="text-orange-600">Wisata Kuliner</span> Terbaik di Bogor
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    Sistem Informasi Geografis pemetaan tempat makan di Kota Bogor. Temukan warung, restoran, dan kafe terbaik dengan mudah.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#map-section" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-medium text-center transition duration-300">
                        Lihat Peta
                    </a>
                    <a href="#about" class="border border-orange-600 text-orange-600 hover:bg-orange-50 px-6 py-3 rounded-lg font-medium text-center transition duration-300">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            <div class="md:w-1/2">
                <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                     alt="Kuliner Bogor" 
                     class="rounded-xl shadow-xl w-full h-auto">
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Tentang GO.KULINER BOGOR</h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto"></div>
            </div>
            
            <div class="flex flex-col md:flex-row items-center gap-10">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <img src="https://images.unsplash.com/photo-1544025162-d76694265947?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                         alt="Tentang Kami" 
                         class="rounded-xl shadow-lg w-full h-auto">
                </div>
                <div class="md:w-1/2">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">
                        "Bogor bukan hanya tentang hujan, tapi juga tentang kenangan rasa di setiap sudut kulinernya."
                    </h3>
                    <p class="text-gray-600 mb-6">
                        GO.Kuliner Bogor adalah platform digital yang menyediakan informasi geografis tentang tempat-tempat wisata kuliner di Kota Bogor. 
                        Kami memetakan berbagai warung makan, restoran, kafe, dan tempat kuliner lainnya untuk memudahkan wisatawan dan warga Bogor 
                        menemukan tempat makan yang sesuai dengan preferensi mereka.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="ri-checkbox-circle-fill text-orange-600 mt-1 mr-2"></i>
                            <span class="text-gray-700">Pemetaan lengkap kuliner Bogor</span>
                        </li>
                        <li class="flex items-start">
                            <i class="ri-checkbox-circle-fill text-orange-600 mt-1 mr-2"></i>
                            <span class="text-gray-700">Informasi detail setiap lokasi</span>
                        </li>
                        <li class="flex items-start">
                            <i class="ri-checkbox-circle-fill text-orange-600 mt-1 mr-2"></i>
                            <span class="text-gray-700">Filter berdasarkan jenis makanan</span>
                        </li>
                        <li class="flex items-start">
                            <i class="ri-checkbox-circle-fill text-orange-600 mt-1 mr-2"></i>
                            <span class="text-gray-700">Rating dan ulasan pengunjung</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">List Kuliner</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Berbagai list yang akan memudahkan Anda menemukan tempat kuliner terbaik di Bogor
            </p>
            <div class="w-20 h-1 bg-orange-600 mx-auto mt-4"></div>
        </div>

        <!-- Search Box untuk Live Search -->
        <div class="mb-8 max-w-md mx-auto">
            <div class="relative">
                <input 
                    type="text" 
                    id="live-search" 
                    placeholder="Cari tempat kuliner..." 
                    class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition"
                >
                <div class="absolute left-3 top-3.5 text-gray-400">
                    <i class="ri-search-line"></i>
                </div>
            </div>
        </div>

        <!-- Container untuk hasil pencarian -->
        <div id="kuliner-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <?php if (count($allData) > 0): ?>
                <?php foreach ($allData as $data): ?>
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
                <?php endforeach; ?>
            <?php else: ?>
                <p class="col-span-full text-center text-red-500">Belum ada data kuliner.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Live Search dengan AJAX
    $('#live-search').on('keyup', function() {
        var searchTerm = $(this).val().toLowerCase();
        
        if(searchTerm.length > 0) {
            $.ajax({
                url: 'search_kuliner.php', // File PHP untuk memproses pencarian
                type: 'POST',
                data: { search: searchTerm },
                success: function(response) {
                    $('#kuliner-container').html(response);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + status + " - " + error);
                }
            });
        } else {
            // Jika search kosong, tampilkan semua data
            $.ajax({
                url: 'search_kuliner.php',
                type: 'POST',
                data: { search: '' },
                success: function(response) {
                    $('#kuliner-container').html(response);
                }
            });
        }
    });
});
</script>

    <!-- Map Section -->
    <section id="map-section" class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Peta Kuliner Bogor</h2>
                <p class="text-gray-600 mt-2">
                    Temukan tempat makan favorit Anda di Kota Bogor
                </p>
            </div>

            <!-- Search Box -->
            <div class="mb-6">
                <div class="relative max-w-2xl mx-auto">
                    <input 
                        type="text" 
                        id="search" 
                        placeholder="Cari tempat kuliner..." 
                        class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition"
                    >
                    <div class="absolute left-3 top-3.5 text-gray-400">
                        <i class="ri-search-line"></i>
                    </div>
                </div>
            </div>

            <!-- Map Container -->
            <div id="map" class="rounded-xl shadow-lg overflow-hidden h-96 w-full"></div>
        </div>
    </section>

    <!-- Google Maps Script -->
    
    <script>
        let markers = [];
        let map;

function initMap() {
    const bogor = { lat: -6.595038, lng: 106.816635 };
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 13,
        center: bogor,
        mapTypeId: 'roadmap'
    });

    fetch("get_kuliner_pdo.php")
        .then(res => res.json())
        .then(data => {
            console.log("Data marker:", data);

            data.forEach(item => {
                const lat = parseFloat(item.latitude);
                const lng = parseFloat(item.longitude);
                if (isNaN(lat) || isNaN(lng)) return;

                const marker = new google.maps.Marker({
                    position: { lat, lng },
                    map,
                    title: item.nama_tempat
                });

                const popup = `
                    <div style="width: 250px;">
                        <h5 style="font-weight: bold;">${item.nama_tempat}</h5>
                        <p><strong>Alamat:</strong> ${item.alamat}</p>
                        <p><strong>Kategori:</strong> ${item.kategori}</p>
                        ${item.foto ? `<img src='assets/img/${item.foto}' style='width:100%; margin-top:10px;'>` : ''}
                        <div style="margin-top:10px;">
                            <a href="detailkuliner.php?id=${item.id}" style="background:#ea580c; color:#fff; padding:5px 10px; border-radius:4px; text-decoration:none;">Lihat Detail</a>
                        </div>
                    </div>
                `;

                const infoWindow = new google.maps.InfoWindow({ content: popup });
                marker.addListener("click", () => infoWindow.open(map, marker));
            });
        })
        .catch(err => {
            console.error("Gagal ambil data marker:", err);
        });

            // Search functionality
            const searchInput = document.getElementById('search');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase();
                    markers.forEach(item => {
                        if (item.nama.includes(keyword) || 
                            item.alamat.includes(keyword) || 
                            item.kategori.includes(keyword)) {
                            item.marker.setMap(map);
                        } else {
                            item.marker.setMap(null);
                        }
                    });
                });
            }
        }

       window.initMap = initMap;
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQLHdoWey-cwIO1xUeoVHndtVZyKT12NA&callback=initMap&v=3.31" async defer></script>

    <!-- Testimonials Section -->

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Hubungi Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Punya pertanyaan atau masukan? Silakan hubungi tim kami</p>
                <div class="w-20 h-1 bg-orange-600 mx-auto mt-4"></div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-10">
                <div class="md:w-1/2">
                    <div class="bg-gray-50 p-8 rounded-xl shadow-md">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi Kontak</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="text-orange-600 mr-4 mt-1">
                                    <i class="ri-map-pin-line text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">Alamat</h4>
                                    <p class="text-gray-600">Jl. Raya Pajajaran No.25, Bogor, Jawa Barat</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="text-orange-600 mr-4 mt-1">
                                    <i class="ri-phone-line text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">Telepon</h4>
                                    <p class="text-gray-600">+62 123 4567 890</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="text-orange-600 mr-4 mt-1">
                                    <i class="ri-mail-line text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">Email</h4>
                                    <p class="text-gray-600">info@gokulinerbogor.id</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="text-orange-600 mr-4 mt-1">
                                    <i class="ri-time-line text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">Jam Operasional</h4>
                                    <p class="text-gray-600">Senin - Jumat: 09:00 - 17:00</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <h4 class="font-bold text-gray-800 mb-4">Ikuti Kami</h4>
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-700 hover:text-orange-600 transition">
                                    <i class="ri-facebook-fill text-2xl"></i>
                                </a>
                                <a href="#" class="text-gray-700 hover:text-orange-600 transition">
                                    <i class="ri-twitter-x-line text-2xl"></i>
                                </a>
                                <a href="#" class="text-gray-700 hover:text-orange-600 transition">
                                    <i class="ri-instagram-line text-2xl"></i>
                                </a>
                                <a href="#" class="text-gray-700 hover:text-orange-600 transition">
                                    <i class="ri-youtube-line text-2xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="md:w-1/2">
                    <form class="bg-gray-50 p-8 rounded-xl shadow-md">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                                <input type="text" id="name" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
                            </div>
                            <div>
                                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                                <input type="email" id="email" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <label for="subject" class="block text-gray-700 font-medium mb-2">Subjek</label>
                            <input type="text" id="subject" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
                        </div>
                        
                        <div class="mb-6">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Pesan</label>
                            <textarea id="message" rows="5" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition"></textarea>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-orange-600 hover:bg-orange-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <h3 class="text-xl font-bold mb-6">GO.KULINER BOGOR</h3>
                    <p class="text-gray-400 mb-6">
                        Sistem Informasi Geografis pemetaan wisata kuliner Kota Bogor. Temukan tempat makan terbaik di Kota Hujan dengan mudah.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-orange-500 transition">
                            <i class="ri-facebook-fill text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-orange-500 transition">
                            <i class="ri-twitter-x-line text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-orange-500 transition">
                            <i class="ri-instagram-line text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold text-lg mb-6">Tautan Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="#home" class="text-gray-400 hover:text-orange-500 transition">Beranda</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-orange-500 transition">Tentang Kami</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-orange-500 transition">List kuliner</a></li>
                        <li><a href="#map-section" class="text-gray-400 hover:text-orange-500 transition">Peta Kuliner</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-orange-500 transition">Kontak</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-lg mb-6">Kategori Kuliner</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-orange-500 transition">Restoran</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-orange-500 transition">Warung Makan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-orange-500 transition">Kafe</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-orange-500 transition">Street Food</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-orange-500 transition">Makanan Khas Bogor</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-lg mb-6">Newsletter</h4>
                    <p class="text-gray-400 mb-4">
                        Berlangganan newsletter kami untuk mendapatkan update terbaru tentang tempat kuliner di Bogor.
                    </p>
                    <form class="flex">
                        <input type="email" placeholder="Email Anda" 
                               class="px-4 py-2 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-orange-500 text-gray-800 w-full">
                        <button type="submit" 
                                class="bg-orange-600 hover:bg-orange-700 px-4 py-2 rounded-r-lg transition">
                            <i class="ri-send-plane-line"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>© 2023 GO.KULINER BOGOR. All Rights Reserved. Designed by <a href="#" class="text-orange-500 hover:underline">Tim GO.Kuliner</a></p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" id="back-to-top" class="fixed bottom-8 right-8 bg-orange-600 text-white p-3 rounded-full shadow-lg opacity-0 invisible transition-all duration-300">
        <i class="ri-arrow-up-line text-xl"></i>
    </a>

    <script>
        // Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            
            // Ganti ikon menu/close
            const icon = mobileMenuButton.querySelector('i');
            if (mobileMenu.classList.contains('active')) {
                icon.classList.remove('ri-menu-line');
                icon.classList.add('ri-close-line');
            } else {
                icon.classList.remove('ri-close-line');
                icon.classList.add('ri-menu-line');
            }
        });

        // Tutup menu ketika mengklik item menu
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                mobileMenuButton.querySelector('i').classList.remove('ri-close-line');
                mobileMenuButton.querySelector('i').classList.add('ri-menu-line');
            });
        });

        // Back to Top Button
        const backToTop = document.getElementById('back-to-top');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTop.classList.remove('opacity-0', 'invisible');
                backToTop.classList.add('opacity-100', 'visible');
            } else {
                backToTop.classList.add('opacity-0', 'invisible');
                backToTop.classList.remove('opacity-100', 'visible');
            }
        });

        backToTop.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>