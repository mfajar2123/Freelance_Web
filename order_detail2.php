<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

$pekerjaan_id=$_GET['pekerjaan_id'];

// Query untuk mengambil data pekerjaan dari tabel pekerjaan
$sql = "SELECT pekerjaan.*, users.name, users.no_hp, users.foto_profil  FROM pekerjaan JOIN users on pekerjaan.freelancer_id=users.id WHERE id_pekerjaan=$pekerjaan_id";
$result = $conn->query($sql);

// Buat array untuk menyimpan data pekerjaan
$pekerjaan = [];
$conn->close();

// Tampilkan data pekerjaan sebagai array JSON
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pekerjaan[] = $row;
    }
      // Mengirim data dalam bentuk JSON
} else {
    echo "tidak ditemukan";
    die;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail - <?php echo $pekerjaan[0]['name']?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="./assets/css/order_detail2.css">
    <link rel="stylesheet" href="./assets/css/dashboard.css">


</head>

<body>
    <!-- Navbar -->
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Your Brand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">TalentaHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">Explore</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="assets/img/menu.png" alt="" width="32" height="32" class="rounded-circle">
                            <!-- <span class="badge">1</span> -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="riwayat_order.php">Orders</a></li>
                            
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <!-- Profile Section start -->
                <div class="col-md-12">
                    <div class="profile-section d-flex justify-content-between">
                        <div>
                            <div class="mb-5 d-flex">
                                <div class="d-flex flex-column justify-content-between">
                                    <h2><b>  <?= $pekerjaan[0]['jenis_pekerjaan'] ?> </b></h2>
                                    <h5>Rp <?= $pekerjaan[0]['harga'] ?></h5>
                                </div>
                            </div>
                            <div class="job-title">
                                <p class="fs-6"> <?= $pekerjaan[0]['deskripsi_order'] ?> </p>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex align-items-center">
                                <!-- Profile image -->
                                <img src="./assets/img/users/<?= $pekerjaan[0]['foto_profil'] ?>" alt="Profile Image"
                                    class="profile-img">
                                <!-- Profile information -->
                                <div class="profile-info">
                                    <div class="profile-name"><?= $pekerjaan[0]['name'] ?></div>
                                    <div class="profile-title">Indonesia</div>
                                </div>

                            </div>
                            <!-- Additional profile details -->
                            <!-- <div class="mt-3">
                                <p>Silahkan order dengan mendeskripsikan secara detail aplikasi yang anda inginkan :)</p>
                                <p>Jika bingung atau butuh konsultasi, klik tombol kontak di bawah!</p>
                            </div> -->

                            <!-- Buttons -->
                            <div class="d-grid gap-2">
                            <a href="https://api.whatsapp.com/send?phone=62<?= $pekerjaan[0]['nohp'] ?>" class="btn btn-primary mt-3" target="_blank">
    Contact me (Whatsapp)
</a>

                                <button class="btn btn-success mt-2" data-bs-toggle="modal"
                                    data-bs-target="#orderModal">Continue to Order</button>

                            </div>
                        </div>
                    </div>
                </div>
            <!-- Profile Section End -->

            <!-- Main Content Section -->
            <div class="col-md-12">
                <!-- Order Info Section -->
                <!-- <div class="order-info">
                    <h4>About this Gig</h4>
                    <p><?= $pekerjaan[0]['deskripsi_order'] ?></p>
                    Add more details about the gig as needed
                </div> -->

                <!-- Portfolio Section -->
                <!-- Portfolio Section -->
                <div class="portfolio-section">
                    <h4>Freelancer's Portfolio</h4>
                    <!-- Add your portfolio projects with images and descriptions -->
                    <img src="./assets/img/<?= $pekerjaan[0]['foto'] ?>" alt="Project 1" class="portfolio-img" style="width: 100%; height: 200px; object-fit: cover;">

                   
                    <!-- Add more portfolio items as needed -->
                </div>


                <!-- Skills Section -->
                <div class="skills-section">
                    <h4>Skills</h4>
                    <ul class="skills-list">
                        <li><?= $pekerjaan[0]['skills'] ?></li>
                        <!-- <li>React.js</li>
                        <li>Node.js</li> -->
                        <!-- Add more skills as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Order </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="process_order.php" method="POST" id="orderForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="jenisPekerjaan" class="form-label">Jenis Pekerjaan</label>
                            <input type="text" class="form-control" id="jenisPekerjaan"
                                value="<?= $pekerjaan[0]['jenis_pekerjaan'] ?>" readonly>
                        </div>

                        <input type="hidden" name="idPekerjaan" value="<?= $pekerjaan[0]['id_pekerjaan'] ?>">

                        <div class="mb-3">
                            <label for="namaKlien" class="form-label">Nama Klien</label>
                            <input type="text" class="form-control" id="namaKlien" required
                                value="<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';  ?>"
                                readonly>
                        </div>


                        <div class="mb-3">
                            <label for="deskripsiOrder" class="form-label">Deskripsi Order</label>
                            <textarea class="form-control" name="deskripsiOrder" id="deskripsiOrder" rows="3"
                                placeholder="Deskripsikan aplikasi yang Anda inginkan" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fileOrder" class="form-label">Upload File Order</label>
                            <input type="file" name="fileOrder" class="form-control" id="fileOrder">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitOrder"
                        onclick="document.getElementById('orderForm').submit()">Submit Order</button>
                </div>
            </div>
        </div>
    </div>



    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const continueToOrderBtn = document.querySelector('.btn-success');
        const orderModal = new bootstrap.Modal(document.getElementById('orderModal'));

        continueToOrderBtn.addEventListener('click', function() {
            orderModal.show();
        });




    });
    </script>

</body>

</html>