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
$roleSql = "SELECT role FROM users WHERE id = ?";
$roleStmt = $conn->prepare($roleSql);
$roleStmt->bind_param("i", $userId);
$roleStmt->execute();
$roleResult = $roleStmt->get_result();

// Check if the role is 'klien'
if ($roleResult->num_rows > 0) {
    $userRole = $roleResult->fetch_assoc()['role'];
    if ($userRole !== 'klien') {
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

<?php
include 'config.php';

$order_id=$_GET['order_id'];

// Query untuk mengambil data pekerjaan dari tabel pekerjaan
$sql = "SELECT order_table.*, pekerjaan.harga FROM order_table join pekerjaan on pekerjaan.id_pekerjaan=order_table.id_pekerjaan  WHERE id_order= $order_id";
$result = $conn->query($sql);

// Buat array untuk menyimpan data pekerjaan
$order = [];
$conn->close();

// Tampilkan data pekerjaan sebagai array JSON
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $order[] = $row;
    }
      // Mengirim data dalam bentuk JSON
} else {
    echo "tidak ditemukan";
    die;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your custom styles here -->
    <style>
    /* Add your custom styles here */
    body {
        font-family: Arial, sans-serif;
        background-color: #78D6C6;
    }

    .payment-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .payment-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .payment-header h2 {
        font-size: 24px;
        font-weight: bold;
    }

    .payment-header span {
        font-size: 18px;
        color: #777;
    }

    .payment-details {
        margin-bottom: 30px;
    }

    .payment-details p {
        font-size: 16px;
        line-height: 1.6;
        color: #333;
    }

    .payment-amount {
        font-size: 22px;
        font-weight: bold;
        color: #1dbf73;
    }

    .payment-methods {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .payment-method {
        display: flex;
        align-items: center;
        padding: 10px;
        border: 1px solid #eee;
        border-radius: 5px;
        cursor: pointer;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .payment-method:hover {
        border-color: #1dbf73;
        box-shadow: 0px 0px 5px rgba(29, 191, 115, 0.3);
    }

    .payment-method img {
        max-width: 40px;
        margin-right: 10px;
    }

    .payment-method span {
        font-weight: bold;
    }

    .payment-btn {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .btn-pay {
        padding: 10px 30px;
        font-size: 18px;
        font-weight: bold;
        color: #fff;
        background-color: #1dbf73;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-pay:hover {
        background-color: #149f5b;
    }

    .upload-btn {
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        background-color: #1dbf73;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .upload-btn:hover {
        background-color: #149f5b;
    }

    .upload-input {
        display: none;
    }

    .payment-method.selected {
        border-color: #1dbf73;
        /* Warna outline yang dipilih */
        box-shadow: 0px 0px 5px rgba(29, 191, 115, 0.3);
        /* Efek shadow untuk highlight */
    }

    .payment-btn {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .payment-btn div {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    </style>
</head>

<body>



    <div class="payment-container">
        <div class="payment-header">
            <h2>Pembayaran</h2>
            <span>Order ID: <?= $order[0]['id_order'] ?></span>
        </div>

        <div class="payment-details">
            <p>Terima kasih atas pesanan Anda!</p>
            <p>Total Pembayaran:</p>
            <p class="payment-amount"><?= $order[0]['harga'] ?></p>
            <p>Nomor HP untuk Transfer: <strong><?= $order[0]['harga'] ?></strong></p>
        </div>

        <form action="process_buktiPembayaran.php" method="POST" id="formBayar" enctype="multipart/form-data">
            <div class="payment-methods">
                <!-- Metode Pembayaran -->
                <div class="payment-method" id="gopay">
                    <label for="gopayRadio">
                        <input type="radio" id="gopayRadio" name="metodePembayaran" value="GoPay">
                        <img src="https://via.placeholder.com/50" alt="GoPay Logo">
                        <span>Bayar dengan GoPay</span>
                    </label>
                </div>
                <div class="payment-method" id="ovo">
                    <label for="ovoRadio">
                        <input type="radio" id="ovoRadio" name="metodePembayaran" value="OVO">
                        <img src="https://via.placeholder.com/50" alt="OVO Logo">
                        <span>Bayar dengan OVO</span>
                    </label>
                </div>
                <div class="payment-method" id="dana">
                    <label for="danaRadio">
                        <input type="radio" id="danaRadio" name="metodePembayaran" value="DANA">
                        <img src="https://via.placeholder.com/50" alt="DANA Logo">
                        <span>Bayar dengan DANA</span>
                    </label>
                </div>
                <div class="payment-method" id="shopeepay">
                    <label for="shopeepayRadio">
                        <input type="radio" id="shopeepayRadio" name="metodePembayaran" value="ShopeePay">
                        <img src="https://via.placeholder.com/50" alt="ShopeePay Logo">
                        <span>Bayar dengan ShopeePay</span>
                    </label>
                </div>

                <!-- Tombol Upload Bukti Transfer -->

            </div>

            <!-- ... Bagian HTML sebelumnya ... -->

            <div class="payment-btn">
                <div>
                    <input type="hidden" name="idOrder" value="<?= $order[0]['id_order'] ?>">
                    <label for="fileUpload" class="upload-btn">Upload Bukti Transfer</label>
                    <input type="file" name="fileBuktiBayar" class="upload-input" id="fileUpload">
                </div>
                <div>

                    <button class="btn btn-pay" disabled>Bayar Sekarang</button>
                </div>

            </div>

            <!-- ... Bagian HTML setelahnya ... -->


            <div class="d-grid gap-2">
                <a href="riwayat_order.php" class="btn btn-warning mt-3">Bayar Nanti</a>
            </div>
        </form>
        <br>
        <button class="btn btn-danger" id="removeFileBtn" style="display: none; text-align:center;">Hapus File</button>



        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Your custom scripts here -->
        <!-- ... (bagian sebelumnya) ... -->

        <!-- Your custom scripts here -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethods = document.querySelectorAll('.payment-method');
            const fileUpload = document.getElementById('fileUpload');
            const btnPay = document.querySelector('.btn-pay');
            const removeFileBtn = document.getElementById('removeFileBtn');

            // Add click event listener to each payment method
            paymentMethods.forEach(function(method) {
                method.addEventListener('click', function() {
                    // Clear previously selected method
                    paymentMethods.forEach(function(el) {
                        el.classList.remove('selected');
                    });

                    // Set current selected method
                    this.classList.add('selected');

                    // Enable 'Bayar Sekarang' button if file uploaded
                    btnPay.disabled = !fileUpload.files[0];
                    removeFileBtn.style.display = fileUpload.files[0] ? 'inline-block' : 'none';
                });
            });

            // Disable 'Bayar Sekarang' button if no file uploaded
            fileUpload.addEventListener('change', function() {
                btnPay.disabled = !fileUpload.files[0];
                removeFileBtn.style.display = fileUpload.files[0] ? 'inline-block' : 'none';
            });

            // Handle 'Bayar Sekarang' button click
            btnPay.addEventListener('click', function() {
                const selectedMethod = document.querySelector('.payment-method.selected');
                const paymentMethodId = selectedMethod ? selectedMethod.id : '';

                // Simpan ke database atau lakukan tindakan lain sesuai metode pembayaran yang dipilih
                console.log(`Metode pembayaran yang dipilih: ${paymentMethodId}`);
                document.getElementById('formBayar').submit();

            });


            // document.getElementById('formBayar').addEventListener('submit', function(event) {
            //     event.preventDefault(); // Mencegah aksi default formulir (pengiriman langsung)

            //     const formData = new FormData(this); // Mengambil data formulir
            //     const url = 'process_buktiPembayaran.php'; // Ganti dengan URL endpoint Anda

            //     fetch(url, {
            //         method: 'POST',
            //         body: formData
            //     })
            //     .then(response => {
            //         if (!response.ok) {
            //             throw new Error('Terjadi kesalahan saat mengirim data.');
            //         }
            //         return response.text();
            //     })
            //     .then(data => {
            //         console.log(data); // Output dari server setelah data dikirim
            //         // Tambahkan logika atau tindakan lainnya setelah pengiriman berhasil
            //     })
            //     .catch(error => {
            //         console.error(error);
            //         // Tambahkan penanganan kesalahan atau pesan untuk pengguna
            //     });
            // });


            // Handle 'Remove File' button click
            // Handle 'Remove File' button click
            removeFileBtn.addEventListener('click', function() {
                fileUpload.value = ''; // Reset the file input
                btnPay.disabled = true; // Disable 'Bayar Sekarang' button
                removeFileBtn.style.display = 'none'; // Hide 'Remove File' button
            });
            //     // Tambahkan logika atau tindakan lainnya setelah penghapusan berhasil
            // })
            // .catch(error => {
            //     console.error(error);
            //     // Tambahkan penanganan kesalahan atau pesan untuk pengguna
            // });
        });
        </script>
        </script>
</body>

</html>