<?php
// Memasukkan file koneksi.php untuk menghubungkan ke database
require_once 'koneksi.php';

// Memeriksa apakah permintaan yang diterima adalah metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Mengamankan nilai ID dan nama baru dari inputan pengguna
    $idToUpdate = mysqli_real_escape_string($connection, $_POST["id"]);
    $newName = mysqli_real_escape_string($connection, $_POST["newName"]);

    // Membuat query SQL untuk mengupdate nama pengguna berdasarkan ID
    $sql = "UPDATE user SET name='$newName' WHERE id=$idToUpdate";

    // Menjalankan query ke database
    if ($connection->query($sql) === TRUE) {
        // Jika query berhasil, mengirimkan pesan sukses ke sisi klien
        echo "Record updated successfully";
    } else {
        // Jika terjadi kesalahan, mengirimkan pesan error beserta detailnya ke sisi klien
        echo "Error updating record: " . $connection->error;
    }
}

// Menutup koneksi ke database
$connection->close();
?>
