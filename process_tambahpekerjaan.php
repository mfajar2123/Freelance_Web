<?php
include 'config.php'; // Memuat file config.php untuk koneksi

// Ambil data dari form tambah pekerjaan

$user_id = $_POST['freelancer_id'];
$nohp = $_POST['nohp'];
$jenispekerjaan = $_POST['jenispekerjaan'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$foto = $_POST['foto'];

$skills = $_POST['skills'];

$query = "INSERT INTO pekerjaan (nohp, jenispekerjaan, deskripsi, harga, foto, skills, freelancer_id) VALUES ('$nohp', '$jenispekerjaan', '$deskripsi', '$harga', '$foto', '$user_id', '$skills')";

// Eksekusi query dan proses lainnya...


if ($conn->query($query) === TRUE) {
    header("Location: dashboardfreelance.php");
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
