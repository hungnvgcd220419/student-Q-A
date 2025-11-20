<?php
// /admin/delete_user.php

require_once '../includes/admin_check.php';
require_once '../includes/db_config.php';

if (!isset($_GET['id'])) {
    die("Error: No ID provided.");
}
$user_id = $_GET['id'];

try {
    // Execute the DELETE statement
    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);

    // Redirect
    header("Location: template/manage_users.html.php?status=deleted");
    exit();

} catch (PDOException $e) {
    // Catch Foreign Key violation (if the user still has posts or messages)
    if ($e->getCode() == '23000') {
        die("Error: Cannot delete this user. They still have posts or contact messages in the system. (Foreign key constraint)");
    } else {
        die("Database Error: " . $e->getMessage());
    }
}
?>