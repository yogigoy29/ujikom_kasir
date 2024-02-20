<?php
include "../koneksi.php";
// Lakukan proses edit data barang di sini
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = $_POST['pelanggan_id'] ;
    $toko_id = $_POST["toko_id"];
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $alamat = $_POST["alamat"];
    $no_hp = $_POST["no_hp"];
    $updateSql = mysqli_query($koneksi,"UPDATE pelanggan SET toko_id = '$toko_id', nama_pelanggan = '$nama_pelanggan', alamat = '$alamat', no_hp = '$no_hp' WHERE pelanggan_id = '$user'");

    //var_dump($koneksi);
    // Lakukan proses penyimpanan ke database (misalnya)

    // Setelah selesai, arahkan kembali ke halaman utama atau halaman yang sesuai
    if(!$updateSql){
       // var_dump($koneksi);
    }
    else{
        header("location: ../admin/pelanggan.php");
        //var_dump($koneksi);
    }
    exit();
} else {
    // Jika tidak ada data POST, arahkan kembali ke halaman edit
    header("location: ../edit_barang.php?id=$id");
    exit();
}
?>
