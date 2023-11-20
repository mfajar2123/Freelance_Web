<?php
session_start();

include 'config.php'; // Memuat file config.php untuk koneksi

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['is_freelancer'] = $user['is_freelancer'];
    header("Location: dashboard.php");
} else {
    echo "Gagal login";
}
?>
