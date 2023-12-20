<?php
// Include your database configuration file here
include 'config.php';

// Check if the ID parameter is set in the URL
if (isset($_GET['id_pekerjaan'])) {
    // Get the job ID from the URL
    $id_pekerjaan = $_GET['id_pekerjaan'];

    // Perform the delete operation
    $deleteQuery = "DELETE FROM pekerjaan WHERE id_pekerjaan='$id_pekerjaan'";

    if ($conn->query($deleteQuery) === TRUE) {
        header("location:dashboardadmin.php");
    } else {
        echo "Error deleting job: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
