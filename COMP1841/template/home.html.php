<?php
// /template/home.html.php

// 1. Nhúng header (giao diện người dùng)
// (Đường dẫn: đi lên 1 cấp, vào 'includes')
require_once '../includes/header.php'; 
// 2. Nhúng file kết nối CSDL
require_once '../includes/db_config.php';

// 3. Truy vấn CSDL để lấy tất cả bài đăng
try {
    $stmt = $pdo->query("
        SELECT posts.*, users.username, modules.module_name 
        FROM posts
        LEFT JOIN users ON posts.user_id = users.user_id
        LEFT JOIN modules ON posts.module_id = modules.module_id
        ORDER BY posts.create_at DESC
    ");
    $posts = $stmt->fetchAll();

} catch (PDOException $e) {
    die("Lỗi khi truy vấn CSDL: " . $e->getMessage());
}
?>
<div class="row justify-content-top align-items-top" style="min-height: 80vh;">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Recent Posts</h1>
        </div>
    </div>

    <div class="row">
        <?php if (empty($posts)): ?>
            <div class="col">
                <p class="text-center">No Posts Recently </p>
            </div>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="col-md-8 mb-4 mx-auto">
                    <div class="card shadow-sm">
                        
                        <?php 
                        // Kiểm tra nếu có ảnh
                        // Đường dẫn: đi lên 1 cấp, vào 'uploads'
                        if (!empty($post['image_path'])): 
                        ?>
                            <img src="../<?php echo htmlspecialchars($post['image_path']); ?>" class="card-img-top" alt="Post Image" style="max-height: 400px; object-fit: cover;">
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                User: <?php echo htmlspecialchars($post['username'] ?? 'N/A'); ?> 
                                | Module: <?php echo htmlspecialchars($post['module_name'] ?? 'N/A'); ?>
                            </h6>
                            <p class="card-text">
                                <?php 
                                // Rút gọn nội dung
                                echo htmlspecialchars(substr($post['content'], 0, 200)); 
                                if (strlen($post['content']) > 200) echo '...';
                                ?>
                            </p>
                            <a href="post_detail.html.php?id=<?php echo $post['post_id']; ?>" class="btn btn-primary">See Detals</a>
                        </div>
                        <div class="card-footer text-muted">
                            Create At: <?php echo date('H:i, d/m/Y', strtotime($post['create_at'])); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?php
// 4. Nhúng footer
require_once '../includes/footer.php';
?>