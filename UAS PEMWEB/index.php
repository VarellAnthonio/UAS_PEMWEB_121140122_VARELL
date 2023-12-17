<?php
// Memulai atau melanjutkan sesi PHP
session_start();

// Memeriksa apakah variabel sesi 'username' belum diatur
if (!isset($_SESSION['username'])) {
    // Redirect pengguna ke halaman login.php jika belum masuk
    header("Location: login.php");
    exit(); // Menghentikan eksekusi lebih lanjut dari skrip
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Menyertakan file CSS untuk styling -->
    <title>Manajemen Anggota</title>
</head>
<body>
    <h2>Manajemen Anggota</h2>

    <!-- Formulir untuk menambahkan anggota baru -->
    <form id="myForm">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="status">Status Keanggotaan:</label>
        <select id="status" name="status">
            <option value="free">free</option>
            <option value="basic">basic</option>
            <option value="premium">premium</option>
        </select>
        <br>

        <label for="gender">Jenis Kelamin:</label>
        <select id="gender" name="gender">
            <option value="male">male</option>
            <option value="female">female</option>
            <option value="other">other</option>
        </select>
        <br>

        <button type="submit">Kirim</button>
    </form>

    <!-- Formulir untuk mencari anggota -->
    <form id="searchForm">
        <label for="search">Cari:</label>
        <input type="text" id="search" name="search">
        <button type="submit">Cari</button>
    </form>

    <!-- Tabel untuk menampilkan data anggota -->
    <table id="dataTable" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status Keanggotaan</th>
                <th>Jenis Kelamin</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- Tautan untuk keluar (mengakhiri sesi) -->
    <a href="logout.php">Logout</a> 

    <!-- Menyertakan file JavaScript untuk fungsionalitas sisi klien -->
    <script src="script.js"></script>
</body>
</html>
