// Event listener yang akan dieksekusi saat halaman selesai dimuat
window.addEventListener('load', function () {
    // Memanggil fungsi fetchData untuk mengambil data dari server
    fetchData();

    // Menangani submit formulir dengan ID 'myForm'
    document.getElementById('myForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Mencegah pengiriman formulir secara default

        // Memanggil fungsi validateForm untuk memastikan formulir valid sebelum mengirim
        if (validateForm()) {
            submitForm(); // Jika formulir valid, kirim data ke server
        }
    });

    // Menangani submit formulir pencarian dengan ID 'searchForm'
    document.getElementById('searchForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Mencegah pengiriman formulir secara default
        search(); // Memanggil fungsi search untuk melakukan pencarian data
    });
});

// Fungsi untuk mengambil data dari server menggunakan fetch API
function fetchData() {
    // Menggunakan fetch untuk mengambil data dari server melalui get_data.php
    fetch('get_data.php')
        .then(response => response.json())
        .then(data => {
            // Memanggil fungsi displayData untuk menampilkan data di halaman
            displayData(data);
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fungsi untuk menampilkan data di tabel
function displayData(data) {
    const tableBody = document.querySelector('#dataTable tbody');
    tableBody.innerHTML = ''; // Mengosongkan isi tabel sebelum menambahkan data baru

    data.forEach(item => {
        // Membuat baris baru di tabel
        const row = tableBody.insertRow(-1);

        // Menambahkan sel-sel ke dalam baris
        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        const cell3 = row.insertCell(2);
        const cell4 = row.insertCell(3);
        const cell5 = row.insertCell(4);
        const actionsCell = row.insertCell(5);

        // Mengisi nilai sel-sel dengan data dari server
        cell1.textContent = item.id;
        cell2.textContent = item.name;
        cell3.textContent = item.email;
        cell4.textContent = item.status;
        cell5.textContent = item.gender;

        // Membuat tombol 'Update'
        const updateButton = document.createElement('button');
        updateButton.textContent = 'Update';
        updateButton.className = 'update'; 
        updateButton.addEventListener('click', function () {
            // Menampilkan prompt untuk memasukkan nama baru
            const newName = prompt('Enter the new name:', item.name);
            if (newName !== null) {
                // Memanggil fungsi updateData untuk mengirim permintaan update ke server
                updateData(item.id, newName);
            }
        });
        actionsCell.appendChild(updateButton);

        // Membuat tombol 'Delete'
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.className = 'delete'; 
        deleteButton.addEventListener('click', function () {
            // Memanggil fungsi deleteData untuk mengirim permintaan delete ke server
            deleteData(item.id);
        });
        actionsCell.appendChild(deleteButton);
    });
}

// Fungsi untuk mengirim permintaan update data ke server
function updateData(id, newName) {
    // Menggunakan fetch untuk mengirim permintaan update_data.php
    fetch('update_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}&newName=${newName}`,
    })
        .then(response => response.text())
        .then(message => {
            console.log(message);
            fetchData(); // Memanggil fetchData untuk mengambil data terbaru dari server
        })
        .catch(error => console.error('Error updating data:', error));
}

// Fungsi untuk mengirim permintaan delete data ke server
function deleteData(id) {
    // Menggunakan fetch untuk mengirim permintaan delete_data.php
    fetch('delete_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}`,
    })
        .then(response => response.text())
        .then(message => {
            console.log(message);
            fetchData(); // Memanggil fetchData untuk mengambil data terbaru dari server
        })
        .catch(error => console.error('Error deleting data:', error));
}

// Fungsi untuk mengirim permintaan tambah data ke server
function submitForm() {
    // Mendapatkan referensi ke formulir dengan ID 'myForm'
    const form = document.getElementById('myForm');
    const formData = new FormData(form); // Membuat objek FormData untuk mengirim data formulir

    // Menggunakan fetch untuk mengirim permintaan add_data.php
    fetch('add_data.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.text())
        .then(message => {
            console.log(message);
            fetchData(); // Memanggil fetchData untuk mengambil data terbaru dari server
            form.reset(); // Mereset formulir setelah pengiriman data
        })
        .catch(error => console.error('Error submitting form:', error));
}

// Fungsi untuk melakukan pencarian data
function search() {
    // Mendapatkan nilai dari input pencarian dengan ID 'search'
    const searchInput = document.getElementById('search');
    const searchTerm = searchInput.value.trim(); // Menghapus spasi di awal dan akhir string

    // Jika nilai pencarian tidak kosong, kirim permintaan pencarian ke server
    if (searchTerm !== '') {
        fetch('search_data.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `search=${searchTerm}`,
        })
            .then(response => response.json())
            .then(data => {
                // Memanggil fungsi displayData untuk menampilkan hasil pencarian
                displayData(data);
            })
            .catch(error => console.error('Error searching data:', error));
    } else {
        fetchData(); // Jika nilai pencarian kosong, ambil semua data dari server
    }
}

// Fungsi untuk validasi formulir
function validateForm() {
    // Mendapatkan referensi ke input nama dengan ID 'name'
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');

    // Memeriksa apakah nilai input nama dan email tidak kosong
    if (nameInput.value.trim() === '' || emailInput.value.trim() === '') {
        alert('Name and email are required!'); // Menampilkan pesan peringatan
        return false; // Mengembalikan false untuk menghentikan pengiriman formulir
    }

    return true; // Mengembalikan true jika formulir valid
}
