<?php
// /admin/template/manage_users.html.php

// 1. BẢO MẬT: Kiểm tra admin
require_once '../../includes/admin_check.php';
// 2. HEADER: Gọi header admin
require_once '../../includes/header_admin.php';
// 3. CSDL: Kết nối CSDL
require_once '../../includes/db_config.php';

// Lấy tất cả user, JOIN với bảng Roles
$stmt = $pdo->query("
    SELECT users.*, roles.role_name 
    FROM users 
    LEFT JOIN roles ON users.role_id = roles.role_id
    ORDER BY users.user_id
");
$users = $stmt->fetchAll();
?>
<div style="min-height: 80vh;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>User Management</h2>
        <a href="add_user.html.php" class="btn btn-primary">Add New User</a>
    </div>

    <div class="row">
        <?php if (empty($users)): ?>
            <div class="col">
                <div class="alert alert-info text-center">
                    No users found.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($users as $user): ?>
                <div class="mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <?php echo htmlspecialchars($user['username']); ?>
                            </h5>
                            <h6 class="card-subtitle mb-2">
                                <span class="badge bg-secondary"><?php echo htmlspecialchars($user['role_name']); ?></span>
                            </h6>
                            
                            <p class="card-text">
                                <strong>ID:</strong> <?php echo htmlspecialchars($user['user_id']); ?><br>
                                <strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?>
                            </p>
                            
                            <div class="mt-auto">
                                <hr>
                                <a href="edit_user.html.php?edit_id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                
                                <a href="../delete_user.php?id=<?php echo $user['user_id']; ?>" 
                                class="btn btn-sm btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <small>Created: <?php echo date('d/m/Y', strtotime($user['create_at'])); ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?php
// 4. GỌI FOOTER:
require_once '../../includes/footer.php'; 
?>