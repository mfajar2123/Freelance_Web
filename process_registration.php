<?php
include 'config.php'; // Memuat file config.php untuk koneksi

// Ambil data dari form registrasi
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$is_freelancer = isset($_POST['is_freelancer']) ? 1 : 0; // Cek apakah user adalah freelancer

// Simpan data ke database
$query = "INSERT INTO users (name,username, email, password, is_freelancer) VALUES ('$name','$username', '$email', '$password', $is_freelancer)";

if ($conn->query($query) === TRUE) {
    header("Location: login.php");
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
