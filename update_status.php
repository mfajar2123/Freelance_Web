<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Terima data dari formulir
    $status = $_POST['status'];
    $orderId = $_POST['order_id'];

    // Periksa status
    if ($status === 'Selesai') {
        // Periksa apakah ada berkas yang diunggah
        if (isset($_FILES['file_input']) && $_FILES['file_input']['error'] === 0) {
            // Direktori tempat menyimpan berkas
            $uploadDir = 'assets/filefinish/';

            // Nama berkas
            $fileName = basename($_FILES['file_input']['name']);
            $targetPath = $uploadDir . $fileName;

            // Pindahkan berkas ke direktori tujuan
            if (move_uploaded_file($_FILES['file_input']['tmp_name'], $targetPath)) {
                // Update database dengan nama berkas
                $query = "UPDATE order_table SET status = ?, file_finish = ? WHERE id_order = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssi", $status, $fileName, $orderId);
                $stmt->execute();

                // Periksa apakah update berhasil
                if ($stmt->affected_rows > 0) {
                    header("Location: freelance_order.php");
                } else {
                    echo "Gagal mengupdate status dan file.";
                }

                $stmt->close();
            } else {
                echo "Gagal mengupload berkas.";
            }
        } else {
            echo "Berkas tidak diunggah atau terjadi kesalahan.";
        }
    } else {
        // Jika status bukan "Selesai", lakukan pemrosesan lain sesuai kebutuhan
        // ...

        echo "Status diupdate tanpa mengubah file.";
    }
} else {
    echo "Metode permintaan tidak valid.";
}

$conn->close();
?>
