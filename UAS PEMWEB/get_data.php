<?php
// Memerlukan file koneksi.php untuk mendapatkan koneksi ke database
require_once 'koneksi.php';

// Menyiapkan query SQL untuk memilih semua data dari tabel 'user'
$sql = "SELECT * FROM user";

// Menjalankan query dan menyimpan hasilnya dalam variabel $result
$result = $connection->query($sql);

// Inisialisasi array $data untuk menyimpan data hasil query
$data = [];

// Memeriksa apakah ada lebih dari 0 baris hasil dari query
if ($result->num_rows > 0) {
    // Iterasi melalui setiap baris hasil query dan menyimpannya dalam array $data
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Mengonversi array $data menjadi format JSON dan mencetaknya
echo json_encode($data);

// Menutup koneksi ke database setelah selesai menggunakan
$connection->close();
?>
