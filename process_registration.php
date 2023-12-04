<?php
session_start();

include 'config.php'; // Sambungan ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Lakukan validasi data di sini sesuai kebutuhan

    // Query untuk menyimpan pengguna baru ke tabel users
    $query = "INSERT INTO users ( username, email, password, role) VALUES ( '$username', '$email', '$password', '$role')";
    
    if ($conn->query($query) === TRUE) {
        header("Location: login.php");
        // Redirect ke halaman login atau halaman lainnya
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
