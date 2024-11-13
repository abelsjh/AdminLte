<?php

require_once 'app/models/PelangganModel.php';  // Pastikan file model Anda ada
require_once 'config/database.php'; // Pastikan ini di-include untuk mendapatkan koneksi database

class PelangganController
{
    function indexpelanggan()
    {
        // Ambil koneksi database
        $db = getDBConnection();  // Mendapatkan koneksi database dari config/database.php

        // Buat objek model dan ambil data pelanggan
        $pelangganModel = new PelangganModel($db);
        $pelangganData = $pelangganModel->getAllPelanggan();

        // Kirim data pelanggan ke view
        require 'app/views/pelanggan.php';
    }

    function updatePelanggan()
    {
        // Ambil koneksi database
        $db = getDBConnection();  // Mendapatkan koneksi database dari config/database.php

        // Buat objek model dan ambil data pelanggan
        if (isset($_POST['id']) && isset($_POST['nama']) && isset($_POST['alamat'])) {
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];

            // Membuat objek model
            $pelangganModel = new PelangganModel($db);

            // Memanggil method update di model untuk memperbarui data
            $result = $pelangganModel->updatePelanggan($id, $nama, $alamat);

            // Mengirimkan response
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Data pelanggan berhasil diperbarui.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data pelanggan.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap.']);
        }
    }

    function deletePelanggan()
    {
        // Ambil koneksi database
        $db = getDBConnection();  // Mendapatkan koneksi database dari config/database.php

        // Buat objek model dan ambil data pelanggan
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            

            // Membuat objek model
            $pelangganModel = new PelangganModel($db);

            // Memanggil method update di model untuk memperbarui data
            $result = $pelangganModel->deletePelanggan($id);

            // Mengirimkan response
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Data pelanggan berhasil dihapus.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data pelanggan.']);
            }
        } 
    }


    
}
?>