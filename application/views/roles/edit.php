<h2>Edit Role</h2>
<form method="post" action="<?= site_url('Role/update/' . $role['role_id']); ?>">
    <label>Role Name:</label>
    <input type="text" name="role_name" value="<?= $role['role_name']; ?>" required><br>
    <button type="submit">Update</button>
</form>
