<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['ganti'])) {
    $username = $_SESSION['username'];
    $password_lama = $_POST['password_lama'];
    $password_baru = password_hash($_POST['password_baru'], PASSWORD_DEFAULT);

    $cek = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username'");
    $data = mysqli_fetch_assoc($cek);

    if (password_verify($password_lama, $data['password'])) {
        mysqli_query($koneksi, "UPDATE admin SET password='$password_baru' WHERE username='$username'");
        echo "<script>alert('Password berhasil diubah!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Password lama salah!');</script>";
    }
}
?>

<h2>Ganti Password</h2>
<form method="POST">
    <input type="password" name="password_lama" placeholder="Password Lama" required><br>
    <input type="password" name="password_baru" placeholder="Password Baru" required><br>
    <button type="submit" name="ganti">Ganti Password</button>
</form>
