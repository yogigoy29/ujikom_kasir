<?php 
include '../koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $kategori = $_POST['kategori'];


    $sql = "INSERT INTO produk_kategori (nama_kategori) VALUES ('$kategori')";

    if (mysqli_query($koneksi, $sql)) {
        header("location:../admin/kategori.php");
    } else {
        echo "Error: " . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi ke database
    mysqli_close($koneksi);
}
?>