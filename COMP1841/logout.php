<?php
// /logout.php

// 1. Bắt đầu session
session_start();

// 2. Hủy tất cả các biến session
session_unset();

// 3. Hủy phiên làm việc (session)
session_destroy();

// 4. Chuyển hướng người dùng về trang chủ
header("Location: template/home.html.php");
exit();
?>