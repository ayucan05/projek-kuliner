<?php
include 'config/koneksi.php';

// Ambil data kuliner dari database
$data = mysqli_query($koneksi, "SELECT * FROM kuliner");
$lokasi = [];
while ($row = mysqli_fetch_assoc($data)) {
    $lokasi[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Peta Kuliner Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h3 class="mb-3">Peta Kuliner Kota Bogor</h3>
    <div id="map"></div>
    <a href="admin/index.php" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqYmom7KdAatd2Fm_kWXr9YgmfUJyc1OQ"></script>
<script>
    function initMap() {
        const bogor = { lat: -6.595, lng: 106.816 };

        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: bogor
        });

        const locations = <?php echo json_encode($lokasi); ?>;

        locations.forEach(loc => {
            const marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(loc.latitude),
                    lng: parseFloat(loc.longitude)
                },
                map: map,
                title: loc.nama_tempat
            });

            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div>
                        <h6>${loc.nama_tempat}</h6>
                        <p>${loc.deskripsi}</p>
                        <p><strong>Alamat:</strong> ${loc.alamat}</p>
                        ${loc.foto ? `<img src="assets/img/${loc.foto}" width="100">` : ''}
                    </div>
                `
            });

            marker.addListener('click', () => {
                infoWindow.open(map, marker);
            });
        });
    }

    window.onload = initMap;
</script>

</body>
</html>
