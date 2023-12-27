<?php
include 'config.php';

// Ambil ID pengguna yang akan dihapus dari parameter URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    try {
        // Matikan autocommit agar dapat melakukan transaksi
        $conn->autocommit(FALSE);

        // Hapus notifikasi terkait dengan pengguna
        $deleteNotificationsQuery = "DELETE FROM notifications WHERE user_id = $userId";
        $conn->query($deleteNotificationsQuery);

        // Hapus pesanan yang dibuat oleh pengguna (sesuai catatan terakhir, ID order diambil dari tabel order_table)
        $selectOrdersQuery = "SELECT id_order FROM order_table WHERE klien_id = $userId";
        $result = $conn->query($selectOrdersQuery);

        while ($row = $result->fetch_assoc()) {
            $orderId = $row['id_order'];

            // Hapus pembayaran terkait dengan pesanan
            $deletePaymentsQuery = "DELETE FROM pembayaran WHERE id_order = $orderId";
            $conn->query($deletePaymentsQuery);
        }

        // Hapus pesanan yang dibuat oleh pengguna
        $deleteOrdersQuery = "DELETE FROM order_table WHERE klien_id = $userId";
        $conn->query($deleteOrdersQuery);

        // Hapus pengguna
        $deleteUserQuery = "DELETE FROM users WHERE id = $userId";
        $conn->query($deleteUserQuery);

        // Commit transaksi
        $conn->commit();

        // Redirect ke halaman pengguna setelah penghapusan
        header("Location: dashboardadmin.php");
        exit();
    } catch (Exception $e) {
        // Rollback jika terjadi kesalahan
        $conn->rollback();

        // Tampilkan pesan kesalahan
        echo "Error: " . $e->getMessage();
    } finally {
        // Hidupkan kembali autocommit
        $conn->autocommit(TRUE);
    }
} else {
    // Redirect ke halaman pengguna jika ID pengguna tidak ditemukan
    header("Location: dashboardadmin.php");
    exit();
}

$conn->close();
?>
