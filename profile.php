<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

$user_id=$_GET['id_user'];

// Query untuk mengambil data pekerjaan dari tabel pekerjaan
// $sql = "SELECT pekerjaan.*, users.name, users.no_hp, users.foto_profil  FROM pekerjaan JOIN users on pekerjaan.freelancer_id=users.id WHERE id_pekerjaan=$pekerjaan_id";
$sql = "SELECT * FROM `users` WHERE id=$user_id";
$result = $conn->query($sql);

// Buat array untuk menyimpan data pekerjaan
$user = [];
$conn->close();

// Tampilkan data pekerjaan sebagai array JSON
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $user[] = $row;
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
    <title>Profile </title>
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Your custom styles here -->
    <link rel="stylesheet" href="./assets/css/profile.css">
</head>

<body>




    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">

            <div class="col-md-3 border-right">
                <div class="text-left mt-3">
                    <a href="dashboard.php" class="btn btn-outline-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M11.354 3.646a.5.5 0 0 0 0 .708L8.707 7.707H14.5a.5.5 0 0 0 0-1H8.707l2.647-2.646a.5.5 0 0 0 0-.708l-.708-.708a.5.5 0 0 0-.707 0l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .707 0l.708-.708z" />
                        </svg>
                        Back
                    </a>
                </div>
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        width="150px" src="./assets/img/users/<?= $user[0]['foto_profil'] ?>"><span
                        class="font-weight-bold"><?= $user[0]['name'] ?>
                    </span><span class="text-black-50"><?= $user[0]['email'] ?></span><span> </span>

                    <form action="process_update_fotoProfil.php" method="POST" enctype="multipart/form-data">
                        <div class="mt-3">
                            <label for="editPhoto" class="btn btn-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M12.5 0a1.5 1.5 0 0 1 1.5 1.5v12a1.5 1.5 0 0 1-1.5 1.5h-11a1.5 1.5 0 0 1-1.5-1.5v-12a1.5 1.5 0 0 1 1.5-1.5h11zM11.122 1.122a.5.5 0 0 0-.707 0l-8 8a.5.5 0 0 0 0 .707l.586.586a.5.5 0 0 0 .707 0l8-8a.5.5 0 0 0 0-.707l-.586-.586z" />
                                    <path fill-rule="evenodd"
                                        d="M5.5 14a.5.5 0 0 0 .5-.5V11a.5.5 0 0 0-1 0v2.5a.5.5 0 0 0 .5.5zm0-8a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-1 0v2.5a.5.5 0 0 0 .5.5zm3 5a.5.5 0 0 0 0-1H3a.5.5 0 0 0 0 1h5z" />
                                </svg>
                                Edit Photo
                                <input type="file" id="editPhoto" name="editPhoto" style="display: none;">
                            </label>
                        </div>

                        <div class="mt-5 text-center">
                            <button id="savePhotoButton" class="btn btn-primary profile-button" type="submit"
                                onclick="return confirm('Apakah Anda yakin ingin menyimpan perubahan?')"
                                style="display: none;">Save Photo</button>
                        </div>
                    </form>
                </div>



            </div>
            <div class="col-md-5 border-right">

                <div class="p-3 py-5">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <form method="POST" action="process_update_profile.php">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="labels">Name</label>
                                <input type="text" class="form-control" placeholder="Full name" name="name"
                                    value="<?= $user[0]['name'] ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Mobile Number</label>
                                <input type="text" class="form-control" placeholder="Enter phone number" name="nohp"
                                    value="<?= $user[0]['no_hp'] ?>">
                            </div>
                            <!-- ... (input lainnya) ... -->
                            <div class="col-md-12">
                                <label class="labels">Email ID</label>
                                <input type="text" class="form-control" placeholder="Enter email id" name="email"
                                    value="<?= $user[0]['email'] ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Education</label>
                                <input type="text" class="form-control" placeholder="education" name="education"
                                    value="<?= $user[0]['education'] ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Country</label>
                                <input type="text" class="form-control" placeholder="country" name="country"
                                    value="<?= $user[0]['country'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">City address</label>
                                <input type="text" class="form-control" value="<?= $user[0]['city_address'] ?>"
                                    placeholder="state" name="city">
                            </div>
                        </div>
                        <div class="mt-5 text-center">

                            <button class="btn btn-primary profile-button" type="submit"
                                onclick="return confirm('Apakah Anda yakin ingin menyimpan perubahan?')">Save</button>

                        </div>
                    </form>

                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span>Edit
                            Portfolio</span><span class="border px-3 p-1 add-experience"><i
                                class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                    <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text"
                            class="form-control" placeholder="experience" value=""></div> <br>
                    <div class="col-md-12"><label class="labels">Additional Details</label><input type="text"
                            class="form-control" placeholder="additional details" value=""></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
    document.getElementById('editPhoto').addEventListener('change', function() {
        document.getElementById('savePhotoButton').style.display = 'block';
    });
    </script>



</body>

</html>