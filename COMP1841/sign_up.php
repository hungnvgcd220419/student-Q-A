<?php
// /sign_up.php

require_once 'includes/db_config.php';
session_start(); // Dùng để hiển thị lỗi

if (isset($_POST['submit'])) {
    
    // 1. Lấy dữ liệu
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role_id = 2; // Mặc định là 'Student' (giả sử ID=2)

    // 2. Validation (Kiểm tra dữ liệu)
    if ($password !== $confirm_password) {
        die("Lỗi: Mật khẩu không khớp. Vui lòng quay lại.");
    }
    if (strlen($password) < 6) {
        die("Lỗi: Mật khẩu phải có ít nhất 6 ký tự. Vui lòng quay lại.");
    }

    // Kiểm tra xem username hoặc email đã tồn tại chưa
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->rowCount() > 0) {
        die("Lỗi: Tên đăng nhập hoặc Email đã tồn tại. Vui lòng quay lại.");
    }

    // 3. Băm Mật khẩu (Rất quan trọng)
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // 4. Lưu vào CSDL
    try {
        $sql = "INSERT INTO Users (username, email, password_hash, role_id, create_at) 
                VALUES (?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email, $password_hash, $role_id]);
        
        // 5. Chuyển hướng đến trang đăng nhập
        header("Location: template/login.html.php?status=registered");
        exit();

    } catch (PDOException $e) {
        die("Lỗi CSDL: " . $e->getMessage());
    }

} else {
    header("Location: template/home.html.php");
    exit();
}
?>