<?php
// /admin/edit_post.php

require_once '../includes/admin_check.php';
require_once '../includes/db_config.php';

if (isset($_POST['submit'])) {
    
    // ... (Toàn bộ code logic lấy dữ liệu, xử lý ảnh) ...
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $module_id = $_POST['module_id'];
    $user_id = $_POST['user_id'];
    $image_path = $_POST['existing_image_path'] ?? '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../uploads/";
        $file_name = uniqid() . '_' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = "uploads/" . $file_name;
        }
    }

    // 3. Cập nhật CSDL
    try {
        $sql = "UPDATE posts SET title = ?, content = ?, module_id = ?, image_path = ?, user_id = ? 
                WHERE post_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $content, $module_id, $image_path, $user_id, $post_id]);
        
        // =================================================
        // THAY ĐỔI: Chuyển hướng ngay lập tức
        // =================================================
        header("Location: template/manage_posts.html.php?status=updated");
        exit();
        
    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}
?>