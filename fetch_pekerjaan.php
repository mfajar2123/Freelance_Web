<?php
include 'config.php';

// Query untuk mengambil data pekerjaan dari tabel pekerjaan
$sql = "SELECT pekerjaan.*, users.name, users.foto_profil, users.no_hp  FROM pekerjaan JOIN users on pekerjaan.freelancer_id=users.id";
// $sql = "SELECT * FROM pekerjaan";
$result = $conn->query($sql);

// Buat array untuk menyimpan data pekerjaan
$pekerjaan = [];

// Tampilkan data pekerjaan sebagai array JSON
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pekerjaan[] = $row;
    }
    echo json_encode($pekerjaan); // Mengirim data dalam bentuk JSON
} else {
    echo "0 hasil";
}

$conn->close();
?>