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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: orange;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
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
    <form method="post" action="">
        <!-- Dropdown menu for selecting freelancer -->
        <label for="freelancer_id">Nama Freelancer:</label>
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
        <br>
        <br>
        <label for="name">Jenis Pekerjaan:</label>
        <input type="text" name="jenis_pekerjaan" placeholder="Jenis Pekerjaan" required>
        <br>
        <label for="name">Deskripsi Pekerjaan:</label>
        <textarea name="deskripsi_order" placeholder="Deskripsi Pekerjaan" required></textarea>
        <br>
        <label for="name">Harga:</label>
        <input type="text" name="harga" placeholder="Harga" required>
        <br>
        <label for="name">No Handphone:</label>
        <input type="text" name="nohp" placeholder="No Handphone" required>

        <button type="submit" class="btn btn-success">Add Pekerjaan</button>
        <a class="btn btn-success" href="dashboardadmin.php">Back</a>
    </form>
</body>
</html>

