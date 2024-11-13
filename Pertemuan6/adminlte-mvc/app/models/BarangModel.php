<?php

class BarangModel
{
    private $db;

    // Menerima koneksi database yang sudah ada
    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }


    // Fungsi untuk mendapatkan data barang
    function getAllBarang()
    {
        try {
            // Menyiapkan query SQL untuk mengambil semua data barang
            $query = "SELECT * FROM barang"; // Sesuaikan dengan nama tabel di database Anda
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            // Mengembalikan hasil query
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Menangani error jika terjadi masalah pada query
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateBarang($id, $nama, $harga, $stok)
    {
        $query = "UPDATE barang SET nama = :nama, harga = :harga, stok = :stok WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind parameter
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':stok', $stok);

        // Eksekusi query dan cek apakah berhasil
        return $stmt->execute();
    }

    function deleteBarang($id)
    {

        $query = "DELETE FROM barang WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind parameter
        $stmt->bindParam(':id', $id);

        return $stmt->execute(); // Menghapus data dan mengembalikan status
    }
}
