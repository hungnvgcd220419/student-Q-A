<?php
// /admin/template/edit_module.html.php

require_once '../../includes/admin_check.php';
require_once '../../includes/header_admin.php';
require_once '../../includes/db_config.php'; // Cần CSDL để lấy thông tin cũ

// 1. Kiểm tra ID trên URL
if (!isset($_GET['edit_id'])) {
    die("Error: No module ID provided.");
}
$module_id = $_GET['edit_id'];

// 2. Lấy thông tin môn học cần sửa
try {
    $stmt = $pdo->prepare("SELECT * FROM modules WHERE module_id = ?");
    $stmt->execute([$module_id]);
    $module = $stmt->fetch();
    
    if (!$module) {
        die("Error: No module found with this ID.");
    }
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>
<div class="row justify-content-top align-items-top" style="min-height: 80vh;">

    <form action="../edit_module.php" method="POST">
        <h2 class="mb-3">Edit Module</h2>
        <input type="hidden" name="module_id" value="<?php echo htmlspecialchars($module['module_id']); ?>">

        <div class="mb-3">
            <label for="module_code" class="form-label">Module Code (e.g., COMP1841):</label>
            <input type="text" class="form-control" id="module_code" name="module_code" 
                value="<?php echo htmlspecialchars($module['module_code']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="module_name" class="form-label">Module Name:</label>
            <input type="text" class="form-control" id="module_name" name="module_name" 
                value="<?php echo htmlspecialchars($module['module_name']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($module['description']); ?></textarea>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
        <a href="manage_modules.html.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php 
require_once '../../includes/footer.php'; 
?>