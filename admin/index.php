<?php
include 'header.php';

?>


<div class="container">
    
    <h3>
    Selamat Datang, 
    <?= isset($_SESSION['admin']) ? htmlspecialchars($_SESSION['admin']) : 'admin'; ?>!
  </h3>
    
    <div class="row">
        <!-- Dashboard Cards -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Jumlah Tempat Kuliner</h5>
                </div>
                <div class="card-body">
                    <?php
                    include '../config/koneksi.php';
                    $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kuliner");
                    $data = mysqli_fetch_assoc($query);
                    echo "<h2>" . $data['total'] . "</h2>";
                    ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Kuliner</h5>
                </div>
                <div class="card-body">
                    <a href="tambah_kuliner.php" class="btn btn-dashboard w-100">Tambah Tempat</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Kelola Data</h5>
                </div>
                <div class="card-body">
                    <a href="../peta.php" class="btn btn-dashboard w-100">Lihat Peta Kuliner</a>

                </div>
            </div>
        </div>
    </div>

    

<?php
include 'footer.php';
?>


