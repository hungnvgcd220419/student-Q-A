<?php
// /admin/add_user.php

// 1. SECURITY & DATABASE
require_once '../includes/admin_check.php';
require_once '../includes/db_config.php';

if (isset($_POST['submit'])) {
    
    // Get data from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    // Hash the password (Required)
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Save to Database
        $sql = "INSERT INTO users (username, email, password_hash, role_id, create_at) 
                VALUES (?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email, $password_hash, $role_id]);
        
        // Redirect back to the management page (in the same admin folder)
        header("Location: template/manage_users.html.php?status=added");
        exit();
        
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') { // Duplicate entry error
            die("Error: This username or email already exists.");
        } else {
            die("Database Error: " . $e->getMessage());
        }
    }
}
?>