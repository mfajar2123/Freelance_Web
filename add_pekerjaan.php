<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    // Retrieve data from the form
    $freelancerId = $_POST['freelancer_id'];
    $jenisPekerjaan = $_POST['jenis_pekerjaan'];
    $deskripsiOrder = $_POST['deskripsi_order'];
    $harga = $_POST['harga'];
    $nohp = $_POST['nohp'];

    // Perform the INSERT query
    $query = "INSERT INTO pekerjaan (freelancer_id, jenis_pekerjaan, deskripsi_order, harga, nohp) 
              VALUES ('$freelancerId', '$jenisPekerjaan', '$deskripsiOrder', '$harga', '$nohp')";

    if ($conn->query($query) === TRUE) {
        // Job added successfully
        header("Location: dashboardadmin.php"); // Redirect to the job list page
        exit();
    } else {
        // Error adding job
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pekerjaan</title>
</head>
<body>
    <form method="post" action="">
        <!-- Dropdown menu for selecting freelancer -->
        <label for="freelancer_id">Freelancer:</label>
        <select name="freelancer_id" required>
            <?php
            // Include your database configuration file here
            include 'config.php';

            // Query to fetch freelancers from users table with role 'freelancer'
            $query = "SELECT id, name FROM users WHERE role = 'freelancer'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
            } else {
                echo "<option value='' disabled>No freelancers found</option>";
            }

            $conn->close();
            ?>
        </select>

        <!-- Add form fields for other job information -->
        <input type="text" name="jenis_pekerjaan" placeholder="Jenis Pekerjaan" required>
        <textarea name="deskripsi_order" placeholder="Deskripsi Order" required></textarea>
        <input type="text" name="harga" placeholder="Harga" required>
        <input type="text" name="nohp" placeholder="No Handphone" required>

        <button type="submit" class="btn btn-success">Add Pekerjaan</button>
    </form>
</body>
</html>

