<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the configuration file
include 'config.php';

// Retrieve user role from the database
$userId = $_SESSION['user_id'];
$roleSql = "SELECT role FROM users WHERE id = {$userId}";
$roleResult = mysqli_query($conn, $roleSql);


// Check if the role is 'klien'
if ($roleResult->num_rows > 0) {
    $userRole = $roleResult->fetch_assoc()['role'];
    if ($userRole !== 'admin') {
        // Redirect to a different page or show an error message
        header("Location: unauthorized.php"); // Replace 'unauthorized.php' with the page you want to redirect unauthorized users to
        exit();
    }
} else {
    // Handle the case where user information is not found
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Atlantis Bootstrap 4 Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="./assets/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="./assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
    WebFont.load({
        google: {
            "families": ["Lato:300,400,700,900"]
        },
        custom: {
            "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                "simple-line-icons"
            ],
            urls: ['./assets/css/fonts.min.css']
        },
        active: function() {
            sessionStorage.fonts = true;
        }
    });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/atlantis.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="./assets/css/demo.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>


</head>

<body>
    <div class="wrapper fullheight-side sidebar_minimize">
        <!-- Logo Header -->
        <div class="logo-header position-fixed" data-background-color="blue">

            <a href="index.html" class="logo">
                <img src="./assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
            </a>

        </div>
        <!-- End Logo Header -->
        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2" data-background-color="blue">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="./assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    Admin
                                    <span class="user-level">Administrator</span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <!-- <li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li> -->
                                    <li>
                                        <a href="logout.php">
                                            <span class="link-collapse">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav">
                        <li class="nav-item active">
                            <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                                <span class="caret"></span>
                            </a>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->
        <div class="main-panel full-height">
            <div class="container">
                <div class="panel-header">
                    <div class="page-inner border-bottom pb-0 mb-3">
                        <div class="d-flex align-items-left flex-column">
                            <h2 class="pb-2 fw-bold">Dashboard</h2>
                        </div>
                    </div>
                </div>
                <div class="page-inner">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <img src="assets/img/users.png" alt="User Icon" class="img-fluid">
                                            </div>
                                        </div>
                                        <?php
                                        include 'config.php'; // Sesuaikan dengan nama file konfigurasi database Anda

                                        // Kueri SQL untuk mengambil jumlah user
                                        $query = "SELECT COUNT(*) as total_users FROM users";
                                        $result = $conn->query($query);

                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            $totalUsers = $row['total_users'];
                                        } else {
                                            // Handle error jika query tidak berhasil
                                            $totalUsers = 0;
                                        }

                                        // Tampilkan jumlah user di halaman web
                                        ?>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Total User</p>
                                                <h4 class="card-title"><?php echo $totalUsers; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <img src="assets/img/freelancer.png" alt="User Icon" class="img-fluid">
                                            </div>
                                        </div>
                                        <?php
                                        include 'config.php'; // Sesuaikan dengan nama file konfigurasi database Anda

                                        // Kueri SQL untuk mengambil jumlah user
                                        $query = "SELECT COUNT(*) as total_users FROM users WHERE role = 'freelancer'";
                                        $result = $conn->query($query);

                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            $totalUsers = $row['total_users'];
                                        } else {
                                            // Handle error jika query tidak berhasil
                                            $totalUsers = 0;
                                        }

                                        // Tampilkan jumlah user di halaman web
                                        ?>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Total Freelancer</p>
                                                <h4 class="card-title"><?php echo $totalUsers; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <img src="assets/img/client.png" alt="User Icon" class="img-fluid">
                                            </div>
                                        </div>
                                        <?php
                                        include 'config.php'; // Sesuaikan dengan nama file konfigurasi database Anda

                                        // Kueri SQL untuk mengambil jumlah user
                                        $query = "SELECT COUNT(*) as total_users FROM users WHERE role = 'klien'";
                                        $result = $conn->query($query);

                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            $totalUsers = $row['total_users'];
                                        } else {
                                            // Handle error jika query tidak berhasil
                                            $totalUsers = 0;
                                        }
                                        ?>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Total Client</p>
                                                <h4 class="card-title"><?php echo $totalUsers; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <img src="assets/img/job.png" alt="User Icon" class="img-fluid">
                                            </div>
                                        </div>
                                        <?php
                                        include 'config.php'; // Sesuaikan dengan nama file konfigurasi database Anda

                                        // Kueri SQL untuk mengambil jumlah user
                                        $query = "SELECT COUNT(*) as total_pekerjaan FROM pekerjaan";
                                        $result = $conn->query($query);

                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            $totalpekerjaan = $row['total_pekerjaan'];
                                        } else {
                                            // Handle error jika query tidak berhasil
                                            $totalpekerjaan = 0;
                                        }

                                        // Tampilkan jumlah user di halaman web
                                        ?>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Total Pekerjaan</p>
                                                <h4 class="card-title"><?php echo $totalpekerjaan; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="icon-big text-center">
                                                <img src="assets/img/order.png" alt="User Icon" class="img-fluid">
                                            </div>
                                        </div>
                                        <?php
                                        include 'config.php'; // Sesuaikan dengan nama file konfigurasi database Anda

                                        // Kueri SQL untuk mengambil jumlah order
                                        $query = "SELECT COUNT(*) as total_order FROM order_table";
                                        $result = $conn->query($query);

                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            $totalOrder = $row['total_order']; // Menggunakan nama alias yang benar
                                        } else {
                                            // Handle error jika query tidak berhasil
                                            $totalOrder = 0;
                                        }

                                        // Tampilkan jumlah order di halaman web
                                        ?>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Total Order</p>
                                                <h4 class="card-title"><?php echo $totalOrder; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <img src="assets/img/done.png" alt="User Icon" class="img-fluid">
                                            </div>
                                        </div>
                                        <?php
                                        include 'config.php'; // Sesuaikan dengan nama file konfigurasi database Anda

                                        // Kueri SQL untuk mengambil jumlah order
                                        $query = "SELECT COUNT(*) as total_order FROM order_table WHERE status = 'Selesai'";
                                        $result = $conn->query($query);

                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            $totalOrder = $row['total_order']; // Menggunakan nama alias yang benar
                                        } else {
                                            // Handle error jika query tidak berhasil
                                            $totalOrder = 0;
                                        }

                                        // Tampilkan jumlah order di halaman web
                                        ?>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Order Selesai</p>
                                                <h4 class="card-title"><?php echo $totalOrder; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">List User</h4>
                                    <a href="add_user.php" class="btn btn-info btn-sm">Add</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="basic-datatables" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Profil</th>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>No Handphone</th>
                                                    <th>Education</th>
                                                    <th>Country</th>
                                                    <th>Role</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
												include 'config.php';

												$query = "SELECT * FROM users";
												$result = $conn->query($query);

												if ($result->num_rows > 0) {
													$counter = 1;
													while ($row = $result->fetch_assoc()) {
														?>
                                                <tr>
                                                    <td><?php echo $counter++; ?></td>
                                                    <td><img src="./assets/img/users/<?php echo $row['foto_profil']; ?>"
                                                            alt="..." class="avatar-img rounded-circle"
                                                            style="width: 50px; height: 50px;"></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['username']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['no_hp']; ?></td>
                                                    <td><?php echo $row['education']; ?></td>
                                                    <td><?php echo $row['country']; ?></td>
                                                    <td><?php echo $row['role']; ?></td>
                                                    <td>
                                                        <!-- Tambahkan link untuk edit dengan menyertakan ID pengguna -->
                                                        <a href="edit_user.php?id=<?php echo $row['id']; ?>"
                                                            class="btn btn-info btn-sm">Edit</a>
                                                        <a href="delete_user.php?id=<?php echo $row['id']; ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php
													}
												} else {
													echo "<tr><td colspan='10'>No users found.</td></tr>";
												}

												$conn->close();
												?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
                        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
                        <script>
                        $(document).ready(function() {
                            if (!$.fn.DataTable.isDataTable('#basic-datatables')) {
                                $('#basic-datatables').DataTable({
                                    "lengthMenu": [10, 25, 50, 75, 100],
                                    "pageLength": 10, // Jumlah data per halaman
                                });
                            }
                        });
                        </script>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">List Pekerjaan</h4>
                                    <a href="add_pekerjaan.php" class="btn btn-info btn-sm">Add</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="pekerjaan-datatables"
                                            class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Freelancer</th>
                                                    <th>Jenis Pekerjaan</th>
                                                    <th>Deskripsi Order</th>
                                                    <th>Harga</th>
                                                    <th>No Handphone</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
												include 'config.php';

												// Use JOIN to fetch the freelancer's name
												$query = "SELECT pekerjaan.*, users.name AS freelancer_name 
														FROM pekerjaan 
														INNER JOIN users ON pekerjaan.freelancer_id = users.id";
												$result = $conn->query($query);

												if ($result->num_rows > 0) {
													$counter = 1;
													while ($row = $result->fetch_assoc()) {
														?>
                                                <tr>
                                                    <td><?php echo $counter++; ?></td>
                                                    <td><?php echo $row['freelancer_name']; ?></td>
                                                    <td><?php echo $row['jenis_pekerjaan']; ?></td>
                                                    <td><?php echo $row['deskripsi_order']; ?></td>
                                                    <td><?php echo $row['harga']; ?></td>
                                                    <td><?php echo $row['nohp']; ?></td>
                                                    <td>
                                                        <a href="edit_pekerjaan.php?id_pekerjaan=<?php echo $row['id_pekerjaan']; ?>"
                                                            class="btn btn-info btn-sm">Edit</a>
                                                        <a href="delete_pekerjaan.php?id_pekerjaan=<?php echo $row['id_pekerjaan']; ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php
													}
												} else {
													echo "<tr><td colspan='7'>No jobs found.</td></tr>";
												}

												$conn->close();
												?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
                        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
                        <script>
                        $(document).ready(function() {
                            if (!$.fn.DataTable.isDataTable('#pekerjaan-datatables')) {
                                $('#pekerjaan-datatables').DataTable({
                                    "lengthMenu": [10, 25, 50, 75, 100],
                                    "pageLength": 10, // Jumlah data per halaman
                                });
                            }
                        });
                        </script>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">List Order</h4>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="order-datatables" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Klien</th>
                                                    <th>Deskripsi Order</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
													include 'config.php';

													// Use JOIN to fetch the klien's name
													$query = "SELECT order_table.*, users.name AS klien_name 
															FROM order_table 
															INNER JOIN users ON order_table.klien_id = users.id";

													$result = $conn->query($query);

													if ($result->num_rows > 0) {
														$counter = 1;
														while ($row = $result->fetch_assoc()) {
															// Define class based on status
															$statusClass = '';
															switch ($row['status']) {
																case 'Menunggu Pembayaran':
																	$statusClass = 'btn-warning';
																	break;
																case 'Dalam Pengerjaan':
																	$statusClass = 'btn-primary';
																	break;
																case 'Selesai':
																	$statusClass = 'btn-success';
																	break;
																case 'Gagal':
																	$statusClass = 'btn-danger';
																	break;
																default:
																	$statusClass = 'btn-secondary';
																	break;
															}
													?>
                                                <tr>
                                                    <td><?php echo $counter++; ?></td>
                                                    <td><?php echo $row['klien_name']; ?></td>
                                                    <td><?php echo $row['deskripsi_order']; ?></td>
                                                    <td>
                                                        <button
                                                            class="btn <?php echo $statusClass; ?> btn-sm"><?php echo $row['status']; ?></button>
                                                    </td>
                                                    <td>
                                                        <a href="edit_order.php?id_order=<?php echo $row['id_order']; ?>"
                                                            class="btn btn-info btn-sm">Edit</a>
                                                        <a href="delete_order.php?id_order=<?php echo $row['id_order']; ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php
														}
													} else {
														echo "<tr><td colspan='7'>No jobs found.</td></tr>";
													}

													$conn->close();
													?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
                        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
                        <script>
                        $(document).ready(function() {
                            if (!$.fn.DataTable.isDataTable('#order-datatables')) {
                                $('#order-datatables').DataTable({
                                    "lengthMenu": [10, 25, 50, 75, 100],
                                    "pageLength": 10, // Jumlah data per halaman
                                });
                            }
                        });
                        </script>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="./assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="./assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="./assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="./assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Moment JS -->
    <script src="./assets/js/plugin/moment/moment.min.js"></script>

    <!-- Chart JS -->
    <script src="./assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="./assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="./assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="./assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="./assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- Bootstrap Toggle -->
    <script src="./assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="./assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="./assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

    <!-- Google Maps Plugin -->
    <script src="./assets/js/plugin/gmaps/gmaps.js"></script>

    <!-- Dropzone -->
    <script src="./assets/js/plugin/dropzone/dropzone.min.js"></script>

    <!-- Fullcalendar -->
    <script src="./assets/js/plugin/fullcalendar/fullcalendar.min.js"></script>

    <!-- DateTimePicker -->
    <script src="./assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

    <!-- Bootstrap Tagsinput -->
    <script src="./assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

    <!-- Bootstrap Wizard -->
    <script src="./assets/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

    <!-- jQuery Validation -->
    <script src="./assets/js/plugin/jquery.validate/jquery.validate.min.js"></script>

    <!-- Summernote -->
    <script src="./assets/js/plugin/summernote/summernote-bs4.min.js"></script>

    <!-- Select2 -->
    <script src="./assets/js/plugin/select2/select2.full.min.js"></script>

    <!-- Sweet Alert -->
    <script src="./assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Owl Carousel -->
    <script src="./assets/js/plugin/owl-carousel/owl.carousel.min.js"></script>

    <!-- Magnific Popup -->
    <script src="./assets/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Atlantis JS -->
    <script src="./assets/js/atlantis.min.js"></script>

    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="./assets/js/setting-demo.js"></script>
    <script src="./assets/js/demo.js"></script>
    <script>
    $('#lineChart').sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#177dff',
        fillColor: 'rgba(23, 125, 255, 0.14)'
    });

    $('#lineChart2').sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#f3545d',
        fillColor: 'rgba(243, 84, 93, .14)'
    });

    $('#lineChart3').sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#ffa534',
        fillColor: 'rgba(255, 165, 52, .14)'
    });
    </script>
</body>

</html>