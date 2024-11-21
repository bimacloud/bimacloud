<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Order VPN</h6>
                </div>
                <div class="card-body">
                
                    <h2>Daftar Router MikroTik</h2>
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <th>IP Address</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        <?php foreach ($routers as $router): ?>
                            <tr>
                                <td><?= $router['name']; ?></td>
                                <td><?= $router['ip_address']; ?></td>
                                <td><?= ucfirst($router['status']); ?></td>
                                <td>
                                    <!-- Tombol Test Koneksi dengan AJAX -->
                                    <button class="btn btn-primary" onclick="testKoneksi(<?= $router['id']; ?>)">Test Koneksi</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <a href="<?= site_url('Router/add_router'); ?>" class="btn btn-success">Add New Router</a>
                
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Modal untuk Menampilkan Hasil Koneksi -->
<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultModalLabel">Hasil Test Koneksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Konten hasil koneksi akan ditampilkan di sini -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Mengirim Permintaan AJAX dan Menampilkan Modal -->
<script>
function testKoneksi(routerId) {
    // Kirim permintaan AJAX untuk menguji koneksi
    $.ajax({
        url: '<?= site_url('Router/connect_to_router'); ?>/' + routerId,
        method: 'GET',
        success: function(response) {
            // Masukkan respons ke dalam konten modal dan tampilkan modal
            $('#modalContent').html(response);
            $('#resultModal').modal('show');
        },
        error: function() {
            // Tampilkan pesan kesalahan jika gagal
            $('#modalContent').html('Gagal melakukan koneksi ke server.');
            $('#resultModal').modal('show');
        }
    });
}
</script>
