<?php
// /admin/template/add_module.html.php

require_once '../../includes/admin_check.php';
require_once '../../includes/header_admin.php';
// Không cần kết nối CSDL vì đây là form trống
?>

<div class="row justify-content-top align-items-top" style="min-height: 80vh;">
    <form action="../add_module.php" method="POST">
        <h2 class="mb-3" >Add New Module</h2>
        <div class="mb-3">
            <label for="module_code" class="form-label">Module Code (e.g., COMP1841):</label>
            <input type="text" class="form-control" id="module_code" name="module_code" required>
        </div>

        <div class="mb-3">
            <label for="module_name" class="form-label">Module Name:</label>
            <input type="text" class="form-control" id="module_name" name="module_name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Add Module</button>
        <a href="manage_modules.html.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php 
require_once '../../includes/footer.php'; 
?>