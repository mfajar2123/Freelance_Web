<?php
session_start();
include 'config.php';

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Query untuk mendapatkan detail order berdasarkan id_order
    $query = "SELECT order_table.*, users.name as klien_name
              FROM order_table 
              JOIN users ON order_table.klien_id = users.id
              WHERE order_table.id_order = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $orderDetail = $result->fetch_assoc();
        // Memulai konten HTML
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detail Order</title>
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

            <style>
                body {
                    background-color: #78D6C6;
                }

                .card {
                    background-color: #ffffff;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                    margin-top: 20px;
                }
            </style>
        </head>

        <body>
        <div class="container mt-5">
        <div class="card">
            <div class="row">
            <h2 class="mb-4">Detail Order</h2>
                <div class="col-md-6">
                    <div class="col-md-12">
                             <label class="labels">ID Order</label>
                             <h5><?= $orderDetail['id_order'] ?></h5>
                        </div><br>
                        <div class="col-md-12">
                             <label class="labels">Klien</label>
                             <h5><?= $orderDetail['klien_name'] ?></h5>
                        </div><br>
                        <div class="col-md-12">
                             <label class="labels">Deskripsi Order</label>
                             <h5><?= $orderDetail['deskripsi_order'] ?></h5>
                        </div><br>
                        <div class="col-md-12">
                             <label class="labels">File</label>
                             <h5><a href="./assets/img/<?= $orderDetail['file'] ?>" download><?= $orderDetail['file'] ?></a></h5>
                        </div><br>
                        <div class="col-md-12">
                             <label class="labels">Status</label>
                             <h5><?= $orderDetail['status'] ?></h5>
                        </div>
                    <!-- Tambahkan informasi lain sesuai kebutuhan -->
                </div>
                <div class="col-md-3">
                    <h4>Action</h4>
                    <form action="update_status.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="statusSelect">Ubah Status</label>
                            <select class="form-control" id="statusSelect" name="status" onchange="toggleTextInput()">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Gagal">Gagal</option>
                            </select>
                        </div>
                        <div class="form-group" id="textInputGroup" style="display: none;">
                            <label for="fileInput">Upload File Finish</label>
                            <input type="file" class="form-control" id="fileInput" name="file_input">
                        </div>
                        <input type="hidden" name="order_id" value="<?= $orderId ?>"><br>
                        <button type="submit" class="btn btn-details btn-primary">Submit</button>
                    </form>
                    <script>
                        function toggleTextInput() {
                            var statusSelect = document.getElementById("statusSelect");
                            var textInputGroup = document.getElementById("textInputGroup");

                            // Jika status "Selesai" dipilih, tampilkan elemen input teks
                            if (statusSelect.value === "Selesai") {
                                textInputGroup.style.display = "block";
                            } else {
                                // Jika status lain dipilih, sembunyikan elemen input teks
                                textInputGroup.style.display = "none";
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <a href="freelance_order.php" class="btn btn-primary" >Back to List Order</a>
        </div>
    </div>
            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>
        <?php
    } else {
        echo "Order tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID Order tidak valid.";
}
?>
