<?php
// /includes/db_config.php

$host = 'localhost';        // Hoặc 127.0.0.1
$db_name = 'db_comp1841';   // Tên CSDL bạn đã tạo
$username = 'root';         // Tên người dùng XAMPP mặc định
$password = '';             // Mật khẩu XAMPP mặc định là rỗng

try {
    // Tạo đối tượng PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    
    // Đặt chế độ báo lỗi của PDO thành Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Đặt chếG độ fetch mặc định (trả về mảng associative)
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    // Nếu kết nối thất bại, dừng chương trình và báo lỗi
    die("ERROR: Không thể kết nối CSDL. " . $e->getMessage());
}
?>