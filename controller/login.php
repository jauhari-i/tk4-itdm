<?php
session_start();
require_once '../database/koneksi.php';
require_once '../class/pengguna.php';

$pengguna = new Pengguna($conn);

if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST['email'];
  $password = sha1($_POST['password']);

  if ($pengguna->login($email, $password)) {
    header('Location: ../index.php'); // Ganti dengan halaman dashboard setelah login
  } else {
    echo 'Login gagal. Silakan cek kembali email dan password Anda.';
  }
}
?>