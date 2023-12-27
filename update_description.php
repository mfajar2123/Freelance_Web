<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id']) && isset($_POST['deskripsi_order'])) {
    $orderId = $_POST['order_id'];
    $deskripsiOrder = $_POST['deskripsi_order'];

    // Lakukan validasi atau sanitasi data jika diperlukan

    // Lakukan perubahan pada kolom deskripsi_order untuk order_id yang diberikan
    $query = "UPDATE order_table SET deskripsi_order = '$deskripsiOrder' WHERE id_order = $orderId";

    if ($conn->query($query) === TRUE) {
        // Jika perubahan berhasil disimpan, redirect ke halaman riwayat_order.php
        header("Location: riwayat_order.php");
        exit();
    } else {
        // Penanganan jika terjadi kesalahan saat menyimpan perubahan
        echo "Gagal menyimpan perubahan.";
    }

    $conn->close();
} else {
    // Redirect jika data yang diberikan tidak lengkap atau tidak valid
    header("Location: riwayat_order.php");
    exit();
}

?>