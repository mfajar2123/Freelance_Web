<?php
session_start();
include 'config.php';

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Query untuk mendapatkan detail order berdasarkan id_order
    $query = "SELECT * FROM order_table WHERE id_order = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $orderDetail = $result->fetch_assoc();
        // Memulai konten HTML
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detail Order</title>
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

            <!-- Your custom styles here -->
            <!-- Tambahkan CSS kustom jika diperlukan -->
        </head>

        <body>
            <div class="container mt-5">
                <h2 class="mb-4">Detail Order</h2>
                <div class="row">
                    <div class="col-md-6">
                        <h4>ID Order: <?= $orderDetail['id_order'] ?></h4>
                        <h4>Klien ID: <?= $orderDetail['klien_id'] ?></h4>
                        <h4>ID Pekerjaan: <?= $orderDetail['id_pekerjaan'] ?></h4>
                        <h4>Deskripsi Order: <?= $orderDetail['deskripsi_order'] ?></h4>
                        <h4>File: <?= $orderDetail['file'] ?></h4>
                        <h4>Status: <?= $orderDetail['status'] ?></h4>
                        <h4>File Finish: <?= $orderDetail['file_finish'] ?></h4>
                        <!-- Tambahkan informasi lain sesuai kebutuhan -->
                    </div>
                <div class="mt-3">
                    <a href="freelance_order.php" class="btn btn-primary">Back to List Order</a>
                </div>
            </div>
            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>
        <?php
    } else {
        echo "Order tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID Order tidak valid.";
}
?>