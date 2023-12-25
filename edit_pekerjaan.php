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
            text-align: left;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
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
        <form action="updatepekerjaan.php" method="post">
        <h2>Edit Pekerjaan</h2>
        
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
            <button class="back-button" href="dashboardadmin.php">Back</button>
        </form>
    </body>
    </html>
<?php
} else {
    echo "Job not found.";
}

$conn->close();
?>
