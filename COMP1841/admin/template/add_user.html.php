<?php
// /admin/template/add_user.html.php

require_once '../../includes/admin_check.php';
require_once '../../includes/header_admin.php';
require_once '../../includes/db_config.php'; // Cần CSDL để lấy Roles

// Lấy danh sách Roles cho dropdown
$roles = $pdo->query("SELECT * FROM roles")->fetchAll();
?>
<div class="row justify-content-top align-items-top" style="min-height: 80vh;">

    <form action="../add_user.php" method="POST">
    <h2 class="mb-3">Add New User</h2>

        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="role_id" class="form-label">Role:</label>
            <select class="form-select" id="role_id" name="role_id" required>
                <option value="">-- Select Role --</option>
                <?php foreach ($roles as $role): ?>
                    <option value="<?php echo $role['role_id']; ?>">
                        <?php echo htmlspecialchars($role['role_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Add User</button>
        <a href="manage_users.html.php" class="btn btn-secondary">Cancel</a>
    </form>

</div>
<?php 
require_once '../../includes/footer.php'; 
?>