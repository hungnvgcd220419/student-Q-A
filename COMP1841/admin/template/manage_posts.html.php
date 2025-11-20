<?php
// /admin/template/manage_posts.html.php

// 1. BẢO MẬT: Kiểm tra admin
require_once '../../includes/admin_check.php';
// 2. HEADER: Gọi header admin
require_once '../../includes/header_admin.php';
// 3. CSDL: Kết nối CSDL
require_once '../../includes/db_config.php';

// 4. Lấy tất cả bài đăng
$stmt = $pdo->query("
    SELECT posts.*, users.username, modules.module_name
    FROM posts
    LEFT JOIN users ON posts.user_id = users.user_id
    LEFT JOIN modules ON posts.module_id = modules.module_id
    ORDER BY posts.create_at DESC
");
$posts = $stmt->fetchAll();
?>
<div style="min-height: 80vh;">
    <div class="d-flex justify-content-between align-items-center gap-1 mb-3">
        <h2>Post Management</h2>
        <a href="add_post_admin.html.php" class="btn btn-primary">Add Post</a>
    </div>

    <div class="row">
        <?php if (empty($posts)): ?>
            <div class="col">
                <div class="alert alert-info text-center">
                    No posts found.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="mb-4">
                    <div class="card shadow-sm h-100">
                        
                        <?php if (!empty($post['image_path'])): ?>
                            <img src="../../<?php echo htmlspecialchars($post['image_path']); ?>" 
                                class="card-img-top" alt="Post Image" 
                                style="height: 200px; object-fit: cover;">
                        <?php endif; ?>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                            
                            <h6 class="card-subtitle mb-2 text-muted">
                                ID: <?php echo htmlspecialchars($post['post_id']); ?> | 
                                Author: <?php echo htmlspecialchars($post['username']); ?>
                            </h6>
                            
                            <p class="card-text">
                                <small class="text-muted">
                                    Module: <?php echo htmlspecialchars($post['module_name']); ?>
                                </small>
                            </p>
                            
                            <div class="mt-auto">
                                <hr>
                                <a href="edit_post_admin.html.php?edit_id=<?php echo $post['post_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                
                                <a href="../delete_post.php?id=<?php echo $post['post_id']; ?>" 
                                class="btn btn-sm btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                            </div>
                        </div>
                        
                        <div class="card-footer text-muted">
                            <small>Created: <?php echo date('d/m/Y H:i', strtotime($post['create_at'])); ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?php
// 5. GỌI FOOTER:
require_once '../../includes/footer.php'; 
?>