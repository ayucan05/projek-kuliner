<?php

include 'header.php';
?>


<div class="container mt-4">
<h3 class="mb-4">Daftar Tempat Kuliner</h3>
<a href="tambah_kuliner.php" class="btn btn-success mb-3 me-2">+ Tambah Kuliner</a>
<a href="export_excel.php" target="_blank" class="btn btn-success mb-3">📥 Export ke Excel</a>
<!-- Tombol untuk membuka modal -->
<button type="button" class="btn btn-primary mb-3 me-2" data-bs-toggle="modal" data-bs-target="#importModal">
    📤 Import dari Excel
</button>
<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="import_excel.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="importModalLabel">Impor Data dari Excel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="file_excel" class="form-label">Pilih File Excel</label>
            <input type="file" class="form-control" name="file_excel" accept=".xls,.xlsx" required>
            <small class="text-muted">Format file harus .xls atau .xlsx. <a href="../assets/template_kuliner.xlsx">Download template</a></small>
          </div>
          <div class="alert alert-info">
            <strong>Petunjuk:</strong>
            <ul>
              <li>Kolom: Title, Description, Information, Latitude, Longitude</li>
              <li>Baris pertama adalah header (jangan diubah)</li>
              <li>Gunakan titik (.) untuk desimal</li>
              <li>Gunakan format HTML sederhana di kolom informasi</li>
            </ul>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Impor Data</button>
        </div>
      </form>
    </div>
  </div>
</div>


    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Tempat</th>
                <th>Deskripsi</th>
                <th>Alamat</th>
                <th>Lat</th>
                <th>Lng</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM kuliner");
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_tempat']; ?></td>
                <td><?= $row['deskripsi']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td><?= $row['latitude']; ?></td>
                <td><?= $row['longitude']; ?></td>
                <td>
                    <?php if ($row['foto']): ?>
                        <img src="../assets/img/<?= $row['foto']; ?>" width="80">
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <a href="edit_kuliner.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_kuliner.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
</div>

</body>
</html>
