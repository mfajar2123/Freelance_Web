<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}

// Gunakan $_SESSION['user_id'] untuk mendapatkan ID pengguna yang login
$user_id = $_SESSION['user_id'];


// Sekarang Anda dapat menggunakan $user_id pada form tambah pekerjaan
// ...
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <!-- Bootstrap CSS -->
  <link href="assets/img/logoo.png" rel="icon">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .container {
      width: 75vw;
    }

    .form-container {
      /* max-width: 400px; */
      width: 700px;
      margin: 0 auto;
      padding: 40px;
      background-color: #fff;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .form-container h2 {
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 20px;
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
      margin-bottom: 10px;
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
  <div class="container mt-3">
    <div class="form-container">
      <h2>Tambah Pekerjaan</h2>
      <form action="process_tambahpekerjaan.php" method="post" enctype="multipart/form-data">
          <div class="d-flex justify-content-between">
            <div style="width: 45%;">
              <div class="form-group">
                  <label for="nohp">No Handphone</label>
                  <input type="text" class="form-control" id="nohp" name="nohp" placeholder="No Handphone" required>
              </div>
              <div class="form-group">
                  <label for="jenispekerjaan">Jenis Pekerjaan</label>
                  <input type="text" class="form-control" id="jenispekerjaan" name="jenispekerjaan" placeholder="Jenis Pekerjaan" required>
              </div>
              <div class="form-group">
                  <label for="deskripsi">Deskripsi</label>
                  <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi" required>
              </div>
              <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga" required>
              </div>
              <div class="form-group">
                  <label for="skills">Skills</label>
                  <input type="text" class="form-control" id="skills" name="skills" placeholder="Skills" required>
              </div>
            </div>

            <div class="d-flex flex-column align-items-center p-3 rounded" style="background-color: #bbb5ff; height: 50%; width: 45%">
              <label for="foto" id="drop-area" style="cursor: pointer; height: 175px; width: 100%; ">
                <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*" hidden required>
                <div id="img-view" class="d-flex flex-column align-items-center p-3 rounded" style="border: 2px dashed #f7f8ff; height: 100%; background-position: center; background-size: cover">
                  <i class='bx bx-image-add' style="font-size: 75px;"></i>
                  <h4 style="font-size: 16px; text-align: center">Seret atau klik disini untuk unggah gambar</h4>
                  <p style="font-size: 11px;">Gunakan format <b>JPG, JPEG, PNG</b></p>
                </div>
              </label>

              <!-- <div class="form-group">
                  <label for="foto">Foto Produk</label>
                  <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*" required>
                  <small class="form-text text-muted">Pilih file gambar (format: JPG, JPEG, PNG).</small>
              </div> -->
            </div>
            <input type="hidden" id="user_id" name="freelancer_id" value="<?= $user_id ?>">
          </div>

          <div class="d-flex justify-content-end">
            <a href="dashboardfreelance.php" class="btn btn-warning mr-3">Kembali</a>
            <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" name="daftar">Tambah</button>
          </div>
        
    </form>

    </div>
  </div>

  <!-- Footer (copy the footer code from the previous examples here) -->

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="./assets/js/tampil_uploadFile.js"></script>
</body>

</html>
