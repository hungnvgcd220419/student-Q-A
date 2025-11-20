<?php
// /admin/delete_post.php

// 1. BẢO MẬT & CSDL
// (Đường dẫn: đi lên 1 cấp)
require_once '../includes/admin_check.php';
require_once '../includes/db_config.php';

// 2. Lấy ID từ URL
if (!isset($_GET['id'])) {
    die("Error: No ID provided.");
}
$post_id = $_GET['id'];

try {
    // Admin không cần kiểm tra quyền sở hữu

    // 3. Lấy ảnh để xóa file (Chú ý đường dẫn ../)
    $stmt = $pdo->prepare("SELECT image_path FROM posts WHERE post_id = ?");
    $stmt->execute([$post_id]);
    $post = $stmt->fetch();

    if ($post && $post['image_path'] && file_exists("../" . $post['image_path'])) {
        unlink("../" . $post['image_path']); 
    }
    
    // 4. Xóa trong CSDL
    $stmt_delete = $pdo->prepare("DELETE FROM posts WHERE post_id = ?");
    $stmt_delete->execute([$post_id]);

    // 5. Chuyển hướng về trang quản lý
    header("Location: template/manage_posts.html.php?status=deleted");
    exit();

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>