<?php
// /delete_post.php

session_start();
require_once 'includes/db_config.php';

// BẢO MẬT: Phải đăng nhập
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to perform this action.");
}

// 1. Lấy ID
if (!isset($_GET['id'])) {
    die("Error: No ID provided.");
}
$post_id = $_GET['id'];
$current_user_id = $_SESSION['user_id'];
$current_role_id = $_SESSION['role_id'];

try {
    // 2. Lấy thông tin chủ sở hữu và ảnh
    $stmt = $pdo->prepare("SELECT user_id, image_path FROM posts WHERE post_id = ?");
    $stmt->execute([$post_id]);
    $post = $stmt->fetch();

    if (!$post) {
        die("Post not found.");
    }
    
    // 3. KIỂM TRA QUYỀN (Sở hữu HOẶC Admin)
    if ($post['user_id'] == $current_user_id || $current_role_id == 1) {
        
        // 4. TIẾN HÀNH XÓA
        // Xóa file ảnh trên server
        if ($post['image_path'] && file_exists($post['image_path'])) {
            unlink($post['image_path']);
        }
        
        // Xóa trong CSDL
        $stmt_delete = $pdo->prepare("DELETE FROM posts WHERE post_id = ?");
        $stmt_delete->execute([$post_id]);

        // Chuyển hướng về trang chủ
        header("Location: template/home.html.php?status=deleted");
        exit();

    } else {
        // Nếu không có quyền
        die("You do not have permission to delete this post.");
    }

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>