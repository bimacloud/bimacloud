<div class="container mt-5">
    <h2>Order VPN Baru</h2>
    
    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="m-0 font-weight-bold">Form Order VPN</h5>
        </div>
        <div class="card-body">
            <!-- Menampilkan pesan error atau success -->
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>
            
            <?= form_open('Vpn_service/create_order', ['id' => 'vpnForm']); ?>
            
            <!-- Pilihan Server di atas -->
            <div class="mb-3">
                <label for="server" class="form-label">Server</label>
                <select name="server" id="server" class="form-control" required>
                    <option value="">Pilih Server</option>
                    <?php foreach ($servers as $server): ?>
                        <option value="<?= $server; ?>"><?= $server; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Username dan Password sebelah kiri-kanan -->
            <div class="row mb-3">                
                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Please Insert Username" maxlength="10" required>
                        <div class="input-group-prepend">
                            <div class="input-group-text">@bimaapp.com</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" required>
                </div>
            </div>

            <!-- Port Forwarding di bawah -->
            <div class="mb-3">
                <label for="port_forwarding" class="form-label">Port Forwarding</label>
                <input type="text" class="form-control" id="port_forwarding" name="port_forwarding" required>
            </div>

            <button type="submit" class="btn btn-primary">Order VPN</button>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<!-- Modal Alert Username Sudah Digunakan -->
<div class="modal fade" id="usernameExistsModal" tabindex="-1" role="dialog" aria-labelledby="usernameExistsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usernameExistsModalLabel">Username Sudah Digunakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Username yang Anda masukkan sudah digunakan. Silakan pilih username lain.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Menambahkan @bimaapp.com ke Username sebelum form disubmit
    document.getElementById('vpnForm').addEventListener('submit', function (event) {
        var usernameField = document.getElementById('username');
        var username = usernameField.value;

        // Cek apakah username belum mengandung @bimaapp.com
        if (username && !username.includes('@bimaapp.com')) {
            usernameField.value = username + '@bimaapp.com';
        }
    });

    // Fungsi untuk mengecek apakah username sudah ada di database (melalui AJAX)
    document.getElementById('username').addEventListener('blur', function() {
        var username = this.value + '@bimaapp.com';  // Tambahkan @bimaapp.com

        if (username) {
            // Kirim permintaan AJAX untuk memeriksa ketersediaan username
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= base_url('Vpn_service/check_username_exists'); ?>', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.exists) {
                        // Tampilkan modal jika username sudah ada
                        $('#usernameExistsModal').modal('show');
                    }
                }
            };
            xhr.send('username=' + username);
        }
    });
</script>
