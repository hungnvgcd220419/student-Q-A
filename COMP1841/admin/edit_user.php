<?php
// /admin/edit_user.php

require_once '../includes/admin_check.php';
require_once '../includes/db_config.php';

if (isset($_POST['submit'])) {
    
    // Get data
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // New password (can be empty)
    $role_id = $_POST['role_id'];

    try {
        // Build the SQL statement
        $sql_parts = ["username = ?", "email = ?", "role_id = ?"];
        $params = [$username, $email, $role_id];
        
        // Only update the password IF the user enters a new one
        if (!empty($password)) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql_parts[] = "password_hash = ?";
            $params[] = $password_hash;
        }
        
        // Add user_id to the end of the params array for the WHERE clause
        $params[] = $user_id; 
        
        // Join the parts together
        $sql = "UPDATE users SET " . implode(", ", $sql_parts) . " WHERE user_id = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        
        // Redirect
        header("Location: template/manage_users.html.php?status=updated");
        exit();
        
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            die("Error: This username or email already exists for another user.");
        } else {
            die("Database Error: " . $e->getMessage());
        }
    }
}
?>