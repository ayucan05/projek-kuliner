<?php
session_start();
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}

include '../config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Cari user di database
$query = "SELECT * FROM admin WHERE username='$username'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if ($data && password_verify($password, $data['password'])) {
    // Login berhasil
    $_SESSION['admin'] = $data['username'];
    header("Location: ../admin/index.php");
} else {
    // Gagal login
    $_SESSION['error'] = "Username atau password salah.";
    header("Location: ../admin/login.php");
}
?>
