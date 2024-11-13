<?php

require_once 'app/models/BarangModel.php';  // Pastikan file model Anda ada
require_once 'config/database.php'; // Pastikan ini di-include untuk mendapatkan koneksi database

class TransaksiController
{
    function indextransaksi()
    {
        // Ambil koneksi database
        $db = getDBConnection();  // Mendapatkan koneksi database dari config/database.php

        // Buat objek model dan ambil data pelanggan
        $transaksiModel = new TransaksiModel($db);
        $transaksiData = $transaksiModel->getAllTransaksi();

        // Kirim data pelanggan ke view
        require 'app/views/transaksi.php';
    }

   
    function updateTransaksi()
    {
        // Ambil koneksi database
        $db = getDBConnection();  // Mendapatkan koneksi database dari config/database.php

        // Buat objek model dan ambil data pelanggan
        if (isset($_POST['id_trans']) && isset($_POST['kd_brg']) && isset($_POST['id']) && isset($_POST['jumlah']) && isset($_POST['total_harga']) && isset($_POST['tanggal'])) {
            $idtrans = $_POST['id_trans'];
            $kd = $_POST['kd_brg'];
            $id = $_POST['id'];
            $jumlah = $_POST['jumlah'];
            $total_harga = $_POST['total_harga'];
            $tanggal = $_POST['tanggal'];

            // Membuat objek model
            $transaksiModel = new TransaksiModel($db);

            // Memanggil method update di model untuk memperbarui data
            $result = $transaksiModel->updateTransaksi($idtrans, $kd, $id, $jumlah, $total_harga, $tanggal);

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

    function deleteTransaksi()
    {
        // Ambil koneksi database
        $db = getDBConnection();  // Mendapatkan koneksi database dari config/database.php

        // Buat objek model dan ambil data Barang
        if (isset($_POST['id'])) {
            $id = $_POST['id'];


            // Membuat objek model
            $TransaksiModel = new TransaksiModel($db);

            // Memanggil method update di model untuk memperbarui data
            $result = $TransaksiModel->deleteTransaksi($id);

            // Mengirimkan response
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Data Transaksi berhasil dihapus.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data Transaksi.']);
            }
        }
    }
}
