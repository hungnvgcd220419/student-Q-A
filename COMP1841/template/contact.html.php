<?php
// /template/contact.html.php
require_once '../includes/header.php';
?>

<div class="col-md-8 mx-auto" style="min-height: 80vh;">
    <h2 class="mb-4">Contact To Admin</h2>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'sent'): ?>
        <div class="alert alert-success">
            Messages successfuly!
        </div>
    <?php endif; ?>

    <form action="../contact.php" method="POST">
            
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="subject" class="form-label">Subject:</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>

        <div class="mb-3">
            <label for="message_content" class="form-label">Messages content:</label>
            <textarea class="form-control" id="message_content" name="message_content" rows="6" required></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Send Messages</button>
    </form>
</div>


<?php
require_once '../includes/footer.php';
?>