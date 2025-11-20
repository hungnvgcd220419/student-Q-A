<?php
// /template/post_detail.html.php

// 1. Nhúng header (đã có session_start())
require_once '../includes/header.php'; 
require_once '../includes/db_config.php';

// 2. Lấy ID bài đăng từ URL
if (!isset($_GET['id'])) {
    die("Error: Post ID not found.");
}
$post_id = $_GET['id'];

// 3. Truy vấn CSDL
try {
    $stmt = $pdo->prepare("
        SELECT posts.*, users.username, modules.module_name 
        FROM posts
        LEFT JOIN users ON posts.user_id = users.user_id
        LEFT JOIN modules ON posts.module_id = modules.module_id
        WHERE posts.post_id = ?
    ");
    $stmt->execute([$post_id]);
    $post = $stmt->fetch();

    if (!$post) {
        die("Error: Post does not exist.");
    }
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

// 4. KIỂM TRA QUYỀN SỞ HỮU (để hiện nút Sửa/Xóa)
$is_owner = false;
$is_admin = false;

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    if ($_SESSION['user_id'] == $post['user_id']) {
        $is_owner = true;
    }
    if ($_SESSION['role_id'] == 1) {
        $is_admin = true;
    }
}
?>
<div class="row justify-content-top align-items-top" style="min-height: 80vh;">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h1><?php echo htmlspecialchars($post['title']); ?></h1>
            
            <p class="text-muted">
                Posted by: <?php echo htmlspecialchars($post['username'] ?? 'N/A'); ?> | 
                Module: <?php echo htmlspecialchars($post['module_name'] ?? 'N/A'); ?> | 
                On: <?php echo date('H:i, d/m/Y', strtotime($post['create_at'])); ?>
            </p>
            <hr>

            <?php if (!empty($post['image_path'])): ?>
                <img src="../<?php echo htmlspecialchars($post['image_path']); ?>" class="img-fluid rounded mb-4" alt="Post Image">
            <?php endif; ?>

            <div class="post-content">
                <?php 
                // nl2br() để giữ lại các dấu xuống dòng
                echo nl2br(htmlspecialchars($post['content'])); 
                ?>
            </div>
            
            <hr>
            
            <?php if ($is_owner): ?>
                <div class="mt-4">              
                    <a href="edit_post.html.php?edit_id=<?php echo $post['post_id']; ?>" class="btn btn-warning">Edit Post</a>
                    <a href="../delete_post.php?id=<?php echo $post['post_id']; ?>" 
                    class="btn btn-danger" 
                    onclick="return confirm('Are you sure you want to delete this post?');">Delete Post</a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php
// 5. Nhúng footer
require_once '../includes/footer.php';
?>