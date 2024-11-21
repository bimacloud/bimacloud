<div class="container mt-5">
    <div class="row">
        <!-- Card untuk Menampilkan Jumlah Koin -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0 font-weight-bold">Jumlah Koin Anda</h5>
                </div>
                <div class="card-body text-center">
                    <h2><?= $coins; ?> Koin</h2>
                    <p class="text-muted">Saldo koin yang tersedia di akun Anda.</p>
                </div>
            </div>
        </div>

        <!-- Card untuk Form Topup Koin -->
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="m-0 font-weight-bold">Top-Up Koin</h5>
                </div>
                <div class="card-body">
                    <!-- Form Top-Up Koin -->
                    <form action="<?= site_url('Coins/add_coins'); ?>" method="post">
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Jenis Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                <option value="" disabled selected>Pilih Jenis Pembayaran</option>
                                <option value="BRI">Bank BRI</option>
                                <option value="OVO">OVO</option>
                                <option value="Dana">Dana</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="coins" class="form-label">Masukkan Jumlah Koin</label>
                            <select name="coins" id="coins" class="form-control" required>
                                <option value="" disabled selected>Pilih Jumlah Koin</option>
                                <option value="10000">10.000 Coins = Rp. 10.000</option>
                                <option value="20000">20.000 Coins = Rp. 20.000</option>
                                <option value="30000">30.000 Coins = Rp. 30.000</option>
                                <option value="40000">40.000 Coins = Rp. 40.000</option>
                                <option value="50000">50.000 Coins = Rp. 50.000</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Top-Up Koin</button>
                    </form>
                    
                    <!-- Pesan Error atau Sukses -->
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger mt-3">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success mt-3">
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Transaksi Top-Up Koin -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="m-0 font-weight-bold">Riwayat Transaksi Top-Up</h5>
                </div>
                <div class="card-body">
                    <!-- Tabel Riwayat Transaksi -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Metode Pembayaran</th>
                                <th>Jumlah Koin</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($transactions)): ?>
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada transaksi top-up</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($transactions as $transaction): ?>
                                    <tr>
                                        <td><?= date('d M Y H:i', strtotime($transaction['created_at'])); ?></td>
                                        <td><?= $transaction['payment_method']; ?></td>
                                        <td><?= number_format($transaction['coins_amount']); ?> Koin</td>
                                        <td>
                                            <span class="badge <?= $transaction['transaction_status'] == 'unpaid' ? 'bg-warning' : 'bg-success'; ?>">
                                                <?= ucfirst($transaction['transaction_status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($transaction['transaction_status'] == 'unpaid'): ?>
                                                <!-- Button Bayar -->
                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paymentModal" data-transaction-id="<?= $transaction['transaction_id']; ?>" data-payment-method="<?= $transaction['payment_method']; ?>">Bayar</button>
                                                
                                                <!-- Button Cancel -->
                                                <a href="<?= site_url('Coins/cancel_transaction/'.$transaction['transaction_id']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan transaksi ini?');">Cancel</a>
                                            <?php else: ?>
                                                <span class="text-muted">Sudah Diproses</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Pembayaran -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Metode Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="paymentDetails">
                    <!-- Konten akan berubah sesuai dengan metode pembayaran yang dipilih -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Konfirmasi Pembayaran</button>
            </div>
        </div>
    </div>
</div>

<!-- Link Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Mengubah konten modal sesuai dengan metode pembayaran yang dipilih
    const paymentModal = document.getElementById('paymentModal');
    paymentModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Tombol yang memicu modal
        const paymentMethod = button.getAttribute('data-payment-method'); // Mengambil metode pembayaran
        const transactionId = button.getAttribute('data-transaction-id'); // Mengambil ID transaksi

        const paymentDetails = document.getElementById('paymentDetails');

        if (paymentMethod === 'OVO') {
            paymentDetails.innerHTML = `
                <h6>QRIS OVO</h6>
                <img src="https://example.com/qris-ovo.png" alt="QRIS OVO" class="img-fluid">
                <p>Silakan scan QRIS di atas untuk melakukan pembayaran menggunakan OVO.</p>
            `;
        } else if (paymentMethod === 'BRI') {
            paymentDetails.innerHTML = `
                <h6>Bank BRI</h6>
                <p>Nama: John Doe</p>
                <p>No. Rekening: 1234567890</p>
                <p>Silakan transfer jumlah yang tertera ke rekening di atas untuk menyelesaikan pembayaran.</p>
            `;
        } else {
            paymentDetails.innerHTML = `<p>Metode pembayaran tidak dikenali.</p>`;
        }
    });
</script>
