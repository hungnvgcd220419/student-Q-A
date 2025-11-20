<?php
// /admin/template/add_post_admin.html.php

require_once '../../includes/admin_check.php';
require_once '../../includes/header_admin.php';
require_once '../../includes/db_config.php';

// Lấy Users và Modules cho dropdowns
$users = $pdo->query("SELECT user_id, username FROM users")->fetchAll();
$modules = $pdo->query("SELECT module_id, module_name FROM modules")->fetchAll();
?>

<div class="row justify-content-top align-items-top" style="min-height: 80vh;">
    <form action="../add_post.php" method="POST" enctype="multipart/form-data">
        <h2 class="mb-3">Add New Post</h2>

        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Author:</label>
            <select class="form-select" id="user_id" name="user_id" required>
                <option value="">-- Select Author --</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['user_id']; ?>">
                        <?php echo htmlspecialchars($user['username']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
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
        
        <button type="submit" name="submit" class="btn btn-primary">Add Post</button>
        <a href="manage_posts.html.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php 
require_once '../../includes/footer.php'; 
?>