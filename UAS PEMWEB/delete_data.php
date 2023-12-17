<?php
// Memerlukan file koneksi.php untuk mendapatkan koneksi ke database
require_once 'koneksi.php';

// Memeriksa apakah permintaan adalah metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Mengamankan data yang diterima dari formulir menggunakan fungsi mysqli_real_escape_string
    $idToDelete = mysqli_real_escape_string($connection, $_POST["id"]);

    // Menyiapkan query SQL untuk menghapus record dari tabel 'user' berdasarkan ID
    $sql = "DELETE FROM user WHERE id=$idToDelete";

    // Menjalankan query dan memeriksa apakah berhasil atau tidak
    if ($connection->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        // Menampilkan pesan error jika query tidak berhasil dieksekusi
        echo "Error deleting record: " . $connection->error;
    }
}

// Menutup koneksi ke database setelah selesai menggunakan
$connection->close();
?>
