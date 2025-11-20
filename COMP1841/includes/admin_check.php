<?php
// /includes/admin_check.php

// 1. Bắt đầu session để truy cập biến $_SESSION
session_start(); 

// 2. KIỂM TRA QUYỀN TRUY CẬP
// Kiểm tra xem:
// - Session 'logged_in' có tồn tại VÀ bằng true không?
// - Session 'role_id' có tồn tại VÀ bằng 1 (Admin) không?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true || 
     !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1 ) {
    
    // 3. Nếu không phải Admin, đặt thông báo lỗi
    $_SESSION['error_message'] = "Bạn không có quyền truy cập trang này.";
    
    // 4. Chuyển hướng về trang login của user
    // (Đường dẫn này tính từ file /includes/ đi ra)
    header('Location: ../template/login.html.php');
    exit(); // Dừng chạy script ngay lập tức
}

// Nếu mọi thứ hợp lệ, script sẽ tiếp tục chạy.
?>