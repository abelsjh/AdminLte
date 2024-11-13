
$(document).ready(function () {
    // Event ketika modal edit dibuka
    $('#editModal').on('show.bs.modal', function (event) {
        
        
        const button = $(event.relatedTarget); // Tombol yang memicu modal
        const idtrans = button.data('id_trans');
        

        const modal = $(this);
        modal.find('#editid_trans').val(idtrans);
        
    });

    // Form submit untuk update data pelanggan
    $('#editForm').on('submit', function (event) {
        event.preventDefault(); // Mencegah form dari submit biasa

        // Ambil data dari form
        const id = $('#editTrans').val();
        const nama = $('#editNama').val();
        const harga = $('#editHarga').val();
        const stok = $('#editStok').val();

        // Kirim data menggunakan AJAX ke controller untuk update
        $.ajax({
            url: 'index.php?page=barang&action=updatebarang',
            type: 'POST',
            data: {
                id: id,
                nama: nama,
                harga: harga,
                stok: stok
            },
            success: function (response) {
                // Handle response from server (success atau error)

                const result = JSON.parse(response);
                if (result.status === 'success') {
                    alert(result.message); // Menampilkan pesan sukses
                    $('#editModal').modal('hide'); // Tutup modal
                    location.reload(); // Reload halaman untuk menampilkan data terbaru
                } else {
                    alert(result.message); // Menampilkan pesan error
                }
            },
            error: function () {
                alert('Terjadi kesalahan saat memperbarui data.');
            }
        });
    });

    $('#hapusModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget); // Tombol yang memicu modal
        const id = button.data('id');
        
        

        const modal = $(this);
        modal.find('#hapusId').val(id); // Menyusun id ke input hidden
    });

    // Event untuk submit form hapus
    $('#hapusForm').submit(function (e) {
        e.preventDefault(); // Mencegah pengiriman form biasa

        var id = $('#hapusId').val(); // Ambil id dari input hidden
        var formData = $(this).serialize(); // Mengambil data form

        $.ajax({
            url: 'index.php?page=barang&action=deletebarang',
            type: 'POST',
            data: {
                id: id
            },
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    $('#hapusModal').modal('hide');
                    alert(result.message);
                    location.reload();
                } else {
                    alert(result.message);
                }
            },
            error: function () {
                alert('Terjadi kesalahan saat mengirim data.');
            }
        });
    });

});
