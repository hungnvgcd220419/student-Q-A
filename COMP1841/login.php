<?php
// /login.php

// Luôn bắt đầu session ở đầu tiên
session_start();

// Kết nối CSDL (file này ở gốc, nên đường dẫn là 'includes/...')
require_once 'includes/db_config.php';

// Kiểm tra nếu form được gửi
if (isset($_POST['submit'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 2. Tìm người dùng trong CSDL
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE username = ?");
    $stmt->execute([$username]);
    
    // 3. Kiểm tra user có tồn tại không
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(); // Lấy thông tin user

        // 4. Xác thực mật khẩu
        if (password_verify($password, $user['password_hash'])) {
            
            // 5. Mật khẩu đúng! Tạo Session
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id']; // Rất quan trọng

            // 6. PHÂN LUỒNG CHUYỂN HƯỚNG
            if ($user['role_id'] == 1) { 
                // Là ADMIN: Chuyển hướng vào trang admin
                header("Location: admin/template/home_admin.html.php"); 
            } else {
                // Là USER THƯỜNG: Chuyển hướng vào trang user
                header("Location: template/home.html.php"); 
            }
            exit();

        } else {
            // Mật khẩu sai
            $_SESSION['error_message'] = "Sai tên đăng nhập hoặc mật khẩu.";
            header("Location: template/login.html.php");
            exit();
        }
    } else {
        // Tên đăng nhập không tồn tại
        $_SESSION['error_message'] = "Sai tên đăng nhập hoặc mật khẩu.";
        header("Location: template/login.html.php");
        exit();
    }
} else {
    // Nếu truy cập trực tiếp file này
    header("Location: template/home.html.php");
    exit();
}
?>