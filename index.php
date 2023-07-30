<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
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

    .welcome {
      text-align: center;
      margin-bottom: 20px;
    }

    p {
      text-align: center;
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
    <h2>Dashboard</h2>
    <?php
    session_start();
    // Cek apakah pengguna sudah login
    if (isset($_SESSION['user_id'])) {
      // Tampilkan pesan selamat datang dan informasi login pengguna
      echo '<div class="welcome">';
      echo '<p>Selamat datang di dashboard, ' . $_SESSION['nama'] . '!</p>';
      echo '<p>Anda telah berhasil login.</p>';
      echo '<a href="produk.php" >Produk</a>';
      echo '<a style="margin-left: 20px" href="pesanan.php" >Pesanan</a>';
      echo '</div>';

      // Tombol Logout
      echo '<form action="controller/logout.php" method="post">';
      echo '<button type="submit">Logout</button>';
      echo '</form>';
    } else {
      // Jika pengguna belum login, arahkan ke halaman login
      header('Location: login.php');
      exit();
    }
    ?>
  </div>
</body>

</html>