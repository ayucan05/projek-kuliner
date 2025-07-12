<?php
// get_kuliner_pdo.php
header('Content-Type: application/json');

$host = "localhost";
$user = "informa1_kulinerdb";
$pass = "Ayuzahra321";
$db   = "informa1_kuliner_db";
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $stmt = $pdo->query("SELECT * FROM kuliner");
    $data = $stmt->fetchAll();
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode([]); // kosongkan jika gagal
}
