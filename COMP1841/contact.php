<?php
// /contact.php

require_once 'includes/db_config.php';
session_start();

if (isset($_POST['submit'])) {

    // 1. Lấy dữ liệu
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message_content = trim($_POST['message_content']);
    $user_id = null; // Mặc định

    // 2. (Nâng cao) Nếu user đã đăng nhập, tự động gán user_id
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }
    
    // 3. Lưu tin nhắn vào CSDL
    try {
        $sql = "INSERT INTO Messages (name, email, subject, message_content, user_id, create_at) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $subject, $message_content, $user_id]);

    } catch (PDOException $e) {
        die("Lỗi CSDL khi lưu tin nhắn: " . $e->getMessage());
    }

    /*
    // 4. (Tùy chọn) Gửi email thật
    // Cảnh báo: Hàm mail() của PHP thường không hoạt động trên localhost (XAMPP)
    // $to = "admin@example.com";
    // mail($to, $subject, $message_content, "From: $email");
    */

    // 5. Chuyển hướng về trang liên hệ với thông báo thành công
    header("Location: template/contact.html.php?status=sent");
    exit();

} else {
    header("Location: template/home.html.php");
    exit();
}
?>