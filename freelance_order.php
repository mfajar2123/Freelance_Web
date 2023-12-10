<?php
session_start();
include 'config.php';

if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Ambil informasi dari tabel order_table, users, dan pekerjaan
    $query = "SELECT order_table.id_order, order_table.created_at, order_table.status, 
                     pekerjaan.freelancer_id AS nama_pekerjaan, order_table.deskripsi_order, order_table.file
              FROM order_table 
              INNER JOIN pekerjaan ON order_table.id_pekerjaan = pekerjaan.id_pekerjaan
              INNER JOIN users ON pekerjaan.freelancer_id = users.id
              WHERE users.id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Memulai konten HTML
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Order</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your custom styles here -->
    <style>
    /* Add your custom styles here */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    .order-container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .order-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .order-header h2 {
        font-size: 24px;
        font-weight: bold;
    }

    .order-header span {
        font-size: 18px;
        color: #777;
    }

    .order-item {
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #eee;
        border-radius: 8px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    }

    .order-item h4 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .order-item p {
        font-size: 16px;
        color: #333;
        margin-bottom: 5px;
    }

    .order-details {
        font-size: 16px;
        color: #333;
    }

    .order-details-btn {
        text-align: right;
    }

    .btn-details {
        padding: 5px 15px;
        font-size: 14px;
        font-weight: bold;
        color: #fff;
        background-color: #1dbf73;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-details:hover {
        background-color: #149f5b;
    }

    .btn-primary {
        background-color: #01036f;
        border-color: #01036f;
    }

    .btn-primary:hover {
        background-color: #000;
        border-color: #000;
    }
    </style>
</head>

        <body>
            <div class="order-container">
                <div class="order-header">
                    <h2 class="text-center">List Order</h2>
                </div>

                <!-- Memulai loop untuk menampilkan data order -->
                <?php
                while ($row = $result->fetch_assoc()) {
                    $orderId = $row['id_order'];
                    $status = $row['status'];
                ?>
                <!-- Data Order -->
                <div class="order-item">
                <div class="row">
                    <div class="col-md-2">
                        <h4>Tanggal</h4>
                        <p><?= $row['created_at'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <h4>Nama Pekerjaan</h4>
                        <p><?= $row['nama_pekerjaan'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Deskripsi Pekerjaan</h4>
                                <p><?= $row['deskripsi_order'] ?></p>
                            </div>
                            <div class="col-md-12">
                                <h4>File</h4>
                                <p><?= $row['file'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4>Status</h4>
                        <p><?= $row['status'] ?></p>
                    </div>
                    <div class="col-md-3">
                        <h4>Action</h4>
                        <a href="order_detail_freelance.php?id=<?= $orderId ?>" class="btn btn-details">Details</a>
                    </div>
                </div>
                </div>
                <?php
                } // Tutup loop while
                ?>
            </div>
            <div class="text-center mt-2 mb-3">
                <a href="dashboardfreelance.php" class="btn btn-primary">Back to Dashboard</a>
            </div>
            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>
        <?php
    } else {
        echo "Tidak ada data yang ditemukan.";
    }

    $stmt->close();
} else {
    echo "User ID tidak ditemukan.";
}

$conn->close();
?>