<?php
session_start();

// Hapus sesi admin dan redirect ke halaman login
unset($_SESSION['user_id']);
header("Location: index.php");
?>