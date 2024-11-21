<h2>Tambah Router MikroTik</h2>
<form action="<?= site_url('Router/add_router'); ?>" method="post">
    <div class="form-group">
        <label>Nama Router</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>IP Address</label>
        <input type="text" name="ip_address" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Port (Default 8728)</label>
        <input type="text" name="port" class="form-control" value="8728">
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save Router</button>
</form>
