<?php
require_once 'config/database.php';

$dbConnection = getDBConnection();
// Menangani parameter 'page' untuk routing
if (isset($_GET['page'])) {
    $page = $_GET['page'];

    // Menentukan controller berdasarkan parameter 'page'
    if ($page === 'home') {
        require_once 'app/controllers/HomeController.php';
        $app = new HomeController();
        $app->index(); // Menjalankan method index dari HomeController
    } elseif ($page === 'pelanggan') {
        require_once 'app/controllers/PelangganController.php';
        require_once 'app/models/PelangganModel.php';
        $pelanggan = new PelangganController();

        // Jika ada action 'update', panggil metode updatePelanggan()
        if(isset($_GET['action']) && $_GET['action'] === 'update') {
            
            $pelanggan->updatePelanggan(); // Panggil method updatePelanggan
        } if (isset($_GET['action']) && $_GET['action'] === 'delete') {
            
            $pelanggan->deletePelanggan(); // Panggil method deletePelanggan
        } else {
            // Panggil method indexpelanggan untuk menampilkan data pelanggan
            $pelanggan->indexpelanggan();
        }
        
    } elseif ($page === 'barang') {
        require_once 'app/controllers/BarangController.php';
        require_once 'app/models/BarangModel.php';
        $barang = new BarangController();

        // Jika ada action 'update', panggil metode updateBarang()
        if (isset($_GET['action']) && $_GET['action'] === 'updatebarang') {
            $barang->updateBarang(); // Panggil method updatePelanggan
        } if (isset($_GET['action']) && $_GET['action'] === 'deletebarang') {
            
            $barang->deleteBarang(); // Panggil method deletePelanggan
        } else {
            // Panggil method indexpelanggan untuk menampilkan data pelanggan
            $barang->indexbarang();
        }

    } elseif ($page === 'transaksi') {
            require_once 'app/controllers/TransaksiController.php';
            require_once 'app/models/TransaksiModel.php';
            $transaksi = new TransaksiController();
    
            // Jika ada action 'update', panggil metode updateBarang()
            if (isset($_GET['action']) && $_GET['action'] === 'updatetransaksi') {
                $transaksi->updateTransaksi(); // Panggil method updatePelanggan
            } if (isset($_GET['action']) && $_GET['action'] === 'delettransaksi') {
                
                $transaksi->updateTransaksi(); // Panggil method deletePelanggan
            } else {
                // Panggil method indexpelanggan untuk menampilkan data pelanggan
                $transaksi->indextransaksi();
            }
    } else {
        // Default jika tidak ditemukan halaman
        echo "Halaman tidak ditemukan.";
    }
} else {
    // Default jika tidak ada parameter 'page'
    require_once 'app/controllers/HomeController.php';
    $app = new HomeController();
    $app->index(); // Menampilkan halaman default (Home)
}
