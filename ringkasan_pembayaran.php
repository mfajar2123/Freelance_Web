<?php
session_start();
include 'config.php';

if(isset($_GET['id_order'])) {
    $idOrder = $_GET['id_order'];

    // Ambil informasi dari tabel order_table dan pekerjaan
    $query = "SELECT order_table.id_order, order_table.deskripsi_order, order_table.id_pekerjaan, pekerjaan.jenis_pekerjaan, pekerjaan.harga, users.name 
              FROM order_table 
              INNER JOIN pekerjaan ON order_table.id_pekerjaan = pekerjaan.id_pekerjaan 
              INNER JOIN users ON order_table.klien_id = users.id 
              WHERE order_table.id_order = {$idOrder}";
              $result = mysqli_query($conn, $query);
    
    
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
    } else {
        echo "Tidak ada data yang ditemukan.";
    }

   
} else {
    echo "ID Order tidak ditemukan.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Pembayaran</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your custom styles here -->
    <style>
    /* Add your custom styles here */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #23585C;
        color: #1E1E1E;
    }

    .payment-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .payment-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .payment-header h2 {
        font-size: 24px;
        font-weight: bold;
        color: #1E1E1E;
    }

    .payment-details {
        text-align: center;
        margin-bottom: 20px;
    }

    .payment-details p {
        color: #1E1E1E;
    }

    .payment-summary {
        margin-bottom: 30px;
    }

    .summary-heading {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #1E1E1E;
    }

    .summary-details {
        font-size: 16px;
        color: #333;
        margin-bottom: 20px;
    }

    .track-btn {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .btn-track {
        padding: 10px 30px;
        font-size: 18px;
        font-weight: bold;
        color: #fff;
        background-color: #23585C;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-track:hover {
        background-color: #419197;
    }
    </style>
</head>

<body>
    <div class="payment-container">
        <div class="payment-header">
            <h2 class="text-center"><?= $row['name'] ?></h2>
        </div>

        <div class="payment-details text-center">
            <p>Terima kasih atas pesanan Anda!</p>
        </div>

        <div class="payment-summary">
            <div class="summary-heading text-center">Ringkasan Pembayaran</div>
            <div class="summary-details">
                <!-- Isian ringkasan pembayaran -->
                <hr>

                <p class="text-start">Jenis Pekerjaan: <?= $row['jenis_pekerjaan'] ?></p>
                <p class="text-start">Deskripsi Order: <?= $row['deskripsi_order'] ?></p>
                <p class="text-start">Total Harga: <?= $row['harga'] ?></p>
                <!-- Isian ringkasan pembayaran (ganti dengan informasi yang sesuai) -->
            </div>
        </div>

        <div class="track-btn">
            <a href="riwayat_order.php" class="btn btn-track">Track Your Order</a>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>