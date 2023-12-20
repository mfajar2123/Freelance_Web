<?php
// Include your database configuration file here
include 'config.php';

// Get the job ID from the URL
$id_pekerjaan = $_GET['id_pekerjaan'] ?? '';

// Fetch job details from the database
$query = "SELECT pekerjaan.*, users.name AS freelancer_name 
          FROM pekerjaan 
          INNER JOIN users ON pekerjaan.freelancer_id = users.id 
          WHERE pekerjaan.id_pekerjaan='$id_pekerjaan'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Job</title>
    </head>
    <body>
        <h2>Edit Job</h2>
        <form action="updatepekerjaan.php" method="post">
            <input type="hidden" name="id_pekerjaan" value="<?php echo $row['id_pekerjaan']; ?>">

            <!-- Display Freelancer Name -->
            <p>Freelancer Name: <?php echo $row['freelancer_name']; ?></p>

            <!-- Add your form fields here -->

            <label for="jenis_pekerjaan">Jenis Pekerjaan:</label>
            <input type="text" name="jenis_pekerjaan" value="<?php echo $row['jenis_pekerjaan']; ?>" required>

            <label for="deskripsi_order">Deskripsi Order:</label>
            <textarea name="deskripsi_order" required><?php echo $row['deskripsi_order']; ?></textarea>

            <label for="harga">Harga:</label>
            <input type="text" name="harga" value="<?php echo $row['harga']; ?>" required>

            <label for="nohp">No Handphone:</label>
            <input type="text" name="nohp" value="<?php echo $row['nohp']; ?>" required>

            <button type="submit">Update Job</button>
        </form>
    </body>
    </html>
<?php
} else {
    echo "Job not found.";
}

$conn->close();
?>
