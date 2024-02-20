<?php
include "../koneksi.php";
// Lakukan proses edit data barang di sini
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = $_POST['suplier_id'] ;
    $toko_id = $_POST["toko_id"];
    $nama_supplier = $_POST["nama_suplier"];
    $alamat = $_POST["alamat"];
   
    $tlp_hp = $_POST["no_hp"];
    
    $sql = "UPDATE suplier SET   nama_suplier = '$nama_supplier', alamat_suplier = '$alamat', tlp_hp = '$tlp_hp',toko_id='$toko_id' WHERE suplier_id = '$user'";
    $result = mysqli_query($koneksi, $sql);

    //var_dump($koneksi);
    // Lakukan proses penyimpanan ke database (misalnya)

    // Setelah selesai, arahkan kembali ke halaman utama atau halaman yang sesuai
    if(!$result){
       var_dump($koneksi);
    }
    else{
        header("location: ../admin/supplier.php");
        //var_dump($koneksi);
    }
    exit();
} else {
    // Jika tidak ada data POST, arahkan kembali ke halaman edit
    header("location: ../edit_supplier.php");
    exit();
}
?>
