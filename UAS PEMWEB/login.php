<?php
// Memulai atau melanjutkan sesi PHP
session_start();

// Memerlukan file konfigurasi (config.php) yang mungkin berisi informasi koneksi ke database
require_once('config.php');

// Memeriksa apakah permintaan adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data username dan password dari formulir login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Membuat query SQL untuk mencari pengguna dengan username dan password yang sesuai
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    
    // Menjalankan query dan menyimpan hasilnya dalam variabel $result
    $result = $conn->query($sql);

    // Memeriksa apakah ada satu baris hasil dari query, menandakan login berhasil
    if ($result->num_rows == 1) {
        // Login berhasil, mengatur variabel sesi 'username' dan mengarahkan ke halaman index.php
        $_SESSION['username'] = $username;
        header("Location: index.php"); 
    } else {
        // Login gagal, mengatur pesan error
        $error = "Username atau password salah.";
    }
}

// Menutup koneksi ke database
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Gaya CSS untuk halaman login */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: #ff0000;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Formulir untuk login -->
    <form method="post" action="">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>

    <!-- Menampilkan pesan error jika login gagal -->
    <?php if (isset($error)) { echo '<div class="error">' . $error . '</div>'; } ?>

</body>
</html>

