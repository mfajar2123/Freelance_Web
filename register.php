<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <!-- Bootstrap CSS -->
  <link href="assets/img/logoo.png" rel="icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Poppins Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #23585C;
    }

    .form-container {
      max-width: 400px;
      margin: 0 auto;
      padding: 40px;
      background-color: #9AD9CE;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .form-container h2 {
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 30px;
      color: #23585C;
    }

    .form-container label {
      font-size: 18px;
    }

    .form-container input[type="text"],
    .form-container input[type="email"],
    .form-container input[type="password"] {
      font-size: 16px;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 100%;
    }

    .form-container .btn-register {
      font-size: 18px;
      padding: 12px 24px;
      border-radius: 30px;
      width: 100%;
      background-color: #23585C; /* Warna latar belakang tombol */
      color: #fff;
    }

    .form-container .form-text {
      font-size: 14px;
      text-align: center;
      margin-top: 15px;
    }

    .form-container .form-text a {
      color: rgba(1, 4, 136, 0.9);
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="form-container">
      <h2>Register</h2>
      <form action="process_registration.php" method="post">
        <div class="form-group">
          <label for="registerFullName">Username</label>
          <input type="text" class="form-control" id="registerFullName" name="username" placeholder="Enter username" required>
        </div>
        <div class="form-group">
          <label for="registerEmail">Email address</label>
          <input type="email" class="form-control" id="registerEmail" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
          <label for="registerPassword">Password</label>
          <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Password" required>
        </div>
        <label for="role">Role:</label><br>
        <select name="role" id="role">
          <option value="klien">Klien</option>
          <option value="freelancer">Freelancer</option>
        </select><br><br>
        <button type="submit" class="btn btn-register">Register</button>
        <p class="form-text">Already have an account? <a href="login.php">Login here</a></p>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
