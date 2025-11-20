<?php
// /template/add_post.html.php

require_once '../includes/header.php'; // (đã có session_start())
require_once '../includes/db_config.php';

// Bảo mật: Phải đăng nhập
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to add a post.");
}

// Lấy Modules cho dropdown
$modules = $pdo->query("SELECT module_id, module_name FROM modules")->fetchAll();
?>
<div class="row justify-content-top align-items-top" style="min-height: 80vh;">
    <form action="../add_post.php" method="POST" enctype="multipart/form-data">
        <h2>Add New Post</h2>
        <p class="mb-3">You are posting as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>

        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        
        <div class="mb-3">
            <label for="module_id" class="form-label">Module:</label>
            <select class="form-select" id="module_id" name="module_id" required>
                <option value="">-- Select Module --</option>
                <?php foreach ($modules as $module): ?>
                    <option value="<?php echo $module['module_id']; ?>">
                        <?php echo htmlspecialchars($module['module_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea class="form-control" id="content" name="content" rows="5"></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Screenshot:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Submit Post</button>
        <a href="home.html.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php 
require_once '../includes/footer.php'; 
?>