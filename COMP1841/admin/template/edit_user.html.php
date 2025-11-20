<?php
// /admin/template/edit_user.html.php

require_once '../../includes/admin_check.php';
require_once '../../includes/header_admin.php';
require_once '../../includes/db_config.php';

// 1. Lấy ID từ URL
if (!isset($_GET['edit_id'])) {
    die("Error: User ID not found.");
}
$user_id = $_GET['edit_id'];

// 2. Lấy thông tin user cần sửa
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    
    if (!$user) {
        die("User not found with this ID.");
    }
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

// 3. Lấy danh sách Roles
$roles = $pdo->query("SELECT * FROM roles")->fetchAll();
?>
<div class="row justify-content-top align-items-top" style="min-height: 80vh;">

    <form action="../edit_user.php" method="POST">
        <h2 class="mb-3">Edit User</h2>
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>">

        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" 
                value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" 
                value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password:</label>
            <input type="password" class="form-control" id="password" name="password">
            <div class="form-text">Leave blank if you don't want to change the password.</div>
        </div>

        <div class="mb-3">
            <label for="role_id" class="form-label">Role:</label>
            <select class="form-select" id="role_id" name="role_id" required>
                <?php foreach ($roles as $role): ?>
                    <option value="<?php echo $role['role_id']; ?>" <?php echo ($role['role_id'] == $user['role_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($role['role_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Update User</button>
        <a href="manage_users.html.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php 
require_once '../../includes/footer.php'; 
?>