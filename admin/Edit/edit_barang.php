<?php
include '../../koneksi.php';

session_start();

$id = $_GET['id']; // Ambil ID barang dari URL

$sql = "SELECT * FROM toko";
$result = mysqli_query($koneksi,$sql);

$sql1 = "SELECT * FROM produk_kategori";
$result1 = mysqli_query($koneksi,$sql1);

$sql2 = "SELECT * FROM produk WHERE produk_id='$id'";
$result2 = mysqli_query($koneksi,$sql2);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Barang</h2>
        <?php
        // Ambil data barang dari database (misalnya)
        
        // Lakukan koneksi ke database dan ambil data barang dengan ID tertentu
        
        ?>
        <form action="../../Proses/proses_edit_barang.php?id=<?php echo $id ?>" method="post">
             <?php
            if ($result) {
                echo "<label for='toko'>Toko :</label>";
                echo "<select class='form-control' name='toko_id' required>";

                while ($row = mysqli_fetch_assoc($result)) {
                    $nama_toko = $row['nama_toko'];
                    $toko_id = $row['toko_id'];
                    echo "<option value='$toko_id'>$nama_toko</option>";
                    }

                    echo "</select>";
                } else {
                    echo "Gagal mengambil data";
                }
        ?>
             <?php
            if ($result1) {
                echo "<label for='kategori'>Kategori :</label>";
                echo "<select class='form-control' name='kategori' required>";

                while ($riw = mysqli_fetch_assoc($result1)) {
                    $nama_kategori = $riw['nama_kategori'];
                    $id = $riw['id'];
                    echo "<option value='$id'>$nama_kategori</option>";
                    }

                    echo "</select>";
                } else {
                    echo "Gagal mengambil data";
                }
        ?>
        <?php
        $data = mysqli_fetch_assoc($result2);
        ?>
            <input type="hidden" name="id" value="<?php echo $id_barang; ?>">
            <div class="form-group">
                <label for="nama_produk">Nama Produk:</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $data['nama_produk']; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga_beli">Harga Beli:</label>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="<?php echo $data['harga_beli']; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga_jual">Harga Jual:</label>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="<?php echo $data['harga_jual']; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga_jual">Satuan:</label>
                <input type="number" class="form-control" id="satuan" name="satuan" value="<?php echo $data['Satuan']; ?>" required>
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
