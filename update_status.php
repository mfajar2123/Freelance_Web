<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Terima data dari formulir
    $status = $_POST['status'];
    $orderId = $_POST['order_id'];

    if ($status === 'Selesai') {
        $query = "UPDATE order_table SET status = '$status', file_finish = ";

        // Cek jika ada berkas yang diunggah
        if (isset($_FILES['file_input']) && $_FILES['file_input']['error'] === 0) {
            $uploadDir = 'assets/filefinish/';
            $fileName = basename($_FILES['file_input']['name']);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['file_input']['tmp_name'], $targetPath)) {
                $query .= "'$fileName'";
            } else {
                echo "Gagal mengunggah berkas.";
                exit();
            }
        } else {
            echo "Berkas tidak diunggah atau terjadi kesalahan.";
            exit();
        }

        $query .= " WHERE id_order = $orderId";

        if ($conn->query($query) === TRUE) {
            // Dapatkan user_id (klien_id) dari tabel order_table
            $getUserQuery = "SELECT klien_id FROM order_table WHERE id_order = $orderId";
            $result = $conn->query($getUserQuery);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $userId = $row['klien_id'];

                // Tambahkan notifikasi
                $notificationType = 'Pesanan Selesai';
                $message = 'Selamat!! Pesanan Anda Sudah Dikerjakan, Silahkan Cek :)';
                $insertQuery = "INSERT INTO notifications (user_id, notification_type, message, created_at, is_read) 
                                VALUES ($userId, '$notificationType', '$message', NOW(), 0)";

                if ($conn->query($insertQuery) === TRUE) {
                    header("Location: freelance_order.php");
                } else {
                    echo "Gagal menambahkan notifikasi.";
                }
            } else {
                echo "Gagal mendapatkan user_id.";
            }
        } else {
            echo "Gagal mengupdate status dan file.";
        }
    } else {
        // Tindakan jika status bukan "Selesai"
        echo "Status diupdate tanpa mengubah file.";
    }
} else {
    echo "Metode permintaan tidak valid.";
}

$conn->close();

?>