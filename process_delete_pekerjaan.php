<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

if (isset($_GET['id_pekerjaan'])) {
    $id_pekerjaan = $_GET['id_pekerjaan'];

    try {
        // Mulai transaksi
        $conn->begin_transaction();

        // 1. Hapus data dari tabel pembayaran yang terkait
        $deletePembayaranQuery = "DELETE FROM pembayaran 
                                  WHERE id_order IN (SELECT id_order FROM order_table WHERE id_pekerjaan = $id_pekerjaan)";
        $conn->query($deletePembayaranQuery);

        // 2. Hapus data dari tabel order_table
        $deleteOrderQuery = "DELETE FROM order_table 
                             WHERE id_pekerjaan = $id_pekerjaan";
        $conn->query($deleteOrderQuery);

        // 3. Hapus data dari tabel pekerjaan
        $deletePekerjaanQuery = "DELETE FROM pekerjaan 
                                 WHERE id_pekerjaan = $id_pekerjaan";
        $conn->query($deletePekerjaanQuery);

        // Commit transaksi jika semua query berhasil
        $conn->commit();

        // Redirect ke dashboard atau halaman lainnya
        header("Location: dashboardfreelance.php");
        exit();
    } catch (mysqli_sql_exception $exception) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();
        
        // Handle error
        echo "Error deleting job: " . $exception->getMessage();
    }
} else {
    // Handle invalid request
    echo "Invalid request.";
}


$conn->close();
?>