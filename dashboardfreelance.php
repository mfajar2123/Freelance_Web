<?php
                    session_start();
                    if (!isset($_SESSION['user_id'])) {
                        header("Location: login.php");
                        exit();
                    }
?>
<html>
<head>
    <!-- Bootstrap CDN -->
    <title>TalentaHub</title>
    <link href="assets/img/logoo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    
       
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">TalentaHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="tambahpekerjaan.php" class="btn btn-primary">Tambah Pekerjaan</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Explore</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="assets/img/menu.png" alt="" width="32" height="32" class="rounded-circle">
                            <span class="badge">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Orders</a></li>
                            <li><a class="dropdown-item" href="#">Messages</a></li>
                            <li><a class="dropdown-item" href="#">Notifications</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Dashboard</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Help & Support</a></li>
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
                <!-- Filter section -->
                <div class="filter-section">
                    <label for="category">Category:</label>
                    <select id="category">
                        <option value="">All</option>
                        <option value="web">Web Development</option>
                        <option value="mobile">Mobile Development</option>
                        <option value="design">Design</option>
                        <option value="writing">Writing</option>
                        <option value="data">Data Science</option>
                    </select>
                    <label for="skill">Skill:</label>
                    <select id="skill">
                        <option value="">All</option>
                        <option value="html">HTML</option>
                        <option value="css">CSS</option>
                        <option value="js">JavaScript</option>
                        <option value="php">PHP</option>
                        <option value="python">Python</option>
                    </select>
                    <label for="keyword">Keyword:</label>
                    <input type="text" id="keyword" placeholder="Enter keyword">
                    <button id="filter">Filter</button>
                </div>
                <!-- Service cards -->
                <div class="row" id="services">
                    <div class="col-md-3">
                        <div class="card service-card" data-category="web" data-skill="html">
                            <img src="assets/img/contoh.jpg" class="card-img-top" alt="Service 1">
                            <div class="card-profile d-flex align-items-center m-lg-2">
                                <img src="assets/img/download.jpg" class="card-profile-img rounded-circle" alt="Profile 9" style="width: 35px; height: 35px;">
                                <span class="card-profile-name ms-2" style="font-weight: bold;">Muhamad Fajar</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Web Development</h5>
                                <p class="card-text">I can create responsive and dynamic websites using the latest technologies.</p>
                            </div>
                            <div class="card-footer">
                                <span>Price: $50</span>
                                <a href="order_detail.php" class="btn btn-primary" style="background-color: rgba(1, 4, 136, 0.9);">Order</a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript for filter functionality -->
   <script src="assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>