<?php
include '../../koneksi.php';

session_start();
$sql = "SELECT * FROM toko";
$result = mysqli_query($koneksi,$sql);

$sql1 = "SELECT * FROM user";
$result1 = mysqli_query($koneksi,$sql1);

$sql2 = "SELECT * FROM suplier";
$result2 = mysqli_query($koneksi,$sql2);

$sql = "SELECT * FROM produk";
$result3 = mysqli_query($koneksi,$sql);


// Pastikan ada sesi yang telah dimulai
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Pastikan ada sesi yang telah dimulai
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Inisialisasi variabel pesan
$pesan = '';

// Proses form jika tombol submit ditekan
if (isset($_POST['submit'])) {
    // Ambil data dari form
    $toko_id = $_POST['toko'];
    $user_id = $_POST['user'];
    $no_faktur = $_POST['no_faktur'];
    $produk = $_POST['nama_produk'];
    $tanggal_pembelian = $_POST['tanggal_pembelian'];
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $sisa = $total - $bayar;
    $keterangan = $_POST['keterangan'];
    $created_at = date('Y-m-d H:i:s');

    // Query untuk memasukkan data pembelian ke dalam database
    $query = "INSERT INTO pembelian (toko_id, user_id, no_faktur, tanggal_pembelian, total, bayar, sisa, keterangan, created_at) 
              VALUES ('$toko_id', '$user_id', '$no_faktur', '$tanggal_pembelian', '$total', '$bayar', '$sisa', '$keterangan', '$created_at')";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

// Jika query pertama berhasil dieksekusi, lanjutkan ke query kedua
if ($result) {
    // Query untuk memasukkan data ke dalam Tabel Kedua
    $query = "SELECT * FROM pembelian ORDER BY pembelian_id DESC";
$row= mysqli_query($koneksi, $query_tabel_kedua) ;
$row2 = mysqli_fetch_assoc($row) ;
header("location:detail_pembelian.php?id=$row[pembelian_id]");

    // Eksekusi query untuk Tabel Kedua
    $result_tabel_kedua = mysqli_query($koneksi, $query_tabel_kedua);

    // Periksa apakah query kedua berhasil dieksekusi
    if ($result_tabel_kedua) {
        // Data berhasil dimasukkan ke kedua tabel
        echo "Data berhasil dimasukkan ke kedua tabel.";
        header("location: pembelian.php");
    } else {
        // Jika query kedua gagal dieksekusi, hapus data dari Tabel Pertama
        $query_hapus_tabel_pertama = "DELETE FROM tabel_pertama WHERE nama = '$nama'";
        mysqli_query($koneksi, $query_hapus_tabel_pertama);

        echo "Gagal memasukkan data ke dalam Tabel Kedua.";
    }
} else {
    // Jika query pertama gagal dieksekusi
    echo "Gagal memasukkan data ke dalam Tabel Pertama.";
}
}

