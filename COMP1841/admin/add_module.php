<?php
// /admin/add_module.php
require_once '../includes/admin_check.php';
require_once '../includes/db_config.php';

if (isset($_POST['submit'])) {
    try {
        $sql = "INSERT INTO modules (module_name, module_code, description) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['module_name'], $_POST['module_code'], $_POST['description']]);
        
        // Redirect to manage_modules page with a success status
        header("Location: template/manage_modules.html.php?status=added");
        exit();
    } catch (PDOException $e) {
        // Check for duplicate entry error (SQLSTATE 23000)
        if ($e->getCode() == '23000') {
            die("Error: This module code already exists.");
        }
        // Handle other database errors
        die("Database Error: " . $e->getMessage());
    }
}
?>