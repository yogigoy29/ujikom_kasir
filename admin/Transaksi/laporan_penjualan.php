<?php

session_start();
if ($_SESSION["username"])
    $username = $_SESSION["username"];
    $id_user = $_SESSION["user_id"];

include '../../koneksi.php';
$sql = "SELECT * FROM toko";
$result = mysqli_query($koneksi, $sql);
$sql = "SELECT * FROM user";
$result1 = mysqli_query($koneksi, $sql);
$sql = "SELECT * FROM pelanggan";
$result2 = mysqli_query($koneksi, $sql);
$sql = "SELECT * FROM produk";
$result3 = mysqli_query($koneksi, $sql);
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
        

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Master:</h6>
                    <a class="collapse-item" href="../toko.php">Toko</a>
                    <a class="collapse-item" href="../kategori.php">Kategori</a>
                    <a class="collapse-item" href="../list_produk.php">Produk</a>
                    <a class="collapse-item" href="../pelanggan.php">Pelanggan</a>
                    <a class="collapse-item" href="../supplier.php">Supplier</a>
                </div>
            </div>
        </li>
        
        <!-- Nav Item - Utilities Collapse Menu -->
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
                        <a class="collapse-item" href="pembelian.php">Pembelian</a>
                        <a class="collapse-item active" href="laporan_penjualan.php">Laporan Penjualan</a>
                        <a class="collapse-item" href="detail_pembelian.php">Detail Pembelian</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Tables -->

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            
           <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="../pengguna.php">
                    <i class="fa-solid fa-users"></i>
                    <span>Data Pengguna</span></a>
            </li>

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

<?php


// Query untuk mengambil data penjualan_detail beserta informasi harga beli dari tabel produk
$sql = "SELECT * FROM penjualan 
    INNER JOIN toko ON toko.toko_id = penjualan.toko_id
    INNER JOIN pelanggan ON penjualan.pelanggan_id = pelanggan.pelanggan_id";
$result = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KASIR</title>

    <!-- Custom fonts for this template-->
    <link href="../../SBAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../SBAdmin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h2 class="text-center mb-5" style="font-weight: bold;">PENJUALAN</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center" style="">                                   
                                    <th>Toko</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Total</th>
                                    <th>Bayar</th>
                                    <th>Sisa</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    // Output data dari setiap baris
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row["nama_toko"] . "</td>"; // Output nama produk
                                        echo "<td>" . $row["nama_pelanggan"] . "</td>"; // Output nama produk
                                        echo "<td>" . $row["total"] . "</td>";
                                        echo "<td>" . $row["bayar"] . "</td>"; 
                                        echo "<td>" . $row["sisa"] . "</td>";
                                        echo "<td>" . $row["keterangan"] . "</td>"; // Output harga beli dari tabel produk
                                        echo "<td>" . $row["created_at"] . "</td>";
                                        echo "<td style='text-align: center;'>" . "<a href='detail_penjualan.php?id=". $row["penjualan_id"] ."' class='btn btn-primary'>Detail Penjualan</a>
                                        <a class='btn btn-danger' href='../delete/delete_penjualan.php?id=". $row['penjualan_id'] ."'>Hapus</a>
                                        </td>";                                      
                                        echo "</tr>";

                                    }
                                } else {
                                    echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../SBAdmin/vendor/jquery/jquery.min.js"></script>
    <script src="../../SBAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../SBAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../SBAdmin/js/sb-admin-2.min.js"></script>

</body>

</html>

<?php
// Tutup koneksi database
$koneksi->close();
?>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

 <!-- Bootstrap JS (optional, jika diperlukan) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Begin Page Content -->

<script>
  document.getElementById('bayar').addEventListener('click', function() {
    var produk = document.getElementById('produk').value;
    var jumlah = document.getElementById('jumlah').value;
    var table = document.getElementById('transaksi');
    var newRow = table.insertRow();
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    var cell3 = newRow.insertCell(2);
    var cell4 = newRow.insertCell(3);
    cell1.innerHTML = produk;
    cell2.innerHTML = ''; // Tambahkan nama produk
    cell3.innerHTML = ''; // Tambahkan harga produk
    cell4.innerHTML = jumlah;
  });
</script>
</body>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda Yakin Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Jika logout anda harus login kembali!</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="../sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../sbadmin/js/sb-admin-2.min.js"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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