<?php 
include '../koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $toko = $_POST['toko'];
    $alamat = $_POST['alamat'];
    $tlp_hp = $_POST['tlp_hp'];

    $sql = "INSERT INTO toko (nama_toko, alamat, tlp_hp ) VALUES ('$toko', '$alamat', '$tlp_hp')";

    if (mysqli_query($koneksi, $sql)) {
        header("location:../toko.php");
    } else {
        echo "Error: " . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi ke database
    mysqli_close($koneksi);
}
?>