<?php
// Memasukkan file koneksi.php untuk menghubungkan ke database
require_once 'koneksi.php';

// Memeriksa apakah permintaan yang diterima adalah metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Mengamankan nilai pencarian dari inputan pengguna
    $searchTerm = mysqli_real_escape_string($connection, $_POST["search"]);

    // Membuat query SQL untuk mencari data pengguna berdasarkan nama atau email yang cocok dengan nilai pencarian
    $sql = "SELECT * FROM user WHERE name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%'";

    // Menjalankan query ke database
    $result = $connection->query($sql);

    // Menyiapkan array untuk menyimpan hasil pencarian
    $data = [];

    // Memeriksa apakah ada hasil dari query
    if ($result->num_rows > 0) {
        // Mengambil setiap baris hasil query dan menyimpannya ke dalam array $data
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Mengembalikan hasil pencarian dalam format JSON ke sisi klien
    echo json_encode($data);
}

// Menutup koneksi ke database
$connection->close();
?>
