<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link href="assets/img/logoo.png" rel="icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
  <style>
    body {
      background-color: #23585C;
      font-family: 'Poppins', sans-serif;
    }

    .form-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 40px;
      background-color: #9AD9CE;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      display: flex;
    }

    .left-box {
      flex: 1;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px; /* Sesuaikan dengan nilai yang diinginkan */
      color: #fff;
    }

    .left-box img {
      width: 100%;
      max-width: 300px;
      height: auto;
    }

    .right-box {
      flex: 1;
      padding: 20px;
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

    .form-container .btn-login {
      font-size: 18px;
      padding: 12px 24px;
      border-radius: 30px;
      width: 100%;
      background-color: #23585C; /* Ganti dengan warna tombol yang diinginkan */
      color: #fff;
    }

    .form-container .form-text {
      font-size: 14px;
      text-align: center;
      margin-top: 15px;
      font-family: 'Poppins', sans-serif; /* Ganti dengan font Poppins */
    }

    .form-container .form-text a {
      color: rgba(1, 4, 136, 0.9);
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="form-container">
      <div class="left-box">
        <img src="assets/img/login (1).png" alt="Logo" class="img-fluid">
      </div>

      <div class="right-box">
        <h2>Login</h2>
        <form action="process_login.php" method="post">
          <div class="form-group">
            <label for="loginUsername">Username</label>
            <input type="" class="form-control" id="loginUsername" name="username" placeholder="Enter Username" required>
          </div>
          <div class="form-group">
            <label for="loginPassword">Password</label>
            <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password"
              required>
          </div>
          <button type="submit" class="btn btn-login">Login</button>
          <p class="form-text">Don't have an account? <a href="register.php">Register here</a></p>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
