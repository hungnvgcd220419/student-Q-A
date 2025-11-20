<?php
// /template/edit_post.html.php

require_once '../includes/header.php'; 
require_once '../includes/db_config.php';

// Bảo mật: Phải đăng nhập
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in.");
}

// 1. Lấy ID từ URL
if (!isset($_GET['edit_id'])) {
    die("Error: Post ID not found.");
}
$post_id = $_GET['edit_id'];

// 2. Lấy thông tin bài đăng
try {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE post_id = ?");
    $stmt->execute([$post_id]);
    $post = $stmt->fetch();
} catch (PDOException $e) { die("Database Error"); }

// 3. Bảo mật: Phải là chủ sở hữu HOẶC Admin
if ($post['user_id'] != $_SESSION['user_id'] && $_SESSION['role_id'] != 1) {
     die("You do not have permission to edit this post.");
}

// 4. Lấy Modules
$modules = $pdo->query("SELECT module_id, module_name FROM modules")->fetchAll();
?>
<div class="row justify-content-top align-items-top" style="min-height: 80vh;">
    <form action="../edit_post.php" method="POST" enctype="multipart/form-data">
        <h2 class="mb-3">Edit Post</h2>
        <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['post_id']); ?>">

        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" 
                value="<?php echo htmlspecialchars($post['title']); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="module_id" class="form-label">Module:</label>
            <select class="form-select" id="module_id" name="module_id" required>
                <?php foreach ($modules as $module): ?>
                    <option value="<?php echo $module['module_id']; ?>" <?php echo ($module['module_id'] == $post['module_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($module['module_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea class="form-control" id="content" name="content" rows="5"><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Screenshot:</label>
            <input type="file" class="form-control" id="image" name="image">
            <?php if ($post['image_path']): ?>
                <p class="mt-2">Current Image:</p>
                <img src="../<?php echo htmlspecialchars($post['image_path']); ?>" alt="Image" style="width: 100px;">
                <input type="hidden" name="existing_image_path" value="<?php echo htmlspecialchars($post['image_path']); ?>">
            <?php endif; ?>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Update Post</button>
        <a href="home.html.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php 
require_once '../includes/footer.php'; 
?>