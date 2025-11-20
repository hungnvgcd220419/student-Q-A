<?php
// /template/login.html.php
require_once '../includes/header.php'; 
?>

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        
        <div class="col-md-6">
            <div class="card shadow"> 
                <div class="card-header text-center"> 
                    <h2>Login</h2>
                </div>
                <div class="card-body">
                    
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger">
                            <?php 
                            echo $_SESSION['error_message']; 
                            unset($_SESSION['error_message']); 
                            ?>
                        </div>
                    <?php endif; ?>

                    <form action="../login.php" method="POST">
                        
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
                        <p class="mt-3 text-center">Don't have an account? <a href="sign_up.html.php">Sign up now</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>