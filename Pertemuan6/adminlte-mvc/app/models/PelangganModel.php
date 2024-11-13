<?php

class PelangganModel
{
    private $db;

    // Menerima koneksi database yang sudah ada
    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }


    // Fungsi untuk mendapatkan data pelanggan
    function getAllPelanggan()
    {
        try {
            // Menyiapkan query SQL untuk mengambil semua data pelanggan
            $query = "SELECT * FROM pelanggan"; // Sesuaikan dengan nama tabel di database Anda
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            // Mengembalikan hasil query
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Menangani error jika terjadi masalah pada query
            echo "Error: " . $e->getMessage();
        }
    }

    public function updatePelanggan($id, $nama, $alamat) {
        $query = "UPDATE pelanggan SET nama = :nama, alamat = :alamat WHERE id = :id";
        $stmt = $this->db->prepare($query);
        
        // Bind parameter
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':alamat', $alamat);
        
        // Eksekusi query dan cek apakah berhasil
        return $stmt->execute();
    }

    function deletePelanggan($id) {
        
        $query = "DELETE FROM pelanggan WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind parameter
        $stmt->bindParam(':id', $id);
    
        return $stmt->execute(); // Menghapus data dan mengembalikan status
    }
}
?>