// Tutup koneksi ke database
//mysqli_close($koneksi);

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pembelian</title>

    <!-- Custom fonts for this template-->
    <link href="../../SBAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Custom styles for this template-->
    <link href="../../SBAdmin/css/sb-admin-2.min.css" rel="stylesheet">
    
    <style>
        .table thead th{
            border-bottom:0px;
            
        }
        th{
            border:2px solid #eeeeee;
            background-color: white;
            color: black;
        }
        tr, td{
            border:2px solid #eeeeee;
            color: black;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="SBAdmin/index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-cash-register"></i>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../SBAdmin/index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Master:</h6>
                        <a class="collapse-item " href="../toko.php">Toko</a>
                        <a class="collapse-item " href="../kategori.php">Kategori</a>
                        <a class="collapse-item " href="../list_produk.php">Produk</a>
                        <a class="collapse-item " href="../pengguna.php">Pengguna</a>
                        <a class="collapse-item " href="../pelanggan.php">Pelanggan</a>
                        <a class="collapse-item " href="../supplier.php">Supplier</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item active" href="pembelian.php">Pembelian</a>
                        <a class="collapse-item" href="penjualan.php">Penjualan</a>
                        <a class="collapse-item" href="detail_penjualan.php">Detail Penjualan</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="../pengguna.php">
                    <i class="fa-solid fa-users"></i>
                    <span>Data Pengguna</span></a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username'] ?></span>
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <h2>Pembelian</h2>
    <!-- Tampilkan pesan jika ada -->
    <?php if ($pesan != ''): ?>
        <p><?php echo $pesan; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
       <?php
            if ($result) {
                echo "<label for='toko'>Toko :</label>";
                echo "<select class='form-control' name='toko' required>";

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
                echo "<label for='user'>Nama User :</label>";
                echo "<select class='form-control' name='user' required>";

                while ($rew = mysqli_fetch_assoc($result1)) {
                    $nama_lengkap = $rew['nama_lengkap'];
                    $user_id = $rew['user_id'];
                    echo "<option value='$user_id'>$nama_lengkap</option>";
                    }

                    echo "</select>";
                } else {
                    echo "Gagal mengambil data";
                }
        $nofaktur=mysqli_query($koneksi, "select no_faktur, pembelian_id from pembelian order by pembelian_id desc");
        $last=mysqli_num_rows($nofaktur);
        $bacafaktur=mysqli_fetch_assoc($nofaktur);
        if($last<=0){
            $faktur="1-".date('Ymd');
        }else{
            $nomor=explode("-",$bacafaktur['no_faktur']);
            $jml=$nomor[0]+1;
            $faktur=$jml."-".date('Ymd');
        }
        ?>
        <label for="no_faktur">Nomor Faktur:</label><br>
        <input type="text" id="no_faktur" name="no_faktur" value="<?= $faktur; ?>" required><br>

        <label for="tanggal_pembelian">Tanggal Pembelian:</label><br>
        <input type="date" id="tanggal_pembelian" name="tanggal_pembelian" required><br>

        <div class="offset-md-3 col-md-6 mb-3">
                <div class="form-group">
                    <label for="barang">barang:</label>
                    <select class="form-control" id="produk_id" name="produk_id">
                    <option value="" disabled selected>Pilih barang...</option>
                        <?php 
                            if($result3){
                                while($raw = mysqli_fetch_assoc($result3)){
                                    $nama_produk = $raw['nama_produk'];
                                    $id = $raw['produk_id'];
                                    $harga = $raw['harga_jual'];
                                    echo "<option value='$id' data-harga='$harga'>$nama_produk</option>";
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
        <label for="total">Total:</label><br>
        <input type="text" id="total" name="total" required><br>
        </div>
        </div>

        <label for="bayar">Bayar:</label><br>
        <input type="text" id="bayar" name="bayar" required><br>
        
        <label for="sisa">Sisa:</label><br>
        <input type="text" id="sisa" name="sisa" required><br>

        <label for="keterangan">Keterangan:</label><br>
        <textarea id="keterangan" name="keterangan"></textarea><br><br>

        <input type="submit" name="submit" value="Submit">
    </form>
</div>
</div>
</div>
</div>
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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan elemen select
        var select = document.getElementById('produk_id');

        // Mendapatkan elemen input total
        var totalInput = document.getElementById('total');

        // Menambahkan event listener untuk perubahan pada elemen select
        select.addEventListener('change', function() {
            // Mendapatkan harga dari opsi yang dipilih
            var harga = parseFloat(select.options[select.selectedIndex].getAttribute('data-harga'));
            
            // Memperbarui nilai input total dengan harga yang dipilih
            totalInput.value = harga;
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var totalInput = document.getElementById('total');
        var bayarInput = document.getElementById('bayar');
        var sisaInput = document.getElementById('sisa');

        totalInput.addEventListener('input', function() {
            calculateSisa();
        });

        bayarInput.addEventListener('input', function() {
            calculateSisa();
        });

        function calculateSisa() {
            var total = parseFloat(totalInput.value);
            var bayar = parseFloat(bayarInput.value);
            
            // Pastikan kedua nilai adalah angka dan bayar lebih besar dari total
            if (!isNaN(total) && !isNaN(bayar) && bayar > total) {
                var sisa = bayar - total;
                sisaInput.value = sisa;
            } else {
                sisaInput.value = '';
            }
        }
    });
</script>

</body>
</html>