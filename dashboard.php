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


</head>

<body style="background-color: #EFF1F3;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">TalentaHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Explore</a>
                    </li>
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="tes_notif.php?id_user=<?php echo $_SESSION['user_id']; ?>">
                            <div class="d-flex flex-column align-items-center position-relative">
                                <?php if ($unreadCount > 0) { ?>
                                    <span class="badge badge-danger position-absolute top-0 start-60 translate-middle-x">
                                        <?php echo $unreadCount; ?>
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                <?php } ?>
                                <i class="fas fa-bell" style="font-size: 24px; color: #000000;"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="assets/img/menu.png" alt="" width="32" height="32" class="rounded-circle">
                            <!-- <span class="badge">1</span> -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="riwayat_order.php">Orders</a></li>


                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item"
                                    href="profile.php?id_user=<?php echo $_SESSION['user_id']; ?>">Profile</a>
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

    <div class="container pb-3">
        <div class="row">
            <div class="col-md-12">
                <!-- Hero Banner Section Start -->
                <div class="d-flex align-items-center px-3 rounded rounded-3 mt-3" style="background-color: #419197;">
                    <div class="my-4">
                        <img src="./assets/img/4890274.jpg" style="width: 350px;" class="rounded rounded-3" alt="">
                    </div>
                    <div class="ms-4">
                        <h2 style="color: white;"><b>Cari Proyek, Temukan Bakat, Semua bisa di TalentaHub!</b></h2>
                        <p style="color: white;">Di TalentaHub kita semua satu tim! Temukan proyek seru, kembangkan bakat, dan raih kesempatan freelance yang menanti. </p>
                        <!-- <input type="button" value="Cari tau lebih lanjut" class="btn" style="color: white; background-color: #78D6C6;"> -->
                    </div>
                </div>
                
                <div class="container">
                    <div class="row " id="services">
                        <!-- Di sini kartu-kartu pekerjaan akan dimuat oleh JavaScript -->
                    </div>
                </div>
                <!-- JavaScript for filter functionality -->
                <script src="assets/js/dashboard.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                    crossorigin="anonymous"></script>
</body>

</html>