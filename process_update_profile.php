<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $phone = $_POST['nohp']; // Ubah ini ke 'phone' jika sesuai dengan field di database
    $email = $_POST['email'];
    $education = $_POST['education'];
    $country = $_POST['country'];
    $city = $_POST['city'];

    

    // Query untuk melakukan pembaruan data profil
    $sql = "UPDATE `users` SET `name`='$name', `no_hp`='$phone', `email`='$email', `education`='$education',`country`='$country', `city_address`='$city' WHERE `id`='$user_id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect setelah proses update selesai
        header("Location: profile.php?id_user=$user_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>