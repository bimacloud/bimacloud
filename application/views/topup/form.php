<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top-Up Koin</h6>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('TopupCoins/process'); ?>" method="post">
                        <div class="form-group">
                            <label for="coin_amount">Pilih Jumlah Koin:</label>
                            <select name="coin_amount" id="coin_amount" class="form-control" required>
                                <option value="10000">10,000 Koin - Rp. 10,000</option>
                                <option value="20000">20,000 Koin - Rp. 20,000</option>
                                <option value="30000">30,000 Koin - Rp. 30,000</option>
                                <option value="40000">40,000 Koin - Rp. 40,000</option>
                                <option value="50000">50,000 Koin - Rp. 50,000</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="payment_method">Metode Pembayaran:</label>
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                <option value="BRI">BRI</option>
                                <option value="MANDIRI">MANDIRI</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
