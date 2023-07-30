<?php
class Pengguna
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login($email, $password)
    {
        $query = "SELECT * FROM pengguna WHERE email = '$email' AND password = '$password'";
        $result = $this->conn->query($query);

        if ($result->num_rows == 1) {
            $pengguna = $result->fetch_assoc();
            $_SESSION['user_id'] = $pengguna['id'];
            $_SESSION['role'] = $pengguna['role'];
            $_SESSION['nama'] = $pengguna['nama'];
            return true;
        } else {
            return false;
        }
    }

    public function registrasi($nama, $email, $password, $role)
    {
        $query = "INSERT INTO pengguna (nama, email, password, role) VALUES ('$nama', '$email', '$password', '$role')";
        $result = $this->conn->query($query);

        return $result;
    }


    public function tampilkanPengguna()
    {
        // Query untuk mengambil daftar pengguna dari database
        $query = "SELECT * FROM pengguna";
        $result = $this->conn->query($query);

        $daftarPengguna = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $daftarPengguna[] = $row;
            }
        }

        return $daftarPengguna;
    }

    public function ubahPengguna($id, $nama, $email, $password, $role)
    {
        // Sanitasi data sebelum dimasukkan ke database untuk menghindari SQL injection
        $id = intval($id);
        $nama = $this->conn->real_escape_string($nama);
        $email = $this->conn->real_escape_string($email);
        $password = password_hash($password, PASSWORD_DEFAULT); // Hash password sebelum disimpan di database

        // Query untuk mengubah data pengguna di database
        $query = "UPDATE pengguna SET nama='$nama', email='$email', password='$password', role='$role' WHERE id='$id'";
        $result = $this->conn->query($query);

        return $result;
    }

    public function hapusPengguna($id)
    {
        // Sanitasi data sebelum dimasukkan ke database untuk menghindari SQL injection
        $id = intval($id);

        // Query untuk menghapus data pengguna dari database
        $query = "DELETE FROM pengguna WHERE id='$id'";
        $result = $this->conn->query($query);

        return $result;
    }
}
?>