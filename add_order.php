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
    <h3>Add User</h3>
    <!-- Add form fields for user information (name, username, email, etc.) -->
    <label for="name">Name:</label>
    <input type="text" name="name" placeholder="Name" required>
    <br>
    <label for="name">Username:</label>
    <input type="text" name="username" placeholder="Userame" required>
    <br>
    <label for="name">Password:</label>
    <input type="password" name="password" placeholder="Password" required>
    <br>
    <label for="name">Email:</label>
    <input type="text" name="email" placeholder="Email" required>
    <br>
    <label for="name">No Handphone:</label>
    <input type="text" name="no_hp" placeholder="No Handphone" required>
    <br>
    <label for="name">Education:</label>
    <input type="text" name="education" placeholder="Education" required>
    <br>
    <label for="name">Country:</label>
    <input type="text" name="country" placeholder="Country" required>
    <br>
    <label for="role">Role:</label>
    <select name="role" id="role" required>
        <option value="klien">Klien</option>
        <option value="freelancer">Freelancer</option>
    </select>
    <!-- Add more fields as needed -->

    <!-- Add a submit button -->
    <button type="submit" class="btn btn-success">Add User</button>
    <a class="btn btn-success" href="dashboardadmin.php">Back</a>
    
</form>
</body>
</html>