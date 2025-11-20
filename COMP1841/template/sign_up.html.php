<?php
// /template/sign_up.html.php
require_once '../includes/header.php'; 
?>

<div class="row justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header text-center">
                <h2>Sign Up</h2>
            </div>
            <div class="card-body">
                <form action="../sign_up.php" method="POST">
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary w-100">Sign Up</button>
                    <p class="mt-3 text-center">Already have an account? <a href="login.html.php">Login now</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>