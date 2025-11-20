<?php
// /admin/template/home_admin.html.php

// 1. BẢO MẬT: Kiểm tra quyền Admin
// (Đi lên 2 cấp, vào 'includes')
require_once '../../includes/admin_check.php';

// 2. GỌI HEADER ADMIN
// (admin_check.php đã gọi session_start() rồi)
require_once '../../includes/header_admin.php'; 

// 3. KẾT NỐI CSDL (Để lấy số liệu thống kê)
require_once '../../includes/db_config.php';

// (Tùy chọn: Lấy số liệu thống kê cho dashboard)
$total_posts = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
$total_users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_modules = $pdo->query("SELECT COUNT(*) FROM modules")->fetchColumn();
$total_messages = $pdo->query("SELECT COUNT(*) FROM messages")->fetchColumn();

?>
<div class="row justify-content-top align-items-top" style="min-height: 80vh;">

    <h1 class="mb-3">System Management</h1>

    <div class="d-block">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Total Posts</div>
            <div class="card-body">
                <h5 class="card-title" style="font-size: 2.5rem;"><?php echo $total_posts; ?></h5>
                <a href="manage_posts.html.php" class="btn btn-outline-light btn-sm">Posts Management</a>
            </div>
        </div>

        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Total Users</div>
            <div class="card-body">
                    <h5 class="card-title" style="font-size: 2.5rem;"><?php echo $total_users; ?></h5>
                    <a href="manage_users.html.php" class="btn btn-outline-light btn-sm">Users Management</a>
            </div>
        </div>

        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Total Modules</div>
            <div class="card-body">
                <h5 class="card-title" style="font-size: 2.5rem;"><?php echo $total_modules; ?></h5>
                <a href="manage_modules.html.php" class="btn btn-outline-light btn-sm">Modules Management</a>
            </div>
        </div>

        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Total Messages</div>
            <div class="card-body">
                <h5 class="card-title" style="font-size: 2.5rem;"><?php echo $total_messages; ?></h5>
                <a href="manage_messages.html.php" class="btn btn-outline-light btn-sm">Messages Management</a>
            </div>
        </div>
    </div>
</div>


<?php
// 4. GỌI FOOTER
require_once '../../includes/footer.php'; 
?>