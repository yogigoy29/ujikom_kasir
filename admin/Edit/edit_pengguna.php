<?php
include '../../koneksi.php';

session_start();

$id = $_GET['id']; // Ambil ID barang dari URL

$sql = "SELECT * FROM toko";
$result = mysqli_query($koneksi,$sql);

$sql1 = "SELECT * FROM produk_kategori";
$result1 = mysqli_query($koneksi,$sql1);

$sql2 = "SELECT * FROM user WHERE user_id='$id'";
$result2 = mysqli_query($koneksi,$sql2);
$result2 = mysqli_fetch_assoc($result2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Pengguna</h2>
        
        <form action="../../Proses/proses_edit_pengguna.php" method="post">
            <input type="number" name="user_id" value="<?php echo $id; ?>">
            
            <?php if ($result) { ?>
                <div class="form-group">
                    <label for="toko">Toko :</label>
                    <select class="form-control" name="toko_id" required>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['toko_id']; ?>"><?php echo $row['nama_toko']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            <?php } else { ?>
                <div class="alert alert-danger" role="alert">
                    Gagal mengambil data toko.
                </div>
            <?php } ?>

            <?php if($result2) { ?>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $result2["username"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $result2["email"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap:</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $result2["nama_lengkap"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $result2["alamat"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="role">Role :</label>
                    <select name="role" class="form-control" required>
                        <option value="">Pilih</option>
                        <option value="kasir">Kasir</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            <?php }?>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
    <!-- Bootstrap JS, jQuery, Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
