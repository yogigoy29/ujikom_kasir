<?php
include '../../koneksi.php';
$sql = "SELECT * FROM toko";
$result = mysqli_query($koneksi, $sql);
$result = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM user";
$result1 = mysqli_query($koneksi, $sql);
$sql = "SELECT * FROM pelanggan";
$result2 = mysqli_query($koneksi, $sql);
$sql = "SELECT * FROM produk";
$result3 = mysqli_query($koneksi, $sql);


session_start();
if ($_SESSION["username"]){
    $username = $_SESSION["username"];
    $id_user = $_SESSION["user_id"];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $toko_id = $_POST["toko_id"];
    $user_id = $_POST["user_id"];
    $total = $_POST["total"];
    $pelanggan = isset($_POST["pelanggan_id"]) ? $_POST["pelanggan_id"] : 0;
    $bayar = $_POST["bayar"];
    $sisa = $_POST["sisa"];
    $keterangan = $_POST["keterangan"];
    $create = date("Y-m-d H:i:s");
    $tanggal_penjualan = date("Y-m-d H:i:s");

    // Retrieve selected product IDs
    if (isset($_POST['barang']) && is_array($_POST['barang'])) {
        $selected_products = $_POST['barang'];
    
        // Koneksi ke database menggunakan MySQLi
        $mysqli = new mysqli("localhost", "root", "", "ujikom_kasir");
    
        // Periksa koneksi
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
    
        // Inisialisasi statement update di luar loop foreach
        $stmt_update = $mysqli->prepare("UPDATE produk SET stok = stok - ? WHERE produk_id = ?");
    
        foreach ($selected_products as $produk_info) {
            // Memisahkan nilai ID barang dan qty
            list($produk_id, $qty) = explode('|', $produk_info);
    
            // Eksekusi statement update di dalam loop
            $stmt_update->bind_param("ii", $qty, $produk_id);
            $stmt_update->execute();
    
            // Periksa apakah query berhasil dieksekusi
            if ($stmt_update->affected_rows <= 0) {
                echo "Gagal memperbarui stok untuk produk dengan ID $produk_id";
            }
        }
    
        // Tutup statement dan koneksi
        $stmt_update->close();
        $mysqli->close();
    } else {
        echo "No products selected.";
    }
    

    // Simpan data ke database menggunakan PDO
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ujikom_kasir", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Memulai transaksi
        $pdo->beginTransaction();

        // Memasukkan data penjualan ke tabel penjualan
        $sql = "INSERT INTO penjualan (toko_id, user_id, tanggal_penjualan, pelanggan_id, total, bayar, sisa, keterangan, created_at)
                VALUES (:toko_id, :user_id, :tanggal_penjualan, :pelanggan_id, :total, :bayar, :sisa, :keterangan, :created_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':toko_id' => $toko_id,
            ':user_id' => $user_id,
            ':tanggal_penjualan' => $tanggal_penjualan,
            ':pelanggan_id' => $pelanggan,
            ':total' => $total,
            ':bayar' => $bayar,
            ':sisa' => $sisa,
            ':keterangan' => $keterangan,
            ':created_at' => $create
        ));

        // Mendapatkan id penjualan dari baris yang dimasukkan
        $penjualan_id = $pdo->lastInsertId();

        // Memasukkan data detail penjualan ke tabel penjualan_detail
        if(isset($_POST['barang'])) {
            foreach($_POST['barang'] as $produk_id) {
                list($produk, $qtys) = explode('|', $produk_id);
                $produk_id = $produk;
                $qty = $qtys; // Mengambil nilai qty dari form
                $harga_beli = $_POST["harga_beli$produk_id"]; // Mengambil nilai harga beli dari form
        
                // Menggunakan prepared statement untuk mengambil harga_jual dari database
                $query_harga_jual = "SELECT harga_jual FROM produk WHERE produk_id = :produk_id";
                $stmt_harga_jual = $pdo->prepare($query_harga_jual);
                $stmt_harga_jual->bindParam(':produk_id', $produk_id, PDO::PARAM_INT);
                $stmt_harga_jual->execute();
        
                // Mengambil hasil query
                $harga_jual_result = $stmt_harga_jual->fetch(PDO::FETCH_ASSOC);
        
                if ($harga_jual_result) {
                    $harga_jual = $qty * $harga_jual_result['harga_jual'];
        
                    // Lakukan INSERT ke tabel penjualan_detail
                    $sql = "INSERT INTO penjual_detail (penjual_id, produk_id, qty, harga_beli, harga_jual, created_at)
                            VALUES (:penjualan_id, :produk_id, :qty, :harga_beli, :harga_jual, :created_at)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        ':penjualan_id' => $penjualan_id,
                        ':produk_id' => $produk_id,
                        ':qty' => $qty,
                        ':harga_beli' => $harga_beli,
                        ':harga_jual' => $harga_jual,
                        ':created_at' => $create
                    ));
                } else {
                    // Produk tidak ditemukan, handle sesuai kebutuhan Anda
                    echo "Produk dengan ID $produk_id tidak ditemukan.";
                }
            }
        }

        $pdo->commit();

        // Redirect ke halaman penjualan_detail.php setelah penyimpanan berhasil
        header("Location: tabel_penjualan.php");
        exit();
    } catch (PDOException $e) {
        // Rollback transaksi jika terjadi kesalahan
        $pdo->rollback();
        echo "Error: " . $e->getMessage();
    }

    // Menutup koneksi database
    $pdo = null;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ADMIN</title>

    <!-- Custom fonts for this template-->
    <link href="../../SBAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Custom styles for this template-->
    <link href="../../SBAdmin/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-cash-register"></i>
                </div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../index.php">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

             <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>
        

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Master:</h6>
                        <a class="collapse-item" href="../pelanggan.php">Pelanggan</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Transaksi Collapse Menu -->
           <li class="nav-item active">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fa-solid fa-cash-register"></i>
                <span>Transaksi</span>
            </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item" href="tabel_penjualan.php">Tabel Penjualan</a>
                        <a class="collapse-item active" href="penjualan.php">Penjualan</a>
                    </div>
                </div>
            </li>

            </li>

            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            
           

        </ul>
        
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class='mr-2 d-none d-lg-inline text-gray-600 small'><?= $_SESSION['username'] ?></span>
                               <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../Logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
    <!-- content -->
    <div class="container text">
        <h2 class="text-center" style="font-weight: bold">PENJUALAN</h2>
        <form action="" method="POST">
            <div class="row">
                <div class="offset-md-3 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="toko">TOKO</label>
                        <input type="text" class="form-control" value="<?= $result["nama_toko"]?>">
                        <input type="hidden" name="toko_id" value="<?= $result["toko_id"]?>">
                    </div>
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                    <input type="hidden" name="user_id" value="<?= $id_user?>">
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="pelanggan">PELANGGAN</label>
                        <select class="form-control" id="pelanggan_id" name="pelanggan_id">
                        <option value="" disabled selected>Pilih Pelanggan...</option>
                            <?php 
                                if($result2){
                                    while($row = mysqli_fetch_assoc($result2)){
                                        $nama_pelanggan = $row['nama_pelanggan'];
                                        $id = $row['pelanggan_id'];
                                        echo "<option value='$id'>$nama_pelanggan</option>";
                                    }
                                } else {
                                    echo "<option value=''>Gagal mengambil data</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                <div class="form-group">
                    <label for="searchBarang">BARANG</label>
                    <input type="text" class="form-control" id="searchBarang" placeholder="Cari barang...">

                        <ul class="mt-3">

                        </ul>
                            
                </div>

                <div class="form-group" id="daftarBarang">
                    <div id="selectedBarang" class="dropdown-menu" style="display:none;">
                        <?php 
                            if($result3){
                                while($row = mysqli_fetch_assoc($result3)){
                                    $nama_produk = $row['nama_produk'];
                                    $id = $row['produk_id'];
                                    $harga = $row['harga_jual'];
                                    $stok = $row['stok'];
                        ?>
                                    <div class="dropdown-item" data-id="<?php echo $id; ?>" data-harga="<?php echo $harga; ?>" data-stok='<?php echo $stok; ?>'>
                                        <?php echo $nama_produk; ?>
                                    </div>
                        <?php
                                }
                            } else {
                                echo "<p>Data tidak tersedia</p>";
                            }
                        ?>
                    </div>
                </div>
                </div>
                    <div class="offset-md-3 col-md-6 mb-3">
                        <label for="bayar" class="form-label">TOTAL</label>
                        <input type="number" class="form-control" id="total" name="total" >
                    </div>
                    <div class="offset-md-3 col-md-6 mb-3">
                        <label for="bayar" class="form-label">BAYAR:</label>
                        <input type="text" class="form-control" id="bayar" name="bayar">
                    </div>
                    <div class="offset-md-3 col-md-6 mb-3">
                        <label for="sisa" class="form-label">SISA</label>
                        <input type="text" class="form-control" id="sisa" name="sisa">
                    </div>
                    <div class="offset-md-3 col-md-6 mb-3">
                        <label for="keterangan" class="form-label">KETERANGAN</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                    </div>
                    <div class="offset-md-3 col-md-6 mb-3">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </div>
        </form>
                  
    </div>
</div>
            <!-- End of Main Content -->
</div>
        <!-- End of Content Wrapper -->
</div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../SBAdmin/vendor/jquery/jquery.min.js"></script>
    <script src="../../SBAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../SBAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../SBAdmin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../SBAdmin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../SBAdmin/js/demo/chart-area-demo.js"></script>
    <script src="../../SBAdmin/js/demo/chart-pie-demo.js"></script>

<script>
    // search barang
    document.getElementById('searchBarang').addEventListener('input', function() {
        var keyword = this.value.toLowerCase();
        var barangItems = document.querySelectorAll('#selectedBarang .dropdown-item');

        if (keyword.trim() === '') { // Jika input pencarian kosong
            barangItems.forEach(function(barang) {
                barang.style.display = 'block'; // Tampilkan semua barang
            });
            document.getElementById('selectedBarang').style.display = 'none'; // Sembunyikan daftar barang
        } else {
            var found = false;
            barangItems.forEach(function(barang) {
                var nama = barang.textContent.toLowerCase();
                if (nama.includes(keyword)) {
                    barang.style.display = 'block'; // Tampilkan barang yang cocok dengan pencarian
                    found = true;
                } else {
                    barang.style.display = 'none'; // Sembunyikan barang yang tidak cocok
                }
            });

            // Tampilkan daftar barang jika ada yang cocok dengan pencarian
            document.getElementById('selectedBarang').style.display = found ? 'block' : 'none';
        }
    });
    document.getElementById('selectedBarang').addEventListener('click', function(event) {
    var clickedElement = event.target;
    if (clickedElement.classList.contains('dropdown-item')) {
        var namaBarang = clickedElement.textContent.trim();
        var hargaBarang = parseFloat(clickedElement.getAttribute('data-harga'));
        var stokBarang = parseInt(clickedElement.getAttribute('data-stok'));
        var idBarang = parseInt(clickedElement.getAttribute('data-id')); // Mengambil ID barang dari atribut data-id

        var qty = prompt("Masukkan jumlah barang untuk " + namaBarang + ":");
        if (qty === null || qty.trim() === "") {
            return; // Jika pengguna membatalkan atau tidak memasukkan jumlah, keluar dari fungsi
        }

        // Konversi qty menjadi bilangan bulat
        qty = parseInt(qty);

        // Validasi qty
        if (isNaN(qty) || qty <= 0) {
            alert("Jumlah barang tidak valid.");
            return; // Jika jumlah barang tidak valid, keluar dari fungsi
        }

        var ulElement = document.getElementById('daftarBarang');
        var liElement = document.createElement('li');
        // Tambahkan teks dengan informasi barang ke dalam elemen <li>
        liElement.textContent = namaBarang + ' - Qty: ' + qty + ' - Rp' + hargaBarang.toFixed(2) + ' - Stok: ' + stokBarang;

        // Menambahkan atribut data-harga dan data-stok ke elemen <li>
        liElement.setAttribute('data-harga', hargaBarang);
        liElement.setAttribute('data-stok', stokBarang);

        // Tambahkan elemen <li> ke dalam elemen <ul>
        ulElement.appendChild(liElement);

        // Buat input checkbox
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.value = idBarang + '|' + qty; // Menggunakan ID barang sebagai nilai checkbox
        checkbox.checked = true; 
        checkbox.style.display = 'none';
        checkbox.name = 'barang[]'; 
        checkbox.setAttribute('data-qty', qty);

        // Tambahkan input checkbox ke dalam elemen <li>
        liElement.appendChild(checkbox);


        // Tambahkan event listener untuk menghapus elemen <li> saat diklik
        liElement.addEventListener('click', function() {
            ulElement.removeChild(liElement);
            updateTotal();
        });

        // Memperbarui total harga
        updateTotal();
    }
});


function updateTotal() {
    var total = 0;
    var liElements = document.querySelectorAll('#daftarBarang li');
    liElements.forEach(function(li) {
        var hargaBarang = parseFloat(li.getAttribute('data-harga'));
        total += hargaBarang;
    });
    document.getElementById('total').value = total; // Menampilkan total

    // Update sisa
    var bayar = parseFloat(document.getElementById('bayar').value);
    if (!isNaN(bayar)) {
        var sisa = bayar - total;
        document.getElementById('sisa').value = sisa >= 0 ? sisa : ''; // Menampilkan sisa, atau kosong jika sisa negatif
    } else {
        document.getElementById('sisa').value = ''; // Jika nilai bayar tidak valid, kosongkan input sisa
    }
}

// Memantau perubahan pada input bayar
document.getElementById('bayar').addEventListener('input', function() {
    updateTotal();
});

    
</script>



</body>

</html>
<?php } ?>