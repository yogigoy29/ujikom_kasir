<?php 
include '../koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $toko = $_POST['toko'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $namalengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $role = $_POST['role'];

    $sql = "INSERT INTO user (user_id, toko_id,username, password, email, nama_lengkap, alamat, role) VALUES ('$user_id','$toko', '$username', '$hashed_password', '$email', '$namalengkap', '$alamat', '$role')";

    if (mysqli_query($koneksi, $sql)) {
        header("location:../pengguna.php");
    } else {
        echo "Error: "  . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi ke database
    mysqli_close($koneksi);
}
?>