<?php
session_start();
require_once '../database/koneksi.php';
require_once '../class/produk.php';

$productClass = new Produk($conn);

if (isset($_POST['nama_produk']) && isset($_POST['harga']) && isset($_POST['stok'])) {
  // Ambil data dari form
  $nama_produk = $_POST['nama_produk'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];

  // Tambah produk ke database
  $prod = $productClass->tambahProduk($nama_produk, $harga, $stok);
  header("Location: ../produk.php");
}
?>