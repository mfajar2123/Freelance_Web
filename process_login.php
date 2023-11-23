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
    if ($user['is_freelancer'] == 1) {
        header("Location: dashboardfreelance.php");
    } else {
        header("Location: dashboard.php");
    }
} else {
    echo "Gagal login";
}

?>
