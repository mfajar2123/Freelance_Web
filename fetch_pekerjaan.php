<?php
include 'config.php';

// Query untuk mengambil data pekerjaan dari tabel pekerjaan dengan tambahan kolom status_pekerjaan
$sql = "SELECT pekerjaan.*, users.name, users.foto_profil, users.no_hp  
        FROM pekerjaan 
        JOIN users ON pekerjaan.freelancer_id = users.id";

$result = $conn->query($sql);

$pekerjaan = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Tambahkan pekerjaan ke dalam array $pekerjaan
        $pekerjaan[] = $row;
    }
    echo json_encode($pekerjaan); // Mengirim data dalam bentuk JSON
} else {
    echo "0 hasil";
}

$conn->close();
?>
