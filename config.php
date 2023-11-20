<?php
$host = 'localhost';
$dbname = 'freelance_web';
$username = 'root';
$password = '';

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
