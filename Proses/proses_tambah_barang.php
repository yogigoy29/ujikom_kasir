<?php 
include '../koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $toko = $_POST['toko'];
    $kategori = $_POST['kategori'];
    $satuan = $_POST['satuan'];
    $produk = $_POST['nama_produk'];
    $stok = $_POST['stok'];
    $harga_jual = $_POST['harga_jual'];

    $sql = "INSERT INTO produk (toko_id, nama_produk, kategori_id, stok, harga_jual,satuan) VALUES ('$toko', '$produk', '$kategori', '$stok', '$harga_jual','$satuan')";

    if (mysqli_query($koneksi, $sql)) {
        header("location: ../admin/list_produk.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi ke database
    mysqli_close($koneksi);
}
?>