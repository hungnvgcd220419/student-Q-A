<?php
// /admin/edit_module.php
require_once '../includes/admin_check.php';
require_once '../includes/db_config.php';

if (isset($_POST['submit'])) {
    try {
        $sql = "UPDATE modules SET module_name = ?, module_code = ?, description = ? WHERE module_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['module_name'], $_POST['module_code'], $_POST['description'], $_POST['module_id']]);
        
        header("Location: template/manage_modules.html.php?status=updated");
        exit();
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            die("Error: This module code already exists for another module.");
        }
        die("Database Error: " . $e->getMessage());
    }
}
?>