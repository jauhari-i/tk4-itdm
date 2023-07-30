<?php
session_start();

require_once '../database/koneksi.php';
require_once '../class/pengguna.php';

$pengguna = new Pengguna($conn);

if (isset($_POST['nama']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $password = sha1($_POST['password']);
  $role = $_POST['role'];

  if ($pengguna->registrasi($nama, $email, $password, $role)) {
    header('Location: ../login.php');
  } else {
    echo 'Registrasi gagal. Silakan coba lagi.';
  }
}
?>