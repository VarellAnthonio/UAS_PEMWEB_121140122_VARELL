<?php
// Informasi koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "admin";

// Membuat objek koneksi baru menggunakan mysqli
$conn = new mysqli($host, $user, $pass, $db);

// Memeriksa apakah koneksi berhasil
if ($conn->connect_error) {
    // Jika koneksi gagal, program akan dihentikan dan menampilkan pesan error
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
