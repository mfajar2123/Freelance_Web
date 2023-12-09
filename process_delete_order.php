<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    // Lakukan koneksi ke basis data
    // Lakukan validasi atau sanitasi data jika diperlukan

    // Ambil id pekerjaan terkait order yang akan dihapus
    $queryGetPekerjaan = "SELECT id_pekerjaan FROM order_table WHERE id_order = ?";
    $stmtGetPekerjaan = $conn->prepare($queryGetPekerjaan);
    $stmtGetPekerjaan->bind_param("i", $orderId);
    $stmtGetPekerjaan->execute();
    $resultGetPekerjaan = $stmtGetPekerjaan->get_result();

    if ($resultGetPekerjaan->num_rows > 0) {
        $row = $resultGetPekerjaan->fetch_assoc();
        $idPekerjaan = $row['id_pekerjaan'];

        // Hapus pesanan dengan order_id yang diberikan
        $queryDeleteOrder = "DELETE FROM order_table WHERE id_order = ?";
        $stmtDeleteOrder = $conn->prepare($queryDeleteOrder);
        $stmtDeleteOrder->bind_param("i", $orderId);

        if ($stmtDeleteOrder->execute()) {
            // Jika penghapusan berhasil, ubah status_pekerjaan menjadi 'belum dipesan'
            $queryUpdateStatus = "UPDATE pekerjaan SET status_pekerjaan = 'belum dipesan' WHERE id_pekerjaan = ?";
            $stmtUpdateStatus = $conn->prepare($queryUpdateStatus);
            $stmtUpdateStatus->bind_param("i", $idPekerjaan);
            
            if ($stmtUpdateStatus->execute()) {
                // Kembali ke halaman riwayat_order.php
                header("Location: riwayat_order.php");
                exit();
            } else {
                echo "Gagal mengubah status pekerjaan.";
                exit();
            }
        } else {
            echo "Gagal menghapus pesanan.";
            exit();
        }
    } else {
        echo "Order tidak ditemukan.";
        exit();
    }

    $stmtGetPekerjaan->close();
    $stmtDeleteOrder->close();
    $stmtUpdateStatus->close();
    $conn->close();
} else {
    // Redirect jika data yang diberikan tidak lengkap atau tidak valid
    header("Location: riwayat_order.php");
    exit();
}
?>