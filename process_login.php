<?php
session_start();

include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_foto'] = $user['foto_profil'];
    $_SESSION['user_role']= $user['role'];

    // Check if the user is an admin
    if ($user['role'] == 'freelancer') {
        header("Location: dashboardfreelance.php");
    } elseif ($user['role'] == 'admin') {
        header("Location: dashboardadmin.php");
    } else {
        // For other roles, you can redirect to a default dashboard or handle accordingly
        header("Location: dashboard.php");
    }
} else {
    echo "Gagal login";
}
?>
