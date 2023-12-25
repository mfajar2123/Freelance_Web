<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Terima data dari formulir
    $status = $_POST['status'];
    $orderId = $_POST['order_id'];

    if ($status === 'Selesai') {
        $query = "UPDATE order_table SET status = ?, file_finish = ? WHERE id_order = ?";
        $stmt = $conn->prepare($query);
        
        // Cek jika ada berkas yang diunggah
        if (isset($_FILES['file_input']) && $_FILES['file_input']['error'] === 0) {
            $uploadDir = 'assets/filefinish/';
            $fileName = basename($_FILES['file_input']['name']);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['file_input']['tmp_name'], $targetPath)) {
                $stmt->bind_param("ssi", $status, $fileName, $orderId);
            } else {
                echo "Gagal mengunggah berkas.";
                exit();
            }
        } else {
            echo "Berkas tidak diunggah atau terjadi kesalahan.";
            exit();
        }

        $stmt->execute();

        // Periksa apakah update berhasil
        if ($stmt->affected_rows > 0) {
            // Dapatkan user_id (klien_id) dari tabel order_table
            $getUserQuery = "SELECT klien_id FROM order_table WHERE id_order = ?";
            $getUserStmt = $conn->prepare($getUserQuery);
            $getUserStmt->bind_param("i", $orderId);
            $getUserStmt->execute();
            $result = $getUserStmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $userId = $row['klien_id'];

                // Tambahkan notifikasi
                $notificationType = 'Pesanan Selesai';
                $message = 'Selamat!! Pesanan Anda Sudah Dikerjakan, Silahkan Cek :)';
                $insertQuery = "INSERT INTO notifications (user_id, notification_type, message, created_at, is_read) 
                                VALUES (?, ?, ?, NOW(), 0)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->bind_param("iss", $userId, $notificationType, $message);
                $insertStmt->execute();

                // Periksa apakah notifikasi berhasil ditambahkan
                if ($insertStmt->affected_rows > 0) {
                    header("Location: freelance_order.php");
                } else {
                    echo "Gagal menambahkan notifikasi.";
                }

                $insertStmt->close();
            } else {
                echo "Gagal mendapatkan user_id.";
            }

            $getUserStmt->close();
        } else {
            echo "Gagal mengupdate status dan file.";
        }

        $stmt->close();
    } else {
        // Tindakan jika status bukan "Selesai"
        echo "Status diupdate tanpa mengubah file.";
    }
} else {
    echo "Metode permintaan tidak valid.";
}

$conn->close();
?>