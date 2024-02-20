<?php 
include '../koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $toko = $_POST['toko'];
    $nama_supplier = $_POST['nama_supplier'];
    $alamat_supplier = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $sql = "INSERT INTO suplier (toko_id, nama_suplier, alamat_suplier, tlp_hp ) VALUES ('$toko', '$nama_supplier', '$alamat_supplier', '$no_hp')";

    if (mysqli_query($koneksi, $sql)) {
        header("location:../admin/supplier.php");
    } else {
        echo "Error: " . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi ke database
    mysqli_close($koneksi);
}
?>