<?php

class TransaksiModel
{
    private $db;

    // Menerima koneksi database yang sudah ada
    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }


    // Fungsi untuk mendapatkan data barang
    function getAllTransaksi()
    {
        try {
            // Menyiapkan query SQL untuk mengambil semua data barang
            $query = "SELECT * FROM transaksi"; // Sesuaikan dengan nama tabel di database Anda
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            // Mengembalikan hasil query
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Menangani error jika terjadi masalah pada query
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateTransaksi($idtrans, $kd, $id, $jumlah, $total_harga, $tanggal)
    {
        $query = "UPDATE barang SET kd = :kd, id = :id, jumlah = :jumlah, total_harga = :total_harga, tanggal = :tanggal WHERE idtrans = :idtrans";
        $stmt = $this->db->prepare($query);

        // Bind parameter
        $stmt->bindParam(':idtrans', $idtrans);
        $stmt->bindParam(':kd', $kd);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':jumlah', $jumlah);
        $stmt->bindParam(':total_harga', $total_harga);
        $stmt->bindParam(':tanggal', $tanggal);

        // Eksekusi query dan cek apakah berhasil
        return $stmt->execute();
    }

    function deleteTransaksi($idtrans)
    {

        $query = "DELETE FROM transaksi WHERE idtrans = :idtrans";
        $stmt = $this->db->prepare($query);

        // Bind parameter
        $stmt->bindParam(':idtrans', $idtrans);

        return $stmt->execute(); // Menghapus data dan mengembalikan status
    }
}
