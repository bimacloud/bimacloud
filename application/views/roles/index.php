<h2>List of Roles</h2>
<table>
    <tr>
        <th>Role Name</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($roles as $role): ?>
        <tr>
            <td><?= $role['role_name']; ?></td>
            <td>
                <a href="<?= site_url('Role/edit/' . $role['role_id']); ?>">Edit</a>
                <a href="<?= site_url('Role/delete/' . $role['role_id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="<?= site_url('Role/create'); ?>">Add New Role</a>
