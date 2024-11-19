<?php
// Inisialisasi session
session_start();

// Mengecek username pada session
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini!';
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Navbar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        .navbar-custom {
            background-color: #333; /* Warna gelap */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #f8f9fa; /* Warna teks putih */
            font-weight: bold;
        }
        .navbar-custom .nav-link:hover {
            color: #ddd; /* Warna teks saat hover */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">HOME</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid bg-light" style="height:90vh;">
        <div class="container text-center">
            <h1 class="display-4 text-center mt-4">HOME</h1>
            <p class="lead text-center">LOGIN OR REGISTER SUCCESSFULLY :)</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>

