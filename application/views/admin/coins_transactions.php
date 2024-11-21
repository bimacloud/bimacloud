<div class="container mt-5">
    <div class="row">
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
                                                <!-- Button Approve -->
                                                <a href="<?= site_url('Admin_Coins/approve/' . $transaction['transaction_id']); ?>" class="btn btn-success">Approve</a>
                                                <!-- Button Cancel -->
                                                <a href="<?= site_url('Admin_Coins/cancel/' . $transaction['transaction_id']); ?>" class="btn btn-danger">Cancel</a>
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
