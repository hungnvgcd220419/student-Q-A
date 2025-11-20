<?php
// /admin/delete_module.php
require_once '../includes/admin_check.php';
require_once '../includes/db_config.php';

if (!isset($_GET['id'])) {
    die("Error: No ID provided.");
}

try {
    $stmt = $pdo->prepare("DELETE FROM modules WHERE module_id = ?");
    $stmt->execute([$_GET['id']]);

    header("Location: template/manage_modules.html.php?status=deleted");
    exit();

} catch (PDOException $e) {
    // Foreign key constraint violation
    if ($e->getCode() == '23000') { 
        die("Error: Cannot delete this module. There are still posts associated with this module. (Foreign key constraint)");
    }
    die("Database Error: " . $e->getMessage());
}
?>