<?php
include 'config.php'; // Memuat file config.php untuk koneksi

// Ambil data dari form tambah pekerjaan
$user_id = $_POST['user_id'];
$nama = $_POST['nama'];
$nohp = $_POST['nohp'];
$jenispekerjaan = $_POST['jenispekerjaan'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$foto = $_POST['foto'];

$query = "INSERT INTO pekerjaan (nama, nohp, jenispekerjaan, deskripsi, harga, foto, user_id) VALUES ('$nama', '$nohp', '$jenispekerjaan', '$deskripsi', '$harga', '$foto', '$user_id')";

// Eksekusi query dan proses lainnya...


if ($conn->query($query) === TRUE) {
    header("Location: dashboardfreelance.php");
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
