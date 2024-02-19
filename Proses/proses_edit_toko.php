<?php
include "../koneksi.php";
// Lakukan proses edit data barang di sini
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $toko = $_POST["toko_id"];
    $nama_toko = $_POST["toko"];
    $alamat = $_POST["alamat"];
    $tlp_hp = $_POST["tlp_hp"];
    
    $sql = "UPDATE toko SET  toko_id = '$toko', nama_toko = '$nama_toko', alamat = '$alamat', tlp_hp = '$tlp_hp' WHERE toko_id = '$toko'";
    $result = mysqli_query($koneksi, $sql);

    if(!$result){
      // var_dump($koneksi);
    }
    else{
        header("location: ../toko.php");
        //var_dump($koneksi);
    }
    exit();
} else {
    // Jika tidak ada data POST, arahkan kembali ke halaman edit
    header("location: ../edit_toko.php");
    exit();
}
?>
