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
    </head>
    <body>
        <h2>Edit Order</h2>
        <form action="update_order.php" method="post">
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
        </form>
    </body>
    </html>
<?php
} else {
    echo "Order not found.";
}

$conn->close();
?>
