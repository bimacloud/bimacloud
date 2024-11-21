<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topup Coins</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Topup Coins</h3>
        </div>
        <div class="card-body">
            <p>Choose the number of coins you'd like to purchase:</p>

            <form action="<?= site_url('Coins/process_topup'); ?>" method="post">
                <!-- Option 1: 10,000 coins for Rp 10,000 -->
                <div class="mb-3">
                    <button type="submit" name="amount" value="10000" class="btn btn-primary w-100">10,000 Coins - Rp 10,000</button>
                </div>
                
                <!-- Option 2: 25,000 coins for Rp 25,000 -->
                <div class="mb-3">
                    <button type="submit" name="amount" value="25000" class="btn btn-primary w-100">25,000 Coins - Rp 25,000</button>
                </div>

                <!-- Option 3: 35,000 coins for Rp 35,000 -->
                <div class="mb-3">
                    <button type="submit" name="amount" value="35000" class="btn btn-primary w-100">35,000 Coins - Rp 35,000</button>
                </div>

                <!-- Option 4: 50,000 coins for Rp 50,000 -->
                <div class="mb-3">
                    <button type="submit" name="amount" value="50000" class="btn btn-primary w-100">50,000 Coins - Rp 50,000</button>
                </div>

                <!-- Option 5: 100,000 coins for Rp 100,000 -->
                <div class="mb-3">
                    <button type="submit" name="amount" value="100000" class="btn btn-primary w-100">100,000 Coins - Rp 100,000</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
