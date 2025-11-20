<?php
// /user_add_post.php

session_start();
require_once 'includes/db_config.php';

// BẢO MẬT: Phải đăng nhập
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in.");
}

if (isset($_POST['submit'])) {
    
    // ... (Toàn bộ code logic lấy dữ liệu, upload ảnh) ...
    $user_id = $_SESSION['user_id']; 
    $title = $_POST['title'];
    $content = $_POST['content'];
    $module_id = $_POST['module_id'];
    $image_path = ''; 

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $file_name = uniqid() . '_' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        }
    }

    try {
        $sql = "INSERT INTO posts (title, content, user_id, module_id, image_path, create_at) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $content, $user_id, $module_id, $image_path]);
        
        // =================================================
        // THAY ĐỔI: Chuyển hướng ngay lập tức
        // =================================================
        header("Location: template/home.html.php?status=added");
        exit();
        
    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}
?>