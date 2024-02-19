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

    // Setelah selesai, arahkan kembali ke halaman utama atau halaman yang sesuai
    if($result){
        header("location: ../pengguna.php");
        exit();
    }
    else{
        echo mysqli_error($koneksi); // Jika terjadi kesalahan, tampilkan pesan kesalahan
    }
} else {
    // Jika tidak ada data POST, arahkan kembali ke halaman edit
    if(isset($_GET['id'])) {
        $id = $_GET['id']; // Ambil nilai id dari URL
        header("location: ../edit_pengguna.php?id=$id");
        exit();
    } else {
        echo "ID tidak ditemukan"; // Tampilkan pesan jika id tidak ditemukan dalam URL
    }
}
?>
