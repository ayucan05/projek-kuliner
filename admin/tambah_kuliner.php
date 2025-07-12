<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kuliner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        #map {
            height: 300px;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h4>Tambah Tempat Kuliner</h4>

    <!-- Tambah pesan error jika sebelumnya ada -->
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="../proses/tambah_proses.php" method="post" enctype="multipart/form-data" onsubmit="return cekKoordinat();">
        <div class="mb-3">
            <label>Nama Tempat</label>
            <input type="text" name="nama_tempat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="2"></textarea>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control">
        </div>
        <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <div class="mb-3">
            <label>Lokasi di Peta (klik untuk ambil koordinat)</label>
            <div id="map"></div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Latitude</label>
                <input type="text" id="lat" name="latitude" class="form-control" readonly required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Longitude</label>
                <input type="text" id="lng" name="longitude" class="form-control" readonly required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQLHdoWey-cwIO1xUeoVHndtVZyKT12NA&callback=initMap&v=3.31" async defer></script>
<script>
    let map, marker;

    function initMap() {
        const bogor = { lat: -6.595, lng: 106.816 };

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: bogor,
        });

        map.addListener("click", function (event) {
            const lat = event.latLng.lat();
            const lng = event.latLng.lng();

            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;

            if (marker) {
                marker.setMap(null);
            }

            marker = new google.maps.Marker({
                position: { lat: lat, lng: lng },
                map: map,
                draggable: false,
            });
        });
    }

    function cekKoordinat() {
        const lat = document.getElementById("lat").value;
        const lng = document.getElementById("lng").value;
        if (lat === "" || lng === "") {
            alert("Silakan klik lokasi di peta terlebih dahulu.");
            return false;
        }
        return true;
    }

    window.onload = initMap;
</script>
</body>
</html>
