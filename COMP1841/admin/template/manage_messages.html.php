<?php
// /admin/template/manage_messages.html.php

// 1. BẢO MẬT: Kiểm tra quyền Admin
require_once '../../includes/admin_check.php';
// 2. GỌI HEADER ADMIN
require_once '../../includes/header_admin.php'; 
// 3. KẾT NỐI CSDL
require_once '../../includes/db_config.php';

// 4. Lấy tất cả tin nhắn
try {
    $stmt = $pdo->query("SELECT * FROM messages ORDER BY create_at DESC");
    $messages = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>

<div class="container" style="min-height: 80vh;">
    <h2 class="mb-4">Contact Messages</h2>

    <div class="row">
        <div class="col-md-10 mx-auto">
            
            <?php if (empty($messages)): ?>
                <div class="alert alert-info text-center">
                    You have no messages in your inbox.
                </div>
            <?php else: ?>
                <div class="accordion" id="messagesAccordion">
                    
                    <?php foreach ($messages as $message): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-<?php echo $message['message_id']; ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse-<?php echo $message['message_id']; ?>">
                                    
                                    <div class="d-flex justify-content-between w-100 align-items-center">
                                        
                                        <div>
                                            <strong class="d-block">
                                                Subject: <?php echo htmlspecialchars($message['subject']); ?>
                                            </strong>
                                            <span class="d-block">
                                                From: <?php echo htmlspecialchars($message['name']); ?>
                                            </span>
                                            <span class="d-block text-muted" style="font-size: 0.9em;">
                                                Email: <?php echo htmlspecialchars($message['email']); ?>
                                            </span>
                                            <span class="d-block text-muted">
                                                Create at:<?php echo date('d/m/Y H:i', strtotime($message['create_at'])); ?>
                                            </span>
                                        </div>

                                    </div>
                                </button>
                                </h2>
                            <div id="collapse-<?php echo $message['message_id']; ?>" class="accordion-collapse collapse" 
                                 aria-labelledby="heading-<?php echo $message['message_id']; ?>" 
                                 data-bs-parent="#messagesAccordion">
                                
                                <div class="accordion-body">
                                    <?php echo nl2br(htmlspecialchars($message['message_content'])); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div> <?php endif; ?>

        </div>
    </div>
</div>

<?php
// 5. GỌI FOOTER
require_once '../../includes/footer.php'; 
?>