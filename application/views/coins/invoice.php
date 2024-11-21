<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="http://localhost/appbima/assets/img/logo-purple.png" style="height:50px;">
                        </div>
                        <div class="col-md-4" align="right">
                            <h3>INVOICE #<?= $invoice_id ?></h3>
                            <div class="m-0">Status : <h1 class="text-danger"><?= $status ?></h1></div>
                            <div class="mb-3">Tanggal Terbit : <?= $purchase_date ?></div>
                            <div>
                                <a href="<?= site_url('Coins/topup') ?>" class="btn btn-info btn-block btn-sm">Edit Topup</a>
                                <a href="#" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#modal_koin_bayar">Bayar Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-12">
                            <b>Tertuju Kepada :</b><br>
                            <?= $full_name ?><br>
                            <?= $email ?><br>
                            <?= $whatsapp ?><br>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-12 table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="10%" align="center"><b>No.</b></th>
                                        <th width="70%" align="center"><b>Keterangan</b></th>
                                        <th width="20%" style="text-align: right;"><b>Jumlah (Rp.)</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td align="center">1</td>
                                        <td>Pembelian <?= number_format($coins) ?> Koin</td>
                                        <td align="right">Rp. <?= number_format($price) ?></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" align="right"><b>Total</b></td>
                                        <td align="right">Rp. <?= number_format($price) ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div align="center" class="mb-5">
                <a href="<?= site_url('Coins/download_pdf/'.$invoice_id) ?>" class="btn btn-primary">Download PDF</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Payment -->
<div class="modal fade" id="modal_koin_bayar" tabindex="-1" role="dialog" aria-labelledby="modal_koin_bayarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_koin_bayarLabel">Pembayaran Koin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Anda akan melakukan pembayaran sebesar Rp. <?= number_format($price) ?> untuk membeli <?= number_format($coins) ?> koin.</p>
                <form action="<?= site_url('Coins/process_payment/'.$invoice_id) ?>" method="POST">
                    <button type="submit" class="btn btn-success">Lanjutkan Pembayaran</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
