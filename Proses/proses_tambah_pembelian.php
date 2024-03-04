<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir POST
    $tokoId = $_POST['tokoId'];
    $userId = $_POST['userId'];
    $noFaktur = $_POST['noFaktur'];
    $tanggalPembelian = $_POST['tanggalPembelian'];
    $suplierId = $_POST['suplierId'];
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $sisa = $_POST['sisa'];
    $keterangan = $_POST['keterangan'];
    $createdAt = $_POST['createdAt'];

    // Periksa apakah nilai total, bayar, dan sisa tidak kosong
    if (!empty($total) && !empty($bayar) && !empty($sisa)) {
        // Lakukan koneksi ke database
        $mysqli = new mysqli("localhost", "root", "", "ujikom_kasir");

        // Periksa koneksi
        if ($mysqli->connect_error) {
            die("Koneksi database gagal: " . $mysqli->connect_error);
        }

        // Query SQL untuk menyimpan data ke tabel pembelian
        $query = "INSERT INTO pembelian (toko_id, user_id, no_faktur, tanggal_pembelian, suplier_id, total, bayar, sisa, keterangan, created_at)
                  VALUES ('$tokoId', '$userId', '$noFaktur', '$tanggalPembelian', '$suplierId', '$total', '$bayar', '$sisa', '$keterangan', '$createdAt')";

        if ($mysqli->query($query) === TRUE) {
            // Redirect ke halaman lain atau berikan respons sesuai kebutuhan
            header("Location: ../admin/Transaksi/detail_pembelian.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . $mysqli->error;
            // Tambahkan pernyataan ini untuk memastikan kode dijalankan
            die("Penyimpanan data gagal.");
        }

        // Tutup koneksi database
        $mysqli->close();
    } else {
        // Tampilkan pesan kesalahan jika nilai total, bayar, atau sisa kosong
        echo "Error: Nilai total, bayar, atau sisa tidak boleh kosong.";
    }
} else {
    // Tampilkan pesan kesalahan jika tidak ada data POST yang dikirimkan
    echo "Error: Tidak ada data POST yang dikirimkan.";
}
?>
