<?php
session_start();
include 'config.php';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Ambil informasi dari tabel order_table, users, dan pekerjaan
    $query = "SELECT order_table.id_order, order_table.created_at, order_table.status, 
                 pekerjaan.jenis_pekerjaan AS nama_pekerjaan, order_table.deskripsi_order, order_table.file
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
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
            <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        color: #ffffff;
    }

    .order-container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #23585C;
        border-radius: 20px;
        box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.2);
    }

    .order-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
        color: #ffffff;
    }

    .order-header h2 {
        font-size: 24px;
        font-weight: bold;
    }

    .order-header span {
        font-size: 18px;
        color: #9AD9CE;
    }

    .card {
        font-family: 'Poppins', sans-serif;
        color: #1E1E1E;
        margin-bottom: 20px;
        position: relative;
        background-color: #9AD9CE;
    }

    .card-header {
        padding: 10px;
        color: #1E1E1E;
        position: relative;
    }

    .card-header h5 {
        margin-bottom: 5px;
        font-size: 20px;
        font-weight: medium;
    }

    .card-header p {
        position: absolute;
        bottom: -15px;
        left: 38px;
        color: #1E1E1E;
        font-size: 12px; 
    }

    .card-header .badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #419197 !important;
    }

    .card-body {
        padding: 15px;
    }

    .btn-details {
        padding: 5px 15px;
        font-size: 12px;
        font-weight: bold;
        color: #fff;
        background-color: #23585C;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-details:hover {
        background-color: #9AD9CE;
    }

    .btn-primary {
        background-color: blue;
        border-color: #23585C;
    }

    .btn-primary:hover {
        background-color: white;
        border-color: #000;
        color: blue;
    }
</style>

        </head>
        <body>
        <!-- <body style="background-color: #23585C;">> -->
            
            <div class="order-container" >
                <div class="order-header">
                    <h2 class="text-center">List Order</h2>
                </div>
                <div class="text-center mt-2 mb-3">
                    <a href="dashboardfreelance.php" class="btn btn-primary">Back to Dashboard</a>
                </div>

                <!-- Memulai loop untuk menampilkan data order -->
                <?php
                while ($row = $result->fetch_assoc()) {
                    $orderId = $row['id_order'];
                    $status = $row['status'];
                ?>
                    <!-- Data Order -->
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                <i class="bi bi-clipboard-check-fill"></i> Order
                            </h5>
                            <p><?= $row['created_at'] ?></p>
                            <span class="badge text-bg-primary" style="position: absolute; top:20px; right: 10px;">
                                <?= $row['status'] ?>
                            </span>
                        </div>

                        <div class="row">
                            <!-- Di dalam loop while -->
                            <div class="col-md-4">
                                <p>
                                <a href="./assets/img/<?= $row['file'] ?>" download="<?= $row['file'] ?>"><?= $row['file'] ?></a>
                                </p>
                            </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>Nama pekerjaan:</h5>
                                            <p><?= $row['nama_pekerjaan'] ?></p>
                                        </div>
                                        <div class="col-md-12">
                                            <h5>Deskripsi:</h5>
                                            <p><?= $row['deskripsi_order'] ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-1" style="position: absolute; bottom: 5px; right: 35px;">
                                    <a href="order_detail_freelance.php?id=<?= $orderId ?>" class="btn" style="background-color: #23585C; color: #fff;">Details</a>
                                </div>
                            </div>
                        </div>


                <?php
                } // Tutup loop while
                ?>
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
