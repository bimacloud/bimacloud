<div class="container mt-5">
    <h2>Order VPN</h2>
    
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="m-0 font-weight-bold">Daftar Order VPN Anda</h5>
        </div>
        <div class="card-body">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <table class="table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Server</th>
                        <th>Port Forwarding</th>
                        <th>Remote Address</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($vpn_services)): ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada order VPN</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($vpn_services as $service): ?>
                            <tr>
                                <td><?= $service['username']; ?></td>
                                <td><?= $service['server']; ?></td>
                                <td><?= $service['port_forwarding']; ?></td>
                                <td><?= $service['remote_address']; ?></td>
                                <td>Aktif</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
