<h2>Create User</h2>
<form method="post" action="<?= site_url('User/store'); ?>">
    <label>Username:</label>
    <input type="text" name="username" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <label>Email:</label>
    <input type="email" name="email"><br>

    <label>Role:</label>
    <select name="role_id" required>
        <?php foreach ($roles as $role): ?>
            <option value="<?= $role['role_id']; ?>"><?= $role['role_name']; ?></option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit">Save</button>
</form>
