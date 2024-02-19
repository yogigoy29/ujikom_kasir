<?php
include '../koneksi.php'; // Sertakan file koneksi ke database

// Tangkap data yang dikirimkan dari formulir
$tanggal_pembelian = $_POST['tanggal_pembelian'];
$suplier_id = $_POST['suplier_id'];
$total = $_POST['total'];

// Buat query untuk memasukkan data pembelian ke dalam tabel pembelian
$query = "INSERT INTO pembelian (toko_id, user_id, tanggal_pembelian, suplier_id, total) 
          VALUES (1, 1, '$tanggal_pembelian', $suplier_id, $total)";

// Jalankan query
$result = mysqli_query($koneksi, $query);

if ($result) {
    // Jika query berhasil dijalankan, arahkan kembali ke halaman utama atau halaman sukses
    header('Location: index.php');
    exit;
} else {
    // Jika query gagal dijalankan, tampilkan pesan kesalahan
    echo "Gagal menambahkan pembelian: " . mysqli_error($koneksi);
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
