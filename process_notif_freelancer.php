<?php
session_start(); // Pastikan session telah dimulai sebelum menggunakan $_SESSION

// Lakukan koneksi ke database di sini
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "freelance_Web";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Ambil ID notifikasi dari parameter GET
if (isset($_GET['id'])) {
    $notif_id = $_GET['id'];

    // Lakukan pembaruan status notifikasi dengan prepared statement untuk menghindari SQL Injection
    $sql = "UPDATE notifications SET is_read = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $notif_id); // "i" menandakan tipe data integer

    if ($stmt->execute()) {
        // Ambil data notifikasi untuk mengecek notification_type
        $select_sql = "SELECT notification_type FROM notifications WHERE id = ?";
        $select_stmt = $conn->prepare($select_sql);
        $select_stmt->bind_param("i", $notif_id);
        $select_stmt->execute();
        $result = $select_stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $notification_type = $row['notification_type'];

            // Periksa notification_type, jika "order berhasil", redirect ke riwayat_order.php
            // if ($notification_type === "Order Berhasil" || $notification_type === "Pesanan Selesai") {
            //     echo "<script>window.location.replace('freelance_order.php');</script>";
            // } else {
            //     // Jika tidak, redirect ke halaman notifikasi
            //     $user_id = $_SESSION['user_id'];
            //     echo "<script>window.location.replace('freelancer_notifications.php?id_user=$user_id');</script>";
            // }
                 $user_id = $_SESSION['user_id'];
                 echo "<script>window.location.replace('freelance_order.php');</script>";
        } else {
            echo "Data notifikasi tidak ditemukan";
        }

        $select_stmt->close();
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "ID notifikasi tidak ditemukan";
}

$conn->close();
?>