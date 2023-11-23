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
  <style>
    body {
      background-color: #f8f9fa;
    }

    .form-container {
      max-width: 400px;
      margin: 0 auto;
      padding: 40px;
      background-color: #fff;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .form-container h2 {
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 30px;
      color: rgba(1, 4, 136, 0.9);
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
      background-color: rgba(1, 4, 136, 0.9);
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
  <!-- Navbar (copy the navbar code from the previous examples here) -->

  <!-- Register Form -->
  <div class="container mt-5">
    <div class="form-container">
      <h2>Register</h2>
      <form action="process_registration.php" method="post">
      <div class="form-group">
          <label for="registername">Name</label>
          <input type="text" class="form-control" id="registername" name="name" placeholder="Enter Name" required>
        </div>
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
        <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_freelancer" name="is_freelancer">
        <label class="form-check-label" for="is_freelancer">I am a freelancer</label>
      </div>
        <button type="submit" class="btn btn-register">Register</button>
        <p class="form-text">Already have an account? <a href="login.php">Login here</a></p>
      </form>
    </div>
  </div>

  <!-- Footer (copy the footer code from the previous examples here) -->

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
