<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <!-- Link ke CSS Bootstrap (terserah versi yang ingin digunakan) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Link ke Font Awesome jika diperlukan -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles tambahan, jika ada -->
    <link rel="stylesheet" href="./assets/css/notification.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">TalentaHub</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link " href="dashboard.php">Explore</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active " href="client_notifications.php"> <i class="fas fa-bell"
                                    style="font-size: 24px; color: #ff0000;"></i></a>
                            <!-- <span class="badge">1</span> -->

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="assets/img/menu.png" alt="" width="32" height="32" class="rounded-circle">
                                <!-- <span class="badge">1</span> -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="riwayat_order.php">Orders</a></li>
                                <li><a class="dropdown-item" href="#">Messages</a></li>

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
    </header>

    <section class="section-50">
        <div class="container">
            <h3 class="m-b-50 heading-line">Notifications <i class="fa fa-bell text-muted"></i></h3>

            <div class="notification-ui_dd-content">
                <!-- Daftar notifikasi -->
                <!-- Notifikasi 1 -->
                <div class="notification-list ">
                    <div class="notification-list_content">
                        <div class="notification-list_img">
                            <img src="https://i.imgur.com/zYxDCQT.jpg" alt="user">
                        </div>
                        <div class="notification-list_detail">
                            <p><b>John Doe</b> reacted to your post</p>
                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde,
                                dolorem.</p>
                            <p class="text-muted"><small>10 mins ago</small></p>
                        </div>
                    </div>
                    <div class="notification-list_feature-img">
                        <img src="https://i.imgur.com/AbZqFnR.jpg" alt="Feature image">
                    </div>
                </div>
                <div class="notification-list notification-list--unread">
                    <div class="notification-list_content">
                        <div class="notification-list_img">
                            <img src="https://i.imgur.com/w4Mp4ny.jpg" alt="user">
                        </div>
                        <div class="notification-list_detail">
                            <p><b>Richard Miles</b> liked your post</p>
                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde,
                                dolorem.</p>
                            <p class="text-muted"><small>10 mins ago</small></p>
                        </div>
                    </div>
                    <div class="notification-list_feature-img">
                        <img src="https://i.imgur.com/AbZqFnR.jpg" alt="Feature image">
                    </div>
                </div>
                <div class="notification-list">
                    <div class="notification-list_content">
                        <div class="notification-list_img">
                            <img src="https://i.imgur.com/ltXdE4K.jpg" alt="user">
                        </div>
                        <div class="notification-list_detail">
                            <p><b>Brian Cumin</b> reacted to your post</p>
                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde,
                                dolorem.</p>
                            <p class="text-muted"><small>10 mins ago</small></p>
                        </div>
                    </div>
                    <div class="notification-list_feature-img">
                        <img src="https://i.imgur.com/bpBpAlH.jpg" alt="Feature image">
                    </div>
                </div>
                <div class="notification-list">
                    <div class="notification-list_content">
                        <div class="notification-list_img">
                            <img src="https://i.imgur.com/CtAQDCP.jpg" alt="user">
                        </div>
                        <div class="notification-list_detail">
                            <p><b>Lance Bogrol</b> reacted to your post</p>
                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde,
                                dolorem.</p>
                            <p class="text-muted"><small>10 mins ago</small></p>
                        </div>
                    </div>
                    <div class="notification-list_feature-img">
                        <img src="https://i.imgur.com/iIhftMJ.jpg" alt="Feature image">
                    </div>
                </div>
                <div class="notification-list">
                    <div class="notification-list_content">
                        <div class="notification-list_img">
                            <img src="https://i.imgur.com/zYxDCQT.jpg" alt="user">
                        </div>
                        <div class="notification-list_detail">
                            <p><b>Parsley Montana</b> reacted to your post</p>
                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde,
                                dolorem.</p>
                            <p class="text-muted"><small>10 mins ago</small></p>
                        </div>
                    </div>
                    <div class="notification-list_feature-img">
                        <img src="https://i.imgur.com/bpBpAlH.jpg" alt="Feature image">
                    </div>
                </div>
                <!-- ... Notifikasi lainnya ... -->
            </div>

            <div class="text-center">
                <a href="#!" class="dark-link">Load more activity</a>
            </div>

        </div>
    </section>

    <!-- Script Bootstrap (terserah versi yang digunakan) -->
    <script src="assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>