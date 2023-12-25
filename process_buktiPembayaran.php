<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idOrder = $_POST['idOrder'];
    
$targetDirectory = __DIR__.'/assets/img/pembayaran/'; // Folder tujuan untuk menyimpan file
$targetFile = $targetDirectory . basename($_FILES["fileBuktiBayar"]["name"]); // Path lengkap file yang akan diunggah
$uploadOk = 1; // Flag untuk menandai apakah pengunggahan berhasil atau gagal

// Cek apakah file sudah ada
if (file_exists($targetFile)) {
    echo "Maaf, file sudah ada.";
    $uploadOk = 0;
}

// Batasi ukuran file (contoh diset maksimal 5MB)
if ($_FILES["fileBuktiBayar"]["size"] > 15 * 1024 * 1024) {
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

// Periksa apakah uploadOk masih bernilai 0
if ($uploadOk == 0) {
    echo "Maaf, file tidak diunggah.";
    die;
} else { // Jika semua syarat terpenuhi, coba unggah file
    if (move_uploaded_file($_FILES["fileBuktiBayar"]["tmp_name"], $targetFile)) {
        echo "File " . basename($_FILES["fileBuktiBayar"]["name"]) . " berhasil diunggah.";
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file.";
        die;
    }

}

$file=$_FILES["fileBuktiBayar"]["name"];
        
    // Insert pembayaran dengan parameterisasi untuk menghindari SQL injection
    $queryInsertPayment = "INSERT INTO pembayaran (id_order, bukti_pembayaran) VALUES (?, ?)";
    $stmt = $conn->prepare($queryInsertPayment);
    $stmt->bind_param("is", $idOrder, $file);

    if ($stmt->execute()) {
        // Jika pembayaran berhasil disimpan, perbarui status order
        $queryUpdateOrderStatus = "UPDATE order_table SET status = 'Dalam Pengerjaan' WHERE id_order = ?";
        $stmtUpdateOrderStatus = $conn->prepare($queryUpdateOrderStatus);
        $stmtUpdateOrderStatus->bind_param("i", $idOrder);

        if ($stmtUpdateOrderStatus->execute()) {
            // Jika status order diperbarui, pindahkan ke halaman ringkasan pembayaran
            $stmtUpdateOrderStatus->close();
            

            // Redirect ke halaman ringkasan pembayaran dengan id_order yang sesuai
              // Mendefinisikan variabel untuk notifikasi status selesai
                $user_id = $_SESSION['user_id'];
                $notification_type = "Order Selesai";
                $message = "Terima kasih sudah melakukan pembayaran.";

                // Menyimpan notifikasi status selesai ke dalam tabel notifications
                $queryInsertNotification = "INSERT INTO notifications (user_id, notification_type, message, created_at, is_read) VALUES (?, ?, ?, CURRENT_TIMESTAMP, 0)";
                $stmtNotification = $conn->prepare($queryInsertNotification);
                $stmtNotification->bind_param("iss", $user_id, $notification_type, $message);

                if ($stmtNotification->execute()) {
                    // Notifikasi status selesai berhasil disimpan ke dalam tabel notifications
                } else {
                    // Gagal menyimpan notifikasi status selesai
                    echo "Gagal menyimpan notifikasi status selesai: " . $stmtNotification->error;
                }

                $stmtNotification->close();
            header("Location: ringkasan_pembayaran.php?id_order=$idOrder");
            exit();
        } else {
            echo "Error: Gagal memperbarui status order - " . $conn->error;
        }
    } else {
        echo "Error: Gagal menyimpan pembayaran - " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>