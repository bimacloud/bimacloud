<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="<?= base_url('assets/img/logo-purple.png'); ?>" style="height:50px;">
                        </div>
                        <div class="col-md-4 text-right">
                            <h3>INVOICE #<?= isset($invoice['invoice_id']) ? $invoice['invoice_id'] : 'N/A'; ?></h3>
                            <div class="m-0">Status: <h1 class="text-danger"><?= isset($invoice['status']) ? $invoice['status'] : 'N/A'; ?></h1></div>
                            <div class="mb-3">Tanggal Terbit: <?= isset($invoice['invoice_date']) ? date('Y-m-d', strtotime($invoice['invoice_date'])) : 'N/A'; ?></div>
                            <div>
                                <a href="<?= site_url('TopupCoins/approve_invoice/' . $invoice['invoice_id']); ?>" class="btn btn-success btn-block btn-sm">Approve Topup</a>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-12">
                            <b>Tertuju Kepada :</b><br>
                            <?= isset($invoice['username']) ? $invoice['username'] : 'N/A'; ?><br>
                            <?= isset($invoice['email']) ? $invoice['email'] : 'N/A'; ?><br>
                            <?= isset($invoice['phone']) ? $invoice['phone'] : 'N/A'; ?><br>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-12 table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="10%" class="text-center"><b>No.</b></th>
                                        <th width="70%" class="text-center"><b>Keterangan</b></th>
                                        <th width="20%" class="text-right"><b>Jumlah (Rp.)</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>Pembelian <?= isset($invoice['coin_amount']) ? number_format($invoice['coin_amount']) : 'N/A'; ?> Koin</td>
                                        <td class="text-right">Rp. <?= isset($invoice['total_amount']) ? number_format($invoice['total_amount']) : 'N/A'; ?></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="text-right"><b>Total</b></td>
                                        <td class="text-right">Rp. <?= isset($invoice['total_amount']) ? number_format($invoice['total_amount']) : 'N/A'; ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mb-5">
                <a href="<?= site_url('TopupCoins/download_invoice/' . $invoice['invoice_id']); ?>" class="btn btn-primary">Download PDF</a>
            </div>
        </div>
    </div>
</div>
