<?php 
include '../../koneksi.php';

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pembelian Barang</title>

    <!-- Custom fonts for this template-->
    <link href="../../SBAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="SBAdmin/index.php">
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
                        <a class="collapse-item" href="laporan_penjualan.php">Laporan Penjualan</a>
                        <a class="collapse-item active" href="detail_pembelian.php">Detail Pembelian</a>
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
                                <a class="dropdown-item" href="../../logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Data Pembelian Barang</title>
                        <style>
                            table {
                                width: 100%;
                                border-collapse: collapse;
                                margin-top: 20px;
                            }

                            th,
                            td {
                                border: 1px solid #ddd;
                                padding: 8px;
                                text-align: left;
                                color: #000;
                            }

                            th {
                                background-color: #f2f2f2;
                            }

                            button {
                                padding: 5px 10px;
                                margin-right: 5px;
                            }
                        </style>
                    </head>

                    <body>

                        <h2>Data Pembelian Barang</h2>

                        <a href="pembelian.php"><button onclick="tambahPembelian()" class='btn btn-primary'>Tambah Pembelian</button></a>

                        <table id="tabelPembelian">
                            <tr>
                                <th>Pembelian ID</th>
                                <th>Nama Toko</th>
                                <th>Nama User</th>
                                <th>No Faktur</th>
                                <th>Tanggal Pembelian</th>
                                <th>Nama Supplier</th>
                                <th>Total</th>
                                <th>Bayar</th>
                                <th>Sisa</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                            <!-- Static data for demonstration -->
                           <?php
// Query untuk mengambil data pembelian beserta nama user, toko, dan supplier
$sql = "SELECT pembelian_detail.*, 
       user.nama_lengkap AS nama_user, 
       toko.nama_toko AS nama_toko, 
       suplier.nama_suplier AS nama_supplier 
FROM pembelian_detail
INNER JOIN pembelian ON pembelian_detail.pembelian_id = pembelian.pembelian_id
INNER JOIN user ON pembelian.user_id = user.user_id
INNER JOIN toko ON pembelian.toko_id = toko.toko_id
INNER JOIN suplier ON suplier.suplier_id
";
$result = $koneksi->query($sql);

// Tampilkan data dalam tabel
if ($result) {
   while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["pembelian_id"] . "</td>";
        echo "<td>" . $row["nama_toko"] . "</td>";
        echo "<td>" . $row["nama_user"] . "</td>";
        echo "<td>" . $row["no_faktur"] . "</td>";
        echo "<td>" . $row["tanggal_pembelian"] . "</td>";
        echo "<td>" . $row["nama_supplier"] . "</td>";
        echo "<td>" . $row["total"] . "</td>";
        echo "<td>" . $row["bayar"] . "</td>";
        echo "<td>" . $row["sisa"] . "</td>";
        echo "<td>" . $row["keterangan"] . "</td>";
        echo "<td>
                <a href='edit_pembelian_barang.php?id=" . $row["pembelian_id"] . "' class='btn btn-success btn-sm'>Edit</a>
                <a href='hapus_pembelian.php?id=" . $row["pembelian_id"] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">Delete</a>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='12'>Tidak ada data pembelian barang.</td></tr>";
}

// Tutup koneksi
$koneksi->close();
?>


                            <!-- Add more rows for additional data -->
                        </table>

                    </body>

                    </html>



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="m-0 text-center text-black">

                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-primary" href="../../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mengambil URL halaman saat ini
        var currentUrl = window.location.href;

        // Mengambil semua elemen sidebar yang memiliki link
        var sidebarLinks = document.querySelectorAll('.nav-link[href]');

        // Iterasi melalui setiap link sidebar
        sidebarLinks.forEach(function(link) {
            // Jika URL saat ini cocok dengan URL link di sidebar
            if (currentUrl === link.href) {
                // Tambahkan kelas 'active' pada elemen li yang bersangkutan
                link.parentNode.classList.add('active');
            }
        });
    </script>


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

    <!-- Additional custom scripts or scripts for handling data tables can be added here -->

</body>

</html>