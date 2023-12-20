<?php
// Include your database configuration file here
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form
    $id_pekerjaan = $_POST['id_pekerjaan'];
    $jenis_pekerjaan = $_POST['jenis_pekerjaan'];
    $deskripsi_order = $_POST['deskripsi_order'];
    $harga = $_POST['harga'];
    $nohp = $_POST['nohp'];

    // Update the job details in the database
    $updateQuery = "UPDATE pekerjaan 
                    SET jenis_pekerjaan='$jenis_pekerjaan', 
                        deskripsi_order='$deskripsi_order', 
                        harga='$harga', 
                        nohp='$nohp' 
                    WHERE id_pekerjaan='$id_pekerjaan'";

    if ($conn->query($updateQuery) === TRUE) {
        header("Location: dashboardadmin.php");
    } else {
        echo "Error updating job: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
