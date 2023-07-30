<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

require_once './database/koneksi.php';
require_once './class/produk.php';

$productClass = new Produk($conn);

?>
<!DOCTYPE html>
<html>

<head>
  <title>Daftar Produk</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th,
    td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    button {
      padding: 8px 12px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }

    .error {
      color: red;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Daftar Produk</h2>
    <table>
      <tr>
        <th>ID</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
      </tr>
      <!-- Loop untuk menampilkan data produk dari database -->
      <?php
      $daftarProduk = $productClass->tampilkanProduk();
      foreach ($daftarProduk as $produk) { ?>
        <tr>
          <td>
            <?php echo $produk['id']; ?>
          </td>
          <td>
            <?php echo $produk['nama']; ?>
          </td>
          <td>
            <?php echo $produk['harga']; ?>
          </td>
          <td>
            <?php echo $produk['stok']; ?>
          </td>
          <td>
            <a href="./controller/deleteProduk.php?id=<?php echo $produk['id'] ?>">hapus</a>
          </td>
        </tr>
      <?php } ?>
    </table>
    <!-- Tombol Tambah Produk hanya tampil untuk pengguna dengan peran penjual -->
    <?php if ($_SESSION['role'] === 'penjual') { ?>
      <h2>Tambah Produk</h2>
      <form style="margin-bottom: 20px;" action="./controller/tambahProduk.php" method="post">
        <label>Nama Produk:</label>
        <input type="text" name="nama_produk" required>
        <label>Harga:</label>
        <input type="number" name="harga" required>
        <label>Stok:</label>
        <input type="number" name="stok" required>
        <div class="error">
          <!-- Pesan kesalahan bisa ditampilkan disini -->
        </div>
        <button type="submit">Tambah Produk</button>
      </form>
    <?php } ?>
    <a href="index.php">Dashboard</a>
    <a href="pesanan.php">Pesanan</a>
    <!-- Tombol Logout -->
    <form style="margin-top: 20px;" action="./controller/logout.php" method="post">
      <button type="submit">Logout</button>
    </form>
  </div>
</body>

</html>