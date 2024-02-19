<?php
// Include koneksi ke database
include '../koneksi.php';

// Memulai session
session_start();

try {
        // Replace the following lines with your actual database insertion logic
        $pdo = new PDO("mysql:host=localhost;dbname=ujikom_kasir", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Begin a transaction
        $pdo->beginTransaction();

        // Insert into penjualan table
        $sql = "INSERT INTO penjualan (toko_id, user_id, tanggal_penjualan, pelanggan_id, total, bayar, sisa, keterangan, created_at)
                VALUES (:toko_id, :user_id, :tanggal_penjualan, :pelanggan_id, :total, :bayar, :sisa, :keterangan, :created_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':toko_id' => $toko_id,
            ':user_id' => $user_id,
            ':tanggal_penjualan' => $tanggal_penjualan,
            ':pelanggan_id' => $pelanggan_id,
            ':total' => $total,
            ':bayar' => $bayar,
            ':sisa' => $sisa,
            ':keterangan' => $keterangan,
            ':created_at' => $create
        ));

        // Get the penjualan_id of the inserted row
        $penjual_id = $pdo->lastInsertId();

        // Insert into penjualan_detail table
        $produk_id = $_POST["produk_id"];
        $qty = 1; // For now, let's assume the quantity is 1
        $harga_beli = $_POST["harga_beli"]; // Assuming you also want to store the purchase price

        $sql = "INSERT INTO penjual_detail (penjual_id, produk_id, qty, harga_beli, harga_jual, created_at)
                VALUES (:penjual_id, :produk_id, :qty, :harga_beli, :harga_jual, :created_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':penjual_id' => $penjual_id,
            ':produk_id' => $produk_id,
            ':qty' => $qty,
            ':harga_beli' => $harga_beli,
            ':harga_jual' => $total, // Assuming the total is the selling price
            ':created_at' => $create
        ));

        // Commit the transaction
        $pdo->commit();

        // Redirect to a success page or display a success message
        header("Location: ../Transaksi/detail_penjualan.php");
        exit();
    } catch (PDOException $e) {
        // Rollback the transaction if an error occurred
        $pdo->rollback();
        echo "Error: " . $e->getMessage();
    }
?>
