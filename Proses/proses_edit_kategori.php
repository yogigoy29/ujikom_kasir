<?php
include "../koneksi.php";
// Lakukan proses edit data barang di sini
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama_kategori = $_POST["nama_kategori"];
    
    $sql = "UPDATE produk_kategori SET nama_kategori = '$nama_kategori' WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql);

    if(!$result){
      // var_dump($koneksi);
    }
    else{
        header("location: ../kategori.php");
        //var_dump($koneksi);
    }
    exit();
} else {
    exit();
    // Jika tidak ada data POST, arahkan kembali ke halaman edit
    // header("location: ../edit_kategori.php");
}
?>
