<?php
// Include your database configuration file here
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $id_order = $_POST['id_order'];
    $deskripsi_order = $_POST['deskripsi_order'];
    $status = $_POST['status'];

    // Update the order in the database
    $updateQuery = "UPDATE order_table SET deskripsi_order='$deskripsi_order', status='$status' WHERE id_order='$id_order'";
    
    if ($conn->query($updateQuery) === TRUE) {
        header("location:dashboardadmin.php");
    } else {
        echo "Error updating order: " . $conn->error;
    }
}

$conn->close();
?>
