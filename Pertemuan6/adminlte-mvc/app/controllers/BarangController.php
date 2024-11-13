<?php

require_once 'app/models/BarangModel.php';  // Pastikan file model Anda ada
require_once 'config/database.php'; // Pastikan ini di-include untuk mendapatkan koneksi database

class BarangController
{
    function indexbarang()
    {
        // Ambil koneksi database
        $db = getDBConnection();  // Mendapatkan koneksi database dari config/database.php

        // Buat objek model dan ambil data pelanggan
        $barangModel = new BarangModel($db);
        $barangData = $barangModel->getAllBarang();

        // Kirim data pelanggan ke view
        require 'app/views/barang.php';
    }

   
    function updateBarang()
    {
        // Ambil koneksi database
        $db = getDBConnection();  // Mendapatkan koneksi database dari config/database.php

        // Buat objek model dan ambil data pelanggan
        if (isset($_POST['id']) && isset($_POST['nama']) && isset($_POST['harga']) && isset($_POST['stok'])) {
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];

            // Membuat objek model
            $barangModel = new BarangModel($db);

            // Memanggil method update di model untuk memperbarui data
            $result = $barangModel->updateBarang($id, $nama, $harga, $stok);

            // Mengirimkan response
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Data Barang berhasil diperbarui.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data Barang.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap.']);
        }
    }

    function deleteBarang()
    {
        // Ambil koneksi database
        $db = getDBConnection();  // Mendapatkan koneksi database dari config/database.php

        // Buat objek model dan ambil data Barang
        if (isset($_POST['id'])) {
            $id = $_POST['id'];


            // Membuat objek model
            $BarangModel = new BarangModel($db);

            // Memanggil method update di model untuk memperbarui data
            $result = $BarangModel->deleteBarang($id);

            // Mengirimkan response
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Data Barang berhasil dihapus.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data Barang.']);
            }
        }
    }
}
