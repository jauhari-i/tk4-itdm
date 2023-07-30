<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

require_once './database/koneksi.php';
require_once './class/pesanan.php';
require_once './class/produk.php';
require_once './class/pengguna.php';

$pesananClass = new Pesanan($conn);
$productClass = new Produk($conn);
$penggunaClass = new Pengguna($conn);

?>
<!DOCTYPE html>
<html>

<head>
  <title>Daftar Pesanan</title>
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
    <h2>Daftar Pesanan</h2>
    <table>
      <tr>
        <th>ID</th>
        <th>Nama Produk</th>
        <th>Nama Pengguna</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th>Tanggal Pesanan</th>
        <th>Aksi</th>
      </tr>
      <!-- Loop untuk menampilkan data pesanan dari database -->
      <?php
      $daftarPesanan = $pesananClass->tampilkanPesanan();
      foreach ($daftarPesanan as $pesanan) { ?>
        <tr>
          <td>
            <?php echo $pesanan['id']; ?>
          </td>
          <td>
            <?php echo $pesanan['nama_produk']; ?>
          </td>
          <td>
            <?php echo $pesanan['nama_pengguna']; ?>
          </td>
          <td>
            <?php echo $pesanan['jumlah']; ?>
          </td>
          <td>
            <?php echo $pesanan['total_harga']; ?>
          </td>
          <td>
            <?php echo $pesanan['tanggal_pesanan']; ?>
          </td>
          <td>
            <a href="./controller/deletePesanan.php?id=<?php echo $pesanan['id'] ?>">hapus</a>
          </td>
        </tr>
      <?php } ?>
    </table>
    <h2>Tambah Pesanan</h2>
    <form style="margin-bottom: 20px;" action="./controller/tambahPesanan.php" method="post">
      <label>Produk:</label>
      <select name="id_produk" required>
        <option value="">-</option>
        <?php
        $daftarProduk = $productClass->tampilkanProduk();
        foreach ($daftarProduk as $produk) { ?>
          <option value="<?php echo $produk['id'] ?>"><?php echo $produk['nama'] ?></option>
        <?php } ?>
      </select>
      <label>Pengguna:</label>
      <select name="id_pengguna" required>
        <option value="">-</option>
        <?php
        $daftarPengguna = $penggunaClass->tampilkanPengguna();
        foreach ($daftarPengguna as $pengguna) { ?>
          <option value="<?php echo $pengguna['id'] ?>"><?php echo $pengguna['nama'] ?></option>
        <?php } ?>
      </select>
      <label>Jumlah:</label>
      <input type="number" name="jumlah" required>
      <div class="error">
        <!-- Pesan kesalahan bisa ditampilkan disini -->
      </div>
      <button type="submit">Tambah Pesanan</button>
    </form>
    <a href="index.php">Dashboard</a>
    <a href="produk.php">Produk</a>
    <!-- Tombol Logout -->
    <form style="margin-top: 20px;" action="./controller/logout.php" method="post">
      <button type="submit">Logout</button>
    </form>
  </div>
</body>

</html>