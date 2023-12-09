<?php
session_start();
include 'config.php';

if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Ambil informasi dari tabel order_table dan users
    $query = "SELECT order_table.id_order, order_table.created_at, order_table.status, 
          pekerjaan.jenis_pekerjaan, order_table.deskripsi_order, users.name AS customer_name, 
          freelancer.name AS freelancer_name
          FROM order_table 
          INNER JOIN users ON order_table.klien_id = users.id 
          INNER JOIN pekerjaan ON order_table.id_pekerjaan = pekerjaan.id_pekerjaan
          INNER JOIN users AS freelancer ON pekerjaan.freelancer_id = freelancer.id
          WHERE users.id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Memulai konten HTML
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Order</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Your custom styles here -->
    <link rel="stylesheet" href="./assets/css/riwayat_order.css">
</head>

<body>
    <div class="order-container">
        <div class="order-header">
            <h2 class="text-center">Riwayat Order</h2>
        </div>

        <!-- Memulai loop untuk menampilkan data order -->
        <?php
        while ($row = $result->fetch_assoc()) {
            $orderId = $row['id_order'];
            $status = $row['status'];
            $jenisPekerjaan = $row['jenis_pekerjaan'];
?>
        <!-- Data Order -->




        <div class="order-item">
            <div class="row">
                <div class="col-md-2">
                    <h4>Tanggal</h4>
                    <p><?= $row['created_at'] ?></p>
                </div>
                <div class="col-md-2">
                    <h4>Pekerjaan</h4>
                    <p><?= $jenisPekerjaan ?></p>
                </div>
                <div class="col-md-4">
                    <h4>Status</h4>
                    <p><?= $row['status'] ?></p>
                </div>
                <div class="col-md-4">
                    <br><!-- <h4>Action</h4> -->

                    <button type="button" class="btn btn-details" data-bs-toggle="modal"
                        data-bs-target="#orderModal_<?= $orderId ?>"><i class="bi bi-eye"></i></button>
                    <button type="button" class="btn btn-details" data-bs-toggle="modal"
                        data-bs-target="#editModal_<?= $orderId ?>"><i class="bi bi-pencil"></i></button>
                    <?php if ($status === 'Menunggu Pembayaran') { ?>
                    <a href="halaman_pembayaran.php?order_id=<?= $orderId ?>" class="btn btn-bayar">Bayar</a>
                    <button type="button" class="btn btn-bayar" onclick="confirmDelete(<?= $orderId ?>)">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                    <?php } else { ?>
                    <?php } ?>


                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="orderModal_<?= $orderId ?>" tabindex="-1"
            aria-labelledby="orderModalLabel_<?= $orderId ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel_<?= $orderId ?>">Detail Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Nama Customer: <?= $row['customer_name'] ?></p>
                        <p>Jenis Pekerjaan: <?= $jenisPekerjaan ?></p>
                        <p>Deskripsi Order: <?= $row['deskripsi_order'] ?></p>
                        <!-- Tambahkan deskripsi order -->
                        </p>
                        <p>Nama Freelancer: <?= $row['freelancer_name'] ?></p>
                        <p>Status: <?= $row['status'] ?></p>
                        <!-- Anda dapat menambahkan lebih banyak informasi sesuai kebutuhan -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary"
                            onclick="editDeskripsiOrder(<?= $orderId ?>)">Edit</button> -->
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal_<?= $orderId ?>" tabindex="-1"
            aria-labelledby="editModalLabel_<?= $orderId ?>" aria-hidden="true">
            <!-- Konten modal untuk mengedit deskripsi_order -->
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel_<?= $orderId ?>">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="update_description.php" method="POST">
                            <input type="hidden" name="order_id" value="<?= $orderId ?>">
                            <div class="mb-3">
                                <label for="deskripsi_order_<?= $orderId ?>" class="form-label">Deskripsi Order</label>
                                <textarea class="form-control" name="deskripsi_order"
                                    id="deskripsi_order_<?= $orderId ?>"><?= $row['deskripsi_order'] ?></textarea>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
        function confirmDelete(orderId) {
            var confirmation = confirm("Apakah Anda yakin ingin menghapus pesanan ini?");
            if (confirmation) {
                // Jika pengguna menyetujui, lakukan penghapusan
                window.location.href = "process_delete_order.php?order_id=" + orderId;
            } else {
                // Tidak melakukan apa-apa jika pengguna membatalkan
                // alert("Penghapusan dibatalkan.");
            }
        }
        </script>

        <?php
        } // Tutup loop while
?>
    </div>
    <div class="text-center mt-2 mb-3">
        <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
    } else {
        echo "Tidak ada data yang ditemukan.";
    }

    $stmt->close();
} else {
    echo "User ID tidak ditemukan.";
}

$conn->close();
?>