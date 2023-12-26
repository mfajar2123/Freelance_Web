<?php
    session_start();
        if (!isset($_SESSION['user_id'])) {
                header("Location: login.php");
                exit();
            }
            include 'config.php';


$userId = $_SESSION['user_id'];
$countSql = "SELECT COUNT(*) AS unread_count FROM notifications WHERE user_id = $userId AND is_read = 0";
$countResult = $conn->query($countSql);
$rowCount = $countResult->fetch_assoc();
$unreadCount = $rowCount['unread_count'];
?>

<html>

<head>
    <!-- Bootstrap CDN -->
    <title>TalentaHub</title>
    <link href="assets/img/logoo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
    .custom-text {
        font-size: 16px;
        /* Ubah sesuai dengan ukuran yang diinginkan */
        width: 250px;
        /* Ubah sesuai dengan lebar yang diinginkan */
        height: 80px;
        /* Ubah sesuai dengan tinggi yang diinginkan */
        max-width: 300px;
        /* Batas maksimum lebar */
        min-height: 50px;
        /* Batas minimum tinggi */
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Freelancer Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="tambahpekerjaan.php" class="btn btn-primary">Tambah Pekerjaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="freelancer_notifications.php?id_user=<?php echo $_SESSION['user_id']; ?>">
                            <i class="fas fa-bell" style="font-size: 24px; color: #000000;"></i>
                            <?php if ($unreadCount > 0) { ?>
                            <span class="badge"><?php echo $unreadCount; ?></span>
                            <?php } ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="assets/img/menu.png" alt="" width="32" height="32" class="rounded-circle">
                            <!-- <span class="badge">1</span> -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="freelance_order.php">Orders</a></li>


                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item"
                                    href="profile_freelance.php?id_user=<?php echo $_SESSION['user_id']; ?>">Profile</a>
                            </li>
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


    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- Service cards -->
                <div class="row">
                    <?php
                    // Gunakan $_SESSION['user_id'] untuk mendapatkan ID pengguna yang login
                    $user_id = $_SESSION['user_id'];

                    // Koneksi ke database
                    include 'config.php';

                    // Query untuk mendapatkan pekerjaan berdasarkan ID pengguna
                    $query = "SELECT * FROM pekerjaan WHERE freelancer_id = $user_id";
                    $result = $conn->query($query);

                    // Periksa apakah ada pekerjaan yang ditemukan
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Mengisi konten kartu dengan data pekerjaan
                    ?>
                    <div class="col-md-3">
                        <div class="card service-card" data-category="web" data-skill="html">
                            <img src="assets/img/<?php echo $row['foto']; ?>">

                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['jenis_pekerjaan']; ?></h5>
                                <p class="card-text custom-text"><?php echo $row['deskripsi_order']; ?></p>
                            </div>
                            <div class="card-footer">
                                <span>Price: $<?php echo $row['harga']; ?></span>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="update_pekerjaan.php?id_pekerjaan=<?= $row['id_pekerjaan'] ?>"
                                    class="btn btn-primary" style="background-color: rgba(1, 4, 136, 0.9);">Edit</a>
                                <a href="process_delete_pekerjaan.php?id_pekerjaan=<?= $row['id_pekerjaan'] ?>"
                                    class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
                            </div>
                        </div>
                    </div>

                    <?php
                        }
                    } else {
                        echo "Tidak ada pekerjaan yang tersedia.";
                    }

                    // Tutup koneksi ke database
                    $conn->close();
                    ?>
                </div>

            </div>
        </div>
    </div>
    </div>
    <!-- JavaScript for filter functionality -->
    <script src="assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>