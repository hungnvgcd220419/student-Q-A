<?php
// /includes/header_admin.php

// Không cần session_start() ở đây, 
// vì file 'admin_check.php' sẽ luôn được gọi trước và đã bắt đầu session.
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="home_admin.html.php">ADMIN CONTROL</a>
        <button class="navbar-toggler" type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#adminNavbar"> <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="manage_posts.html.php">Posts Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_users.html.php">Users Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_modules.html.php">Module Management</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="manage_messages.html.php">Messages Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">