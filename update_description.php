<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id']) && isset($_POST['deskripsi_order'])) {
    $orderId = $_POST['order_id'];
    $deskripsiOrder = $_POST['deskripsi_order'];

    // Lakukan validasi atau sanitasi data jika diperlukan

    // Lakukan koneksi ke basis data
    // Lakukan perubahan pada kolom deskripsi_order untuk order_id yang diberikan
    $query = "UPDATE order_table SET deskripsi_order = ? WHERE id_order = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $deskripsiOrder, $orderId);

    if ($stmt->execute()) {
        // Jika perubahan berhasil disimpan, redirect ke halaman riwayat_order.php
        header("Location: riwayat_order.php");
        exit();
    } else {
        // Penanganan jika terjadi kesalahan saat menyimpan perubahan
        echo "Gagal menyimpan perubahan.";
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect jika data yang diberikan tidak lengkap atau tidak valid
    header("Location: riwayat_order.php");
    exit();
}
?>