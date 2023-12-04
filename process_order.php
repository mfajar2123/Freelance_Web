<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPekerjaan = $_POST['idPekerjaan'];
    $deskripsiOrder = $_POST['deskripsiOrder'];
      
    $klienId = $_SESSION['user_id'];
    
$targetDirectory = __DIR__.'/assets/img/'; // Folder tujuan untuk menyimpan file
$targetFile = $targetDirectory . basename($_FILES["fileOrder"]["name"]); // Path lengkap file yang akan diunggah
$uploadOk = 1; // Flag untuk menandai apakah pengunggahan berhasil atau gagal

// Cek apakah file sudah ada
if (file_exists($targetFile)) {
    echo "Maaf, file sudah ada.";
    $uploadOk = 0;
}

// Batasi ukuran file (contoh diset maksimal 5MB)
if ($_FILES["fileOrder"]["size"] > 15 * 1024 * 1024) {
    echo "Maaf, ukuran file terlalu besar.";
    $uploadOk = 0;
}

// Izinkan hanya beberapa tipe file tertentu (misalnya: hanya gambar)
$allowedExtensions = array("jpg", "pdf", "jpeg", "png", "gif");
$fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
if (!in_array($fileExtension, $allowedExtensions)) {
    echo "Maaf, hanya file JPG, JPEG, pdf, PNG, dan GIF yang diizinkan.";
    $uploadOk = 0;
}

// Periksa apakah uploadOk masih bernilai 0
if ($uploadOk == 0) {
    echo "Maaf, file tidak diunggah.";
    die;
} else { // Jika semua syarat terpenuhi, coba unggah file
    if (move_uploaded_file($_FILES["fileOrder"]["tmp_name"], $targetFile)) {
        echo "File " . basename($_FILES["fileOrder"]["name"]) . " berhasil diunggah.";
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file.";
        die;
    }

}

$file=$_FILES["fileOrder"]["name"];
        
$queryInsertOrder = "INSERT INTO order_table (deskripsi_order, klien_id, id_pekerjaan, `file`) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($queryInsertOrder);
$stmt->bind_param("siss", $deskripsiOrder, $klienId, $idPekerjaan, $file);

if ($stmt->execute()) {
    $lastOrderId = $conn->insert_id;
    header("Location: halaman_pembayaran.php?order_id=$lastOrderId");
    exit();
} else {
    echo "Error: " . $queryInsertOrder . "<br>" . $conn->error;
}

$stmt->close();
}


?>