<?php
include '../koneksi.php';

session_start();

$id = $_GET['id']; // Ambil ID barang dari URL

$sql = "SELECT * FROM toko WHERE toko_id = '$id'";
$result = mysqli_query($koneksi,$sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Toko</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Toko</h2>
        <?php
        // Ambil data barang dari database (misalnya)
        
        // Lakukan koneksi ke database dan ambil data barang dengan ID tertentu
        
        ?>
        <form action="../proses/proses_edit_toko.php?id=<?php echo $id ?>" method="post">
            
        <?php
        $data = mysqli_fetch_assoc($result);
        ?>
            <input type="hidden" name="toko_id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="toko">Toko:</label>
                <input type="text" class="form-control" id="toko" name="toko" value="<?php echo $data['nama_toko']; ?>" required>
            </div>
        
            <div class="form-group">
                <label for="alamat">alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $data['alamat']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tlp_hp">TLP HP:</label>
                <input type="number" class="form-control" id="tlp_hp" name="tlp_hp" value="<?php echo $data['tlp_hp']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
    <!-- Bootstrap JS, jQuery, Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
