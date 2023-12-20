<?php
// Include your database configuration file here
include 'config.php';

// Get the order ID from the URL
$id_order = $_GET['id_order'] ?? '';

// Delete related rows from the child table (pembayaran)
$deleteChildQuery = "DELETE FROM pembayaran WHERE id_order='$id_order'";

if ($conn->query($deleteChildQuery) === TRUE) {
    // Now you can safely delete from the parent table (order_table)
    $deleteParentQuery = "DELETE FROM order_table WHERE id_order='$id_order'";
    
    if ($conn->query($deleteParentQuery) === TRUE) {
        header("location:dashboardadmin.php");
    } else {
        echo "Error deleting order: " . $conn->error;
    }
} else {
    echo "Error deleting related payment records: " . $conn->error;
}

$conn->close();
?>
