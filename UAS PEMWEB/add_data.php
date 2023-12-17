<?php
// Mengimpor file koneksi.php untuk mendapatkan koneksi ke database
require_once 'koneksi.php';

// Memeriksa apakah permintaan adalah metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Mengamankan data yang diterima dari formulir menggunakan fungsi mysqli_real_escape_string
    $name = mysqli_real_escape_string($connection, $_POST["name"]);
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $status = mysqli_real_escape_string($connection, $_POST["status"]);
    $gender = mysqli_real_escape_string($connection, $_POST["gender"]);

    // Mendapatkan informasi tentang browser pengguna dari header HTTP_USER_AGENT
    $browser = mysqli_real_escape_string($connection, $_SERVER["HTTP_USER_AGENT"]);

    // Mendapatkan alamat IP dari pengguna
    $ipAddress = mysqli_real_escape_string($connection, $_SERVER["REMOTE_ADDR"]);

    // Menyiapkan query SQL untuk memasukkan data ke dalam tabel 'user'
    $sql = "INSERT INTO user (name, email, status, gender, browser, ip_address) VALUES ('$name', '$email', '$status', '$gender', '$browser', '$ipAddress')";

    // Menjalankan query dan memeriksa apakah berhasil atau tidak
    if ($connection->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        // Menampilkan pesan error jika query tidak berhasil dieksekusi
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Menutup koneksi ke database setelah selesai menggunakan
$connection->close();
?>
