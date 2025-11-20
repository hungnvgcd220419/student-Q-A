<?php
// /admin/template/manage_modules.html.php

// 1. BẢO MẬT: Kiểm tra admin
require_once '../../includes/admin_check.php';
// 2. HEADER: Gọi header admin
require_once '../../includes/header_admin.php';
// 3. CSDL: Kết nối CSDL
require_once '../../includes/db_config.php';

// Lấy tất cả môn học
$modules = $pdo->query("SELECT * FROM modules ORDER BY module_code")->fetchAll();
?>
<div style="min-height: 80vh;">
    <div class="row">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Module Management</h2>
            <a href="add_module.html.php" class="btn btn-primary">Add New Module</a>
        </div>
        <?php if (empty($modules)): ?>
            <div class="col">
                <div class="alert alert-info text-center">
                    No modules found.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($modules as $module): ?>
                <div class="mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($module['module_name']); ?></h5>
                            <h6 class="card-subtitle mb-2">
                                <span class="badge bg-info text-dark"><?php echo htmlspecialchars($module['module_code']); ?></span>
                            </h6>
                            <p class="card-text">
                                <?php echo htmlspecialchars($module['description'] ?? 'No description provided.'); ?>
                            </p>
                            
                            <div class="mt-auto">
                                <hr>
                                <a href="edit_module.html.php?edit_id=<?php echo $module['module_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="../delete_module.php?id=<?php echo $module['module_id']; ?>" 
                                class="btn btn-sm btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this module?');">Delete</a>
                            </div>
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