<?php
class Produk
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function tambahProduk($nama, $harga, $stok)
    {
        // Sanitasi data sebelum dimasukkan ke database untuk menghindari SQL injection
        $nama = $this->conn->real_escape_string($nama);
        $harga = floatval($harga);
        $stok = intval($stok);

        // Query untuk menambah produk ke database
        $query = "INSERT INTO produk (nama, harga, stok) VALUES ('$nama', '$harga', '$stok')";
        $result = $this->conn->query($query);

        return $result;
    }

    public function detailProduk($id)
    {
        $query = "SELECT * FROM produk WHERE id='$id'";
        $result = $this->conn->query($query);

        return $result->fetch_assoc();
    }

    public function tampilkanProduk()
    {
        // Query untuk mengambil daftar produk dari database
        $query = "SELECT * FROM produk";
        $result = $this->conn->query($query);

        $daftarProduk = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $daftarProduk[] = $row;
            }
        }

        return $daftarProduk;
    }

    public function ubahProduk($id, $nama, $harga, $stok)
    {
        // Sanitasi data sebelum dimasukkan ke database untuk menghindari SQL injection
        $id = intval($id);
        $nama = $this->conn->real_escape_string($nama);
        $harga = floatval($harga);
        $stok = intval($stok);

        // Query untuk mengubah data produk di database
        $query = "UPDATE produk SET nama='$nama', harga='$harga', stok='$stok' WHERE id='$id'";
        $result = $this->conn->query($query);

        return $result;
    }

    public function hapusProduk($id)
    {
        // Sanitasi data sebelum dimasukkan ke database untuk menghindari SQL injection
        $id = intval($id);

        // Query untuk menghapus data produk dari database
        $query = "DELETE FROM produk WHERE id='$id'";
        $result = $this->conn->query($query);

        return $result;
    }
}
?>