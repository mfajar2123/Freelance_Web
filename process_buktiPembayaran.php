<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idOrder = $_POST['idOrder'];
    $metodePembayaran = $_POST['metodePembayaran']; 
    
    $targetDirectory = __DIR__.'/assets/img/pembayaran/';
    $targetFile = $targetDirectory . basename($_FILES["fileBuktiBayar"]["name"]);
    $uploadOk = 1;

    if (file_exists($targetFile)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    if ($_FILES["fileBuktiBayar"]["size"] > 15 * 1024 * 1024) {
        echo "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    $allowedExtensions = array("jpg", "pdf", "jpeg", "png", "gif");
    $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "Maaf, hanya file JPG, JPEG, pdf, PNG, dan GIF yang diizinkan.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Maaf, file tidak diunggah.";
        die;
    } else {
        if (move_uploaded_file($_FILES["fileBuktiBayar"]["tmp_name"], $targetFile)) {
            echo "File " . basename($_FILES["fileBuktiBayar"]["name"]) . " berhasil diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
            die;
        }
    }

    $file = $_FILES["fileBuktiBayar"]["name"];
$metodePembayaran = $_POST['metodePembayaran']; // Menangkap pilihan metode pembayaran dari form

$queryInsertPayment = "INSERT INTO pembayaran (id_order, metode_pembayaran, bukti_pembayaran) VALUES (?, ?, ?)";
$stmt = $conn->prepare($queryInsertPayment);
$stmt->bind_param("sss", $idOrder, $metodePembayaran, $file); 
    if ($stmt->execute()) {
        $queryUpdateOrderStatus = "UPDATE order_table SET status = 'Dalam Pengerjaan' WHERE id_order = ?";
        $stmtUpdateOrderStatus = $conn->prepare($queryUpdateOrderStatus);
        $stmtUpdateOrderStatus->bind_param("i", $idOrder);

        if ($stmtUpdateOrderStatus->execute()) {
            $stmtUpdateOrderStatus->close();

            $queryGetJobId = "SELECT id_pekerjaan FROM order_table WHERE id_order = ?";
            $stmtGetJobId = $conn->prepare($queryGetJobId);
            $stmtGetJobId->bind_param("i", $idOrder);
            $stmtGetJobId->execute();
            $resultGetJobId = $stmtGetJobId->get_result();

            if ($resultGetJobId->num_rows > 0) {
                $row = $resultGetJobId->fetch_assoc();
                $idPekerjaan = $row['id_pekerjaan'];

                $queryGetFreelancerId = "SELECT freelancer_id FROM pekerjaan WHERE id_pekerjaan = ?";
                $stmtGetFreelancerId = $conn->prepare($queryGetFreelancerId);
                $stmtGetFreelancerId->bind_param("i", $idPekerjaan);
                $stmtGetFreelancerId->execute();
                $resultGetFreelancerId = $stmtGetFreelancerId->get_result();

                if ($resultGetFreelancerId->num_rows > 0) {
                    $rowFreelancer = $resultGetFreelancerId->fetch_assoc();
                    $freelancerId = $rowFreelancer['freelancer_id'];

                    $notificationTypeFreelancer = "Ada Order Baru nich";
                    $messageFreelancer = "Ada yang memesan jasa kamu, ayo cek!";

                    $queryInsertNotificationFreelancer = "INSERT INTO notifications (user_id, notification_type, message, created_at, is_read) VALUES (?, ?, ?, CURRENT_TIMESTAMP, 0)";
                    $stmtNotificationFreelancer = $conn->prepare($queryInsertNotificationFreelancer);
                    $stmtNotificationFreelancer->bind_param("iss", $freelancerId, $notificationTypeFreelancer, $messageFreelancer);

                    if ($stmtNotificationFreelancer->execute()) {
                        // Notifikasi kepada freelancer berhasil disimpan
                    } else {
                        // Gagal menyimpan notifikasi kepada freelancer
                        echo "Gagal menyimpan notifikasi kepada freelancer: " . $stmtNotificationFreelancer->error;
                    }

                    $stmtNotificationFreelancer->close();
                } else {
                    echo "Tidak ada data freelancer_id";
                }
            } else {
                echo "Tidak ada data id_pekerjaan";
            }

            $stmtGetJobId->close();
            $stmtGetFreelancerId->close();

            $user_id = $_SESSION['user_id'];
            $notification_type = "Order Selesai";
            $message = "Terima kasih sudah melakukan pembayaran.";

            $queryInsertNotification = "INSERT INTO notifications (user_id, notification_type, message, created_at, is_read) VALUES (?, ?, ?, CURRENT_TIMESTAMP, 0)";
            $stmtNotification = $conn->prepare($queryInsertNotification);
            $stmtNotification->bind_param("iss", $user_id, $notification_type, $message);

            if ($stmtNotification->execute()) {
                // Notifikasi status selesai berhasil disimpan
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