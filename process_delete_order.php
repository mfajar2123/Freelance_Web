<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    // Lakukan koneksi ke basis data
    // Lakukan validasi atau sanitasi data jika diperlukan

    // Ambil id pekerjaan terkait order yang akan dihapus
    $queryGetPekerjaan = "SELECT id_pekerjaan FROM order_table WHERE id_order = {$orderId}";
    $resultGetPekerjaan = mysqli_query($conn, $queryGetPekerjaan);

    if ($resultGetPekerjaan->num_rows > 0) {
        $row = $resultGetPekerjaan->fetch_assoc();
        $idPekerjaan = $row['id_pekerjaan'];

        // Hapus pesanan dengan order_id yang diberikan
        $queryDeleteOrder = "DELETE FROM order_table WHERE id_order = {$orderId}";
        

        if ($stmtDeleteOrder=mysqli_query($conn, $queryDeleteOrder)) {
            // Jika penghapusan berhasil, ubah status_pekerjaan menjadi 'belum dipesan'
            $queryUpdateStatus = "UPDATE pekerjaan SET status_pekerjaan = 'belum dipesan' WHERE id_pekerjaan = {$idPekerjaan}";
            
            
            if ($stmtUpdateStatus=mysqli_query($conn, $queryUpdateStatus)) {
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

    
    $conn->close();
} else {
    // Redirect jika data yang diberikan tidak lengkap atau tidak valid
    header("Location: riwayat_order.php");
    exit();
}
?>