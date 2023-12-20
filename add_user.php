<?php
// Include your database configuration file here
include 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $education = $_POST['education'];
    $country = $_POST['country'];
    $role = $_POST['role'];

    // Add more validations as needed

    // SQL query to insert new user
    $sql = "INSERT INTO users (name, username, password, email, no_hp, education, country, role) VALUES ('$name', '$username','$password', '$email', '$no_hp', '$education', '$country', '$role')";
    $result = $conn->query($sql);

    if ($result) {
        header("Location: dashboardadmin.php");
    } else {
        echo "Error adding user: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action="">
    <!-- Add form fields for user information (name, username, email, etc.) -->
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="username" placeholder="Name" required>
    <input type="password" name="password" placeholder="Name" required>
    <input type="text" name="email" placeholder="Name" required>
    <input type="text" name="no_hp" placeholder="Name" required>
    <input type="text" name="education" placeholder="Name" required>
    <input type="text" name="country" placeholder="Name" required>
    <input type="text" name="role" placeholder="Name" required>
    <label for="role">Role:</label>
    <select name="role" id="role" required>
        <option value="klien">Klien</option>
        <option value="freelancer">Freelancer</option>
    </select>
    <!-- Add more fields as needed -->

    <!-- Add a submit button -->
    <button type="submit" class="btn btn-success">Add User</button>
</form>

</body>
</html>