<?php
session_start();

if (isset($_SESSION['user_id'])) {
  header('Location: index.php');
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Registrasi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
    }

    .container {
      max-width: 400px;
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

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="password"] {
      width: 380px;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    button {
      width: 100%;
      padding: 10px;
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
    <h2>Registrasi</h2>
    <form action="controller/register.php" method="post">
      <label>Nama:</label>
      <input type="text" name="nama" required>
      <label>Email:</label>
      <input type="text" name="email" required>
      <label>Password:</label>
      <input type="password" name="password" required>
      <label>Role:</label>
      <select name="role" required>
        <option value="pembeli">Pembeli</option>
        <option value="penjual">Penjual</option>
      </select>
      <div class="error">
        <!-- Pesan kesalahan bisa ditampilkan disini -->
      </div>
      <button type="submit">Registrasi</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login</a></p>
  </div>
</body>

</html>