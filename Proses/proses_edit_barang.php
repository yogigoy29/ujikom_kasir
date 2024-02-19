<?php
include "../koneksi.php";
// Lakukan proses edit data barang di sini
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = $_GET['id'] ;
    $toko_id = $_POST["toko_id"];
    $nama_produk = $_POST["nama_produk"];
    $kategori = $_POST["kategori"];
    $harga_beli = $_POST["harga_beli"];
    $harga_jual = $_POST["harga_jual"];
    $satuan = $_POST['satuan'];
    $updateSql = mysqli_query($koneksi,"UPDATE produk SET toko_id = '$toko_id', nama_produk = '$nama_produk', kategori_id = '$kategori', harga_beli = '$harga_beli', harga_jual = '$harga_jual',satuan='$satuan'  WHERE produk_id = '$user'");

    //var_dump($koneksi);
    // Lakukan proses penyimpanan ke database (misalnya)

    // Setelah selesai, arahkan kembali ke halaman utama atau halaman yang sesuai
    if(!$updateSql){
        echo mysqli_error();
    }
    else{
        header("location: ../list_produk.php");

    }
    exit();
} else {
    // Jika tidak ada data POST, arahkan kembali ke halaman edit
    header("location: ../edit_barang.php?id=$id");
    exit();
}
?>
