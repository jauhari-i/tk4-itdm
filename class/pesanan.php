<?php
class Pesanan
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function tambahPesanan($id_pengguna, $id_produk, $jumlah, $total_harga, $tanggal_pesanan)
    {
        // Sanitasi data sebelum dimasukkan ke database untuk menghindari SQL injection
        $id_pengguna = intval($id_pengguna);
        $id_produk = intval($id_produk);
        $jumlah = intval($jumlah);
        $total_harga = floatval($total_harga);
        $tanggal_pesanan = $this->conn->real_escape_string($tanggal_pesanan);

        // Query untuk menambah pesanan ke database
        $query = "INSERT INTO pesanan (id_pengguna, id_produk, jumlah, total_harga, tanggal_pesanan) VALUES ('$id_pengguna', '$id_produk', '$jumlah', '$total_harga', '$tanggal_pesanan')";
        $result = $this->conn->query($query);

        return $result;
    }

    public function tampilkanPesanan()
    {
        // Query untuk mengambil daftar pesanan dari database
        $query = "SELECT pesanan.*, produk.nama AS nama_produk, pengguna.nama AS nama_pengguna FROM pesanan
                  INNER JOIN produk ON pesanan.id_produk = produk.id
                  INNER JOIN pengguna ON pesanan.id_pengguna = pengguna.id";
        $result = $this->conn->query($query);

        $daftarPesanan = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $daftarPesanan[] = $row;
            }
        }

        return $daftarPesanan;
    }

    public function ubahPesanan($id, $jumlah, $total_harga, $tanggal_pesanan)
    {
        // Sanitasi data sebelum dimasukkan ke database untuk menghindari SQL injection
        $id = intval($id);
        $jumlah = intval($jumlah);
        $total_harga = floatval($total_harga);
        $tanggal_pesanan = $this->conn->real_escape_string($tanggal_pesanan);

        // Query untuk mengubah data pesanan di database
        $query = "UPDATE pesanan SET jumlah='$jumlah', total_harga='$total_harga', tanggal_pesanan='$tanggal_pesanan' WHERE id='$id'";
        $result = $this->conn->query($query);

        return $result;
    }

    public function hapusPesanan($id)
    {
        // Sanitasi data sebelum dimasukkan ke database untuk menghindari SQL injection
        $id = intval($id);

        // Query untuk menghapus data pesanan dari database
        $query = "DELETE FROM pesanan WHERE id='$id'";
        $result = $this->conn->query($query);

        return $result;
    }
}
?>