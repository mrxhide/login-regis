<?php
// Inisialisasi session
session_start();

// Menghapus semua session
session_unset();
session_destroy();

// Redirect ke halaman login
header('Location: login.php');
exit();
?>
