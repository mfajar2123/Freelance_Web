<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .error-container {
        text-align: center;
        padding: 20px;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #ff6347;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        background-color: #3498db;
        color: #fff;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #2980b9;
    }
    </style>
</head>

<body>
    <div class="error-container">
        <h1>Unauthorized Access</h1>
        <p>Maaf, Anda tidak diizinkan untuk mengakses halaman ini.</p>
        <a href="javascript:history.go(-1)" class="btn">Kembali</a>
    </div>
</body>

</html>