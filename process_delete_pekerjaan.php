<?php
// Pastikan ID pekerjaan disediakan melalui parameter GET
if (isset($_GET['id_pekerjaan'])) {
    $id_pekerjaan = $_GET['id_pekerjaan'];

    // Koneksi ke database
    include 'config.php';

    // Query untuk menghapus pekerjaan berdasarkan ID
    $delete_query = "DELETE FROM pekerjaan WHERE id_pekerjaan = $id_pekerjaan";

    if ($conn->query($delete_query) === TRUE) {
        // Redirect kembali ke halaman pekerjaan setelah penghapusan berhasil
        header("Location: dashboardfreelance.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();
} else {
    // Redirect jika ID pekerjaan tidak tersedia
    header("Location: dashboardfreelance.php");
    exit();
}
?>
