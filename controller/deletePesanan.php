<?php
session_start();
require_once '../database/koneksi.php';
require_once '../class/pesanan.php';

$pesananClass = new Pesanan($conn);

$id_pesanan = (int) $_GET['id'];

if ($id_pesanan) {
  $pesananClass->hapusPesanan($id_pesanan);
  header("Location: ../pesanan.php");
}
?>