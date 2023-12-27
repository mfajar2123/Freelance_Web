<?php
session_start(); // Pastikan session telah dimulai sebelum menggunakan $_SESSION

include 'config.php';
// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Ambil ID notifikasi dari parameter GET
if (isset($_GET['id'])) {
    $notif_id = $_GET['id'];

    
    $sql = "UPDATE notifications SET is_read = 1 WHERE id = $notif_id";

    if ($conn->query($sql) === TRUE) {
        // Ambil data notifikasi untuk mengecek notification_type
        $select_sql = "SELECT notification_type FROM notifications WHERE id = $notif_id";
        $result = $conn->query($select_sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $notification_type = $row['notification_type'];

            // Periksa notification_type, jika "order berhasil", redirect ke riwayat_order.php
            if ($notification_type === "Order Berhasil" || $notification_type === "Pesanan Selesai") {
                echo "<script>window.location.replace('riwayat_order.php');</script>";
            } else {
                // Jika tidak, redirect ke halaman notifikasi
                $user_id = $_SESSION['user_id'];
                echo "<script>window.location.replace('tes_notif.php?id_user=$user_id');</script>";
            }
            
        } else {
            echo "Data notifikasi tidak ditemukan";
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "ID notifikasi tidak ditemukan";
}


$conn->close();
?>