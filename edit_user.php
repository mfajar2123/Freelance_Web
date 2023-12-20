<?php
include 'config.php';

// Periksa apakah parameter ID pengguna ada dalam URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Ambil data pengguna berdasarkan ID
    $query = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();

        // Proses formulir pengeditan
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data yang diubah dari formulir
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $noHp = $_POST['no_hp'];
            $education = $_POST['education'];
            $country = $_POST['country'];

            // Update data pengguna di database
            $updateQuery = "UPDATE users SET 
                name = '$name',
                username = '$username',
                email = '$email',
                no_hp = '$noHp',
                education = '$education',
                country = '$country'
                WHERE id = $userId";

            if ($conn->query($updateQuery) === TRUE) {
                // Redirect kembali ke halaman dashboard setelah update
                header("Location: dashboardadmin.php");
                exit();
            } else {
                // Tampilkan pesan kesalahan jika update gagal
                echo "Error updating user: " . $conn->error;
            }
        }

        // Tampilkan formulir pengeditan
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit User</title>
        </head>
        <body>
            <h2>Edit User</h2>
            <form method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $userData['name']; ?>" required>
                <br>
                <label for="username">Username:</label>
                <input type="text" name="username" value="<?php echo $userData['username']; ?>" required>
                <br>
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $userData['email']; ?>" required>
                <br>
                <label for="no_hp">No Handphone:</label>
                <input type="text" name="no_hp" value="<?php echo $userData['no_hp']; ?>" required>
                <br>
                <label for="education">Education:</label>
                <input type="text" name="education" value="<?php echo $userData['education']; ?>" required>
                <br>
                <label for="country">Country:</label>
                <input type="text" name="country" value="<?php echo $userData['country']; ?>" required>
                <br>
                <button type="submit">Update</button>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "User not found.";
    }
} else {
    echo "User ID not specified.";
}

$conn->close();
?>
