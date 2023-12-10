<?php
session_start();
include 'config.php';

// Pastikan parameter id_pekerjaan ada
if (isset($_GET['id_pekerjaan'])) {
    $id_pekerjaan = $_GET['id_pekerjaan'];

    // Query untuk mendapatkan data pekerjaan berdasarkan ID
    $query = "SELECT * FROM pekerjaan WHERE id_pekerjaan = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_pekerjaan);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $pekerjaanDetail = $result->fetch_assoc();

        // Memproses formulir update pekerjaan
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Tangani pembaruan data pekerjaan di sini
            $jenis_pekerjaan = $_POST['jenis_pekerjaan'];
            $deskripsi_order = $_POST['deskripsi_order'];
            $skills = $_POST['skills'];
            $harga = $_POST['harga'];
            $nohp = $_POST['nohp'];

            // Mengelola upload foto
            $foto = $pekerjaanDetail['foto']; // Foto sebelumnya

            // Jika ada file foto yang diupload, proses upload dan gunakan nama file yang baru
            if (!empty($_FILES['foto']['name'])) {
                $uploadDir = 'assets/img/';
                $uploadFile = $uploadDir . basename($_FILES['foto']['name']);

                if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile)) {
                    $foto = $_FILES['foto']['name'];
                } else {
                    echo "Upload failed.";
                }
            }

            // TODO: Lakukan query UPDATE ke database menggunakan data yang baru
            $updateQuery = "UPDATE pekerjaan SET jenis_pekerjaan=?, deskripsi_order=?, skills=?, harga=?, foto=?, nohp=? WHERE id_pekerjaan=?";
            $stmtUpdate = $conn->prepare($updateQuery);
            $stmtUpdate->bind_param("sssssis", $jenis_pekerjaan, $deskripsi_order, $skills, $harga, $foto, $nohp, $id_pekerjaan);

            if ($stmtUpdate->execute()) {
                // Jika berhasil memperbarui, arahkan kembali ke halaman dashboardfreelance.php
                header("Location: dashboardfreelance.php");
                exit();
            } else {
                echo "Error updating record: " . $stmtUpdate->error;
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pekerjaan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Your custom styles here -->
    <link rel="stylesheet" href="./assets/css/edit_pekerjaan.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Pekerjaan</h2>
        <!-- Formulir update pekerjaan -->
        <form action="update_pekerjaan.php?id_pekerjaan=<?= $pekerjaanDetail['id_pekerjaan'] ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_pekerjaan" value="<?= $pekerjaanDetail['id_pekerjaan'] ?>">
            <!-- Tambahkan elemen formulir sesuai kebutuhan -->
            <div class="mb-3">
                <label for="jenisPekerjaan" class="form-label">Jenis Pekerjaan</label>
                <input type="text" class="form-control" id="jenisPekerjaan" name="jenis_pekerjaan" value="<?= $pekerjaanDetail['jenis_pekerjaan'] ?>">
            </div>
            <div class="mb-3">
                <label for="deskripsiOrder" class="form-label">Deskripsi Pekerjaan</label>
                <textarea class="form-control" id="deskripsiOrder" name="deskripsi_order" rows="4"><?= $pekerjaanDetail['deskripsi_order'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="skills" class="form-label">Skills</label>
                <input type="text" class="form-control" id="skills" name="skills" value="<?= $pekerjaanDetail['skills'] ?>">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" value="<?= $pekerjaanDetail['harga'] ?>">
            </div>
            <div class="mb-3">
                <label for="nohp" class="form-label">No Handphone</label>
                <input type="text" class="form-control" id="nohp" name="nohp" value="<?= $pekerjaanDetail['nohp'] ?>">
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
                <?php if (!empty($pekerjaanDetail['foto'])) { ?>
                    <img src="assets/img/<?= $pekerjaanDetail['foto'] ?>" alt="Current Foto" class="mt-2" style="max-width: 200px;">
                <?php } ?>
            </div>

            <button type="submit" class="btn btn-primary">Update Pekerjaan</button>
        </form>

        <a href="dashboardfreelance.php" class="btn btn-secondary mt-3">Back to List Pekerjaan</a>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    } else {
        echo "Pekerjaan tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID Pekerjaan tidak valid.";
}
?>
