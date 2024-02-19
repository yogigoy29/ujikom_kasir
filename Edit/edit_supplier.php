<?php
include '../koneksi.php';

session_start();

$id = $_GET['id']; // Ambil ID barang dari URL

$sql = "SELECT * FROM suplier WHERE suplier_id = '$id'";
$result = mysqli_query($koneksi,$sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Supplier</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Supllier</h2>
        <?php
        // Ambil data barang dari database (misalnya)
        
        // Lakukan koneksi ke database dan ambil data barang dengan ID tertentu
        
        ?>
        <form action="../proses/proses_edit_supplier.php?id=<?php echo $id ?>" method="post">
            
        <?php
        $data = mysqli_fetch_assoc($result);
        ?>
            <input type="hidden" name="suplier_id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="nama_suplier">Nama Suplier:</label>
                <input type="text" class="form-control" id="nama_suplier" name="nama_suplier" value="<?php echo $data['nama_suplier']; ?>" required>
            </div>
        
            <div class="form-group">
                <label for="alamat">alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $data['alamat_suplier']; ?>" required>
            </div>

           
            <div class="form-group">
                <label for="alamat">Toko id:</label>
                <input type="text" class="form-control" id="alamat" name="toko_id" value="<?php echo $data['toko_id']; ?>" required>
            </div>
            <div class="form-group">
                <label for="no_hp">NO HP:</label>
                <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?php echo $data['no_hp']; ?>" required>
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
