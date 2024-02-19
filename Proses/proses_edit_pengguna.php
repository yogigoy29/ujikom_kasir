<?php
include "../koneksi.php";
// Lakukan proses edit data barang di sini
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pengguna = $_POST['user_id'];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $nama_lengkap = $_POST["nama_lengkap"];
    $alamat = $_POST["alamat"];
    $role = $_POST["role"];

    $sql = "UPDATE user SET  username = '$username', password = '$password', email = '$email', nama_lengkap = '$nama_lengkap', alamat = '$alamat',role='$role'  WHERE user_id = '$pengguna'";
    $result = mysqli_query($koneksi, $sql);
    //var_dump($koneksi);
    // Lakukan proses penyimpanan ke database (misalnya)

    // Setelah selesai, arahkan kembali ke halaman utama atau halaman yang sesuai
    if($result){
        //var_dump($result);
        //header("location: ../pengguna.php");
        //echo $pengguna;
    }
    else{
        mysqli_error($koneksi);

    }
    exit();
} else {
    // Jika tidak ada data POST, arahkan kembali ke halaman edit
    header("location: ../edit_pengguna.php?id=$id");
    exit();
}
?>
