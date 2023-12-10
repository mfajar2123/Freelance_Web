<?php
include 'config.php'; // Memuat file config.php untuk koneksi

// Periksa apakah formulir telah dikirim
if (isset($_POST['daftar'])) {

    // Ambil data dari formulir
    $user_id = $_POST['freelancer_id'];
    $nohp = $_POST['nohp'];
    $jenis_pekerjaan = $_POST['jenispekerjaan'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $skills = $_POST['skills'];

    // Upload gambar
    $foto = $_FILES['foto'];
    $foto_name = $foto['name'];
    $foto_tmp = $foto['tmp_name'];
    $foto_dest = 'assets/img/' . $foto_name;

    move_uploaded_file($foto_tmp, $foto_dest);

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO pekerjaan (nohp, jenis_pekerjaan, deskripsi_order, harga, foto, skills, freelancer_id) 
              VALUES ('$nohp', '$jenis_pekerjaan', '$deskripsi', '$harga', '$foto_name', '$skills', '$user_id')";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        header("Location: dashboardfreelance.php");
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
