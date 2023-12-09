<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPekerjaan = $_POST['idPekerjaan'];
    $deskripsiOrder = $_POST['deskripsiOrder'];
    $klienId = $_SESSION['user_id'];

    if (empty($deskripsiOrder)) {
        ?>
<!DOCTYPE html>
<html>

<head>
    <title>Error - Deskripsi Order Kosong</title>
    <!-- Tambahkan CSS atau styling sesuai kebutuhan -->
    <style>
    .error-container {
        text-align: center;
        margin-top: 50px;
    }

    .error-message {
        font-size: 18px;
        color: red;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-message">
            Deskripsi Order tidak boleh kosong.
        </div>
        <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
    </div>
</body>

</html>
<?php
        exit(); // Hentikan eksekusi script jika deskripsi order kosong
    }
    
    $targetDirectory = __DIR__.'/assets/img/'; // Folder tujuan untuk menyimpan file
    $targetFile = $targetDirectory . basename($_FILES["fileOrder"]["name"]); // Path lengkap file yang akan diunggah
    $uploadOk = 1; // Flag untuk menandai apakah pengunggahan berhasil atau gagal

    // Validasi file kosong
    if ($_FILES["fileOrder"]["size"] == 0) {
        $file = ""; // Set file kosong jika tidak diunggah
    } else {
        // Cek apakah file sudah ada
        // if (file_exists($targetFile)) {
        //     echo "Maaf, file sudah ada.";
        //     $uploadOk = 0;
        // }

        // Batasi ukuran file (contoh diset maksimal 15MB)
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

            $file = $_FILES["fileOrder"]["name"];
        }
    }

    // Prepare dan bind parameter untuk query
    $queryInsertOrder = "INSERT INTO order_table (deskripsi_order, klien_id, id_pekerjaan, `file`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($queryInsertOrder);
    $stmt->bind_param("siss", $deskripsiOrder, $klienId, $idPekerjaan, $file);

    if ($stmt->execute()) {
        $lastOrderId = $conn->insert_id;
        // Ubah status_pekerjaan menjadi 'sudah dipesan'
        $queryUpdateStatus = "UPDATE pekerjaan SET status_pekerjaan = 'sudah dipesan' WHERE id_pekerjaan = ?";
        $stmtUpdate = $conn->prepare($queryUpdateStatus);
        $stmtUpdate->bind_param("i", $idPekerjaan);

        if ($stmtUpdate->execute()) {
            // Jika berhasil mengubah status_pekerjaan, redirect ke halaman pembayaran
            header("Location: halaman_pembayaran.php?order_id=$lastOrderId");
            exit();
        } else {
            echo "Gagal mengubah status pekerjaan.";
            exit();
        }
    } else {
        echo "Error: " . $queryInsertOrder . "<br>" . $conn->error;
    }

    $stmt->close();
}
?>