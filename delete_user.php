<?php
// Include your database configuration file here
include 'config.php';

// Check if ID parameter is present in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // SQL query to delete the user
    $sql = "DELETE FROM users WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result) {
        header("Location: dashboardadmin.php");
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "User ID not provided.";
}

// Close database connection
$conn->close();
?>
