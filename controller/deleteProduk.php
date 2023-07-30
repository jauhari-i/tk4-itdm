<?php
session_start();
require_once '../database/koneksi.php';
require_once '../class/produk.php';

$productClass = new Produk($conn);

$id_produk = (int) $_GET['id'];

if ($id_produk) {
  $productClass->hapusProduk($id_produk);
  header("Location: ../produk.php");
}
?>