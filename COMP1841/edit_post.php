<?php
// /edit_post.php

session_start();
require_once 'includes/db_config.php';

// 1. BẢO MẬT: Phải đăng nhập
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to perform this action.");
}

if (isset($_POST['submit'])) {
    
    // 2. Lấy dữ liệu từ form
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $module_id = $_POST['module_id'];
    $image_path = $_POST['existing_image_path'] ?? ''; // Giữ ảnh cũ mặc định

    $current_user_id = $_SESSION['user_id'];
    $current_role_id = $_SESSION['role_id'];

    // 3. KIỂM TRA QUYỀN SỞ HỮU HOẶC ADMIN
    // Lấy thông tin người sở hữu bài viết hiện tại
    $stmt_check = $pdo->prepare("SELECT user_id FROM posts WHERE post_id = ?");
    $stmt_check->execute([$post_id]);
    $post_owner = $stmt_check->fetch();

    if (!$post_owner) {
        die("Post not found.");
    }

    // Nếu không phải chủ bài viết VÀ không phải Admin -> Chặn
    if ($post_owner['user_id'] != $current_user_id && $current_role_id != 1) {
        die("You do not have permission to edit this post.");
    }

    // 4. Xử lý Upload Ảnh MỚI (nếu có)
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $file_name = uniqid() . '_' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file; // Cập nhật đường dẫn mới
        }
    }

    // 5. Chuẩn bị dữ liệu cập nhật
    // Mặc định giữ nguyên user_id cũ (cho trường hợp User sửa bài)
    $new_user_id = $post_owner['user_id'];

    // Nếu là Admin và có chọn user mới từ form -> Cập nhật user_id
    if ($current_role_id == 1 && isset($_POST['user_id'])) {
        $new_user_id = $_POST['user_id'];
    }

    // 6. Cập nhật CSDL
    try {
        $sql = "UPDATE posts SET title = ?, content = ?, module_id = ?, image_path = ?, user_id = ? 
                WHERE post_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $content, $module_id, $image_path, $new_user_id, $post_id]);
        
        // Chuyển hướng ngay lập tức về trang chi tiết
        header("Location: template/post_detail.html.php?id=" . $post_id . "&status=updated");
        exit();
        
    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}
?>