<?php
require('koneksi.php');
session_start();
$error = '';

if (isset($_POST['submit'])) {
    $name = stripslashes($_POST['name']);
    $name = mysqli_real_escape_string($conn, $name);
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    $confirm_password = stripslashes($_POST['confirm_password']);
    $confirm_password = mysqli_real_escape_string($conn, $confirm_password);

    if (!empty(trim($name)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($confirm_password))) {
        if ($password == $confirm_password) {
            $query = "SELECT * FROM user WHERE username = '$username'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 0) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Menyimpan data ke database
                $query = "INSERT INTO user (name, username, email, password) VALUES ('$name', '$username', '$email', '$hashed_password')";
                if (mysqli_query($conn, $query)) {
                    header('Location: login.php');
                    exit();
                } else {
                    // Menampilkan error jika query gagal
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                $error = 'Username sudah terdaftar.';
            }
        } else {
            $error = 'Password dan konfirmasi password tidak cocok.';
        }
    } else {
        $error = 'Semua kolom harus diisi.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SmA13dDnOfnlgLCVffAzClf5J8xU3zJZf2KzBIB4gSGVoYaKtM5FQK6UIM" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .card {
            width: 100%;
            max-width: 450px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 15px; /* Mengatur jarak antar form group */
        }

        .form-control {
            border-radius: 8px;
            font-size: 14px;
            width: 100%;
        }

        label {
            font-size: 16px;
            font-weight: bold;
        }

        .btn-primary {
            width: 100%;
            border-radius: 8px;
            margin-top: 20px;
            background-color: #007bff;
            color: #f8f9fa;
            border: none;
            font-size: 16px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .text-center a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">Sign-Up</div>
        <div class="card-body">
            <!-- Menampilkan pesan error -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error; ?>
                </div>
            <?php endif; ?>

            <!-- Form registrasi -->
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" required>
                </div>
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Re-Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-Password" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Register</button>
                <div class="text-center mt-3">
                    <p>Sudah punya account? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
