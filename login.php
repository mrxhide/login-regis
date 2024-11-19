<?php
// menyertakan file program koneksi.php pada register
require('koneksi.php');

// inisialisasi session
session_start();
$error = '';
$validate = '';

// mengecek apakah session username tersedia atau tidak
// jika tidak tersedia maka akan di-redirect ke halaman index
if (isset($_SESSION['username'])) header('Location: index.php');

// mengecek apakah form disubmit atau tidak
if (isset($_POST['submit'])) {
    // menghilangkan backslashes
    $username = stripslashes($_POST['username']);
    // cara sederhana menyamankan data di input SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($_POST['password']);
    // menghilangkan backslashes
    $password = mysqli_real_escape_string($conn, $password);

    // cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
    if (!empty(trim($username)) && !empty(trim($password))) {
        // select data berdasarkan username dari database
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);

        if ($rows != 0) {
            $hash = mysqli_fetch_assoc($result)['password'];
            if (password_verify($password, $hash)) {
                $_SESSION['username'] = $username;
                header('Location: index.php');
            } else {
                $error = 'Register User Gagal !!!';
            }
        } else {
            $error = 'Username atau password salah';
        }
    } else {
        $error = 'Data tidak boleh kosong !!!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SmA13dDnOfnlgLCVffAzClf5J8xU3zJZf2KzBIB4gSGVoYaKtM5FQK6UIM" crossorigin="anonymous">
    <style>
    body {
        background-color: #f8f9fa; /* Background putih terang */
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }

    .login-container {
        width: 100%;
        max-width: 400px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        text-align: center;
        padding: 20px;
        font-size: 24px;
        font-weight: bold;
        border-radius: 10px 10px 0 0;
    }

    .card-body {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 20px; /* Menambahkan jarak antar form group */
    }

    .form-group label {
        font-size: 14px;
        font-weight: bold;
        color: #333;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
        font-size: 14px;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 15px; /* Mengurangi ukuran tombol */
        font-size: 14px; /* Ukuran font lebih kecil */
        font-weight: bold;
        width: 100%; /* Membuat tombol memanjang */
        transition: background-color 0.3s ease-in-out;
        margin-top: 20px; /* Menambahkan jarak antara input dan tombol */
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .register-link {
        color: #007bff;
        font-weight: bold;
        text-decoration: none;
    }

    .register-link:hover {
        text-decoration: underline;
    }

    .alert {
        border-radius: 8px;
    }
</style>

</head>

<body>
    <div class="login-container">
        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="login.php" method="POST" class="login-form">
                    <?php if ($error != '') { ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Enter your username">
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-control" id="InputPassword" name="password"
                            placeholder="Enter your password">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
                    <p class="text-center mt-3">Belum Punya Akun? <a href="register.php" class="register-link">Sign
                            up</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abk41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBkEIBfTl1lGqZ7DMEKxtMC6Pi6jW1CJjIB66jTK" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>


