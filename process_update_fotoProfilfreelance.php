<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id']; // Menggunakan ID user dari sesi, sesuaikan dengan struktur aplikasi Anda

    // Query untuk mengambil data user dari tabel users
    $sql = "SELECT * FROM `users` WHERE id=$user_id";
    $result = $conn->query($sql);

    // Pastikan query berhasil dijalankan sebelum melanjutkan
    if ($result) {
        $user = [];
        while ($row = $result->fetch_assoc()) {
            $user[] = $row;
        }
    } else {
        echo "Error: " . $conn->error;
        die;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Foto diunggah
    $user_id = $_SESSION['user_id'];
    $targetDirectory = __DIR__ . '/assets/img/users/';
    $targetFile = $targetDirectory . basename($_FILES["editPhoto"]["name"]);
    $uploadOk = 1;

    // Batasi ukuran file (contoh diset maksimal 5MB)
    if ($_FILES["editPhoto"]["size"] > 15 * 1024 * 1024) {
        echo "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Izinkan hanya beberapa tipe file tertentu (misalnya: hanya gambar)
    $allowedExtensions = array("jpg", "pdf", "jpeg", "png", "gif");
    $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "Maaf, hanya file JPG, JPEG, pdf, PNG, dan GIF yang diizinkan.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Maaf, file tidak diunggah.";
    } else {
        // Coba unggah file
        if (move_uploaded_file($_FILES["editPhoto"]["tmp_name"], $targetFile)) {
            // Update foto profil dalam database jika pengunggahan berhasil
            $file = $_FILES["editPhoto"]["name"];
            $updatePhotoQuery = "UPDATE `users` SET `foto_profil`='$file' WHERE `id`='$user_id'";
            if ($conn->query($updatePhotoQuery) === TRUE) {
                echo "File " . basename($_FILES["editPhoto"]["name"]) . " berhasil diunggah.";
                // Refresh halaman setelah update foto profil
                header("Location: profile_freelance.php?user_id=$user_id");
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }
}
?>