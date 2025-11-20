<?php
// /includes/header.php

// Luôn bắt đầu session ở đầu tiên
session_start(); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Q&A System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="home.html.php">Student Q&A</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="contact.html.php">Contact</a>
                </li>

                <?php 
                // KIỂM TRA ĐĂNG NHẬP
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true): 
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../template/add_post.html.php">Add Post</a>
                    </li>
                    <li class="nav-item">
                        <a href="../logout.php" class="nav-link"> Logout</a>
                    </li>

                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.html.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sign_up.html.php">Sign Up</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">