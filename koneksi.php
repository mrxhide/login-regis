<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loginregis";

// Membuat koneksi
$conn = mysqli_connect('localhost', 'root', '', 'loginregis');

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>
