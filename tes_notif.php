<?php
// Koneksi ke database (contoh menggunakan mysqli)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "freelance_web";

// Ganti $userId dengan id user yang sedang aktif

$userId = $_GET['id_user']; // Contoh penggunaan id user

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data notifikasi berdasarkan user_id dan diurutkan berdasarkan created_at secara menurun (DESC)
$sql = "SELECT * FROM notifications WHERE user_id = $userId ORDER BY created_at DESC";
$result = $conn->query($sql);

// Menghitung jumlah notifikasi yang belum dibaca
$countSql = "SELECT COUNT(*) AS unread_count FROM notifications WHERE user_id = $userId AND is_read = 0";
$countResult = $conn->query($countSql);
$rowCount = $countResult->fetch_assoc();
$unreadCount = $rowCount['unread_count'];
?>

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

    <style>
    .notification-list {
        /* Menghilangkan garis bawah */
        text-decoration: none !important;
        /* Gunakan !important jika diperlukan */
    }
    </style>





</head>

<body>
    <!-- Bagian header dan navigasi -->
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
                            <a class="nav-link active" href="tes_notif.php?id_user=<?php echo $_SESSION['user_id']; ?>">
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
                <?php
            if ($result->num_rows > 0) {
                // Loop untuk menampilkan notifikasinotification-ui_dd-content
                while ($row = $result->fetch_assoc()) {
            ?>
                <a href="process_notif.php?id=<?php echo $row['id']; ?>"
                    class="notification-list <?php if ($row['is_read'] == 0) echo 'notification-list--unread'; ?>">
                    <div class="notification-list_content">
                        <!-- Tampilkan data notifikasi -->
                        <div class="notification-list_img">
                            <img src="./assets/img/logoo.png" alt="user">
                        </div>
                        <div class="notification-list_detail">
                            <p><b>Admin</b> <?php echo $row['notification_type']; ?></p>
                            <p class="text-muted"><?php echo $row['message']; ?></p>

                            <?php
                                date_default_timezone_set('Asia/Jakarta');
                                // Ambil waktu dari database
                                $createdAt = $row['created_at'];
                                $createdAtTime = strtotime($createdAt); // Waktu dari database dalam UNIX timestamp
                                // Ganti 'Asia/Jakarta' dengan zona waktu yang sesuai
                                $currentTime = time(); // Waktu saat ini dalam UNIX timestamp

                                // Hitung selisih waktu dalam detik
                                $timeDifference = $currentTime - $createdAtTime;

                                // Konversi waktu ke menit dengan menghindari nilai negatif
                                $timeInMinutes = round(abs($timeDifference) / 60);

                                // Tampilkan dalam format '... mins ago', '... hours ago', atau '... days ago'
                                if ($timeInMinutes < 1) {
                                    echo "<p class='text-muted'><small>Just now</small></p>";
                                } elseif ($timeInMinutes < 60) {
                                    echo "<p class='text-muted'><small>$timeInMinutes mins ago</small></p>";
                                } elseif ($timeInMinutes < 1440) { // Lebih dari 60 menit tapi kurang dari 24 jam
                                    $timeInHours = round($timeInMinutes / 60);
                                    echo "<p class='text-muted'><small>$timeInHours hours ago</small></p>";
                                } else { // Lebih dari 24 jam
                                    $timeInDays = round($timeInMinutes / 1440);
                                    echo "<p class='text-muted'><small>$timeInDays days ago</small></p>";
                                }
                                ?>
                            <!-- Tampilkan sesuai dengan data yang diambil -->
                        </div>
                    </div>
                    <div class="notification-list_feature-img">
                        <img src="https://i.imgur.com/AbZqFnR.jpg" alt="Feature image">
                    </div>
                </a>
                <!-- ... -->
                <?php
                }
            } else {
                echo "Tidak ada notifikasi.";
            }
            ?>
            </div>

            <div class="text-center">
                <a href="#!" class="dark-link">Load more notification</a>
            </div>
        </div>
    </section>


    <!-- Bagian script dan JS lainnya -->
    <script src="assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>

<?php
// Tutup koneksi ke database setelah selesai digunakan
$conn->close();
?>