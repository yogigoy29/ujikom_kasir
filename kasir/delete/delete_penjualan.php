<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {

    include '../../koneksi.php';

    $id = $_GET['id'];

    $query = "DELETE FROM penjualan WHERE penjualan_id = $id";
    if ($koneksi->query($query) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
    $koneksi->close();
} else {
    echo "ID tidak valid.";
}

header("Location: ../transaksi/tabel_penjualan.php");
exit();
?>