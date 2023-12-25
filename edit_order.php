<?php
// Include your database configuration file here
include 'config.php';

// Get the order ID from the URL
$id_order = $_GET['id_order'] ?? '';

// Fetch order details from the database
$query = "SELECT order_table.*, users.name AS klien_name 
          FROM order_table 
          INNER JOIN users ON order_table.klien_id = users.id 
          WHERE order_table.id_order='$id_order'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Order</title>

        <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: left;
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        p {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        select {
            appearance: none;
            padding: 10px;
            background-color: #f1f3f5;
            border: 1px solid #ced4da;
            border-radius: 4px;
            color: #495057;
            cursor: pointer;
        }

        button {
            background-color: #28a745;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .back-button {
            background-color: #3498db;
        }

        .back-button:hover {
            background-color: #2980b9;
        }
    </style>
    </head>
    <body>
        
        <form action="update_order.php" method="post">
        <h2>Edit Order</h2>
            <input type="hidden" name="id_order" value="<?php echo $row['id_order']; ?>">

            <!-- Display Klien Name -->
            <p>Klien Name: <?php echo $row['klien_name']; ?></p>

            <!-- Add your form fields here -->
            <label for="deskripsi_order">Deskripsi Order:</label>
            <textarea name="deskripsi_order" required><?php echo $row['deskripsi_order']; ?></textarea>

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="Menunggu Pembayaran" <?php echo ($row['status'] == 'Menunggu Pembayaran') ? 'selected' : ''; ?>>Menunggu Pembayaran</option>
                <option value="Dalam Pengerjaan" <?php echo ($row['status'] == 'Dalam Pengerjaan') ? 'selected' : ''; ?>>Dalam Pengerjaan</option>
                <option value="Selesai" <?php echo ($row['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                <option value="Gagal" <?php echo ($row['status'] == 'Gagal') ? 'selected' : ''; ?>>Gagal</option>
            </select>

            <button type="submit">Update Order</button>
            <button class="back-button" href="dashboardadmin.php">Back</button>
        </form>
    </body>
    </html>
<?php
} else {
    echo "Order not found.";
}

$conn->close();
?>
