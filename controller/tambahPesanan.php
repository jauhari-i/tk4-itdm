<?php
session_start();
require_once '../database/koneksi.php';
require_once '../class/produk.php';
require_once '../class/pesanan.php';

$productClass = new Produk($conn);
$pesananClass = new Pesanan($conn);

if (isset($_POST['id_produk']) && isset($_POST['id_pengguna']) && isset($_POST['jumlah'])) {
  // Ambil data dari form
  $id_produk = (int) $_POST['id_produk'];
  $id_pengguna = (int) $_POST['id_pengguna'];
  $jumlah = $_POST['jumlah'];

  // Ambil data produk dari db
  $produk = $productClass->detailProduk($id_produk);

  $totalHarga = $jumlah * $produk['harga'];
  $tanggalPesanan = date('Y-m-d H:i:s');

  $pesananClass->tambahPesanan($id_pengguna, $id_produk, $jumlah, $totalHarga, $tanggalPesanan);

  header("Location: ../pesanan.php");
}
?>