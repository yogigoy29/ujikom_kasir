<?php 
include '../koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $toko = $_POST['toko'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat_pelanggan = $_POST['alamat_pelanggan'];
    $no_hp = $_POST['no_hp'];

    $sql = "INSERT INTO pelanggan (toko_id, nama_pelanggan, alamat, no_hp ) VALUES ('$toko', '$nama_pelanggan', '$alamat_pelanggan', '$no_hp')";

    if (mysqli_query($koneksi, $sql)) {
        header("location:../pelanggan.php");
    } else {
        echo "Error: " . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi ke database
    mysqli_close($koneksi);
}
?>