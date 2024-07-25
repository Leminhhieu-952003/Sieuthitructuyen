<?php 
// Hiển thị thông báo thành công or fail
function showMessage($type) {
    if (!empty($_SESSION[$type])) {
        $class = ($type === 'success') ? 'alert-success' : 'alert-danger';
        ?>
        <div class="alert <?= $class ?> py-2">
            <?php foreach ($_SESSION[$type] as $item) : ?>
                <span><?= $item ?></span>
            <?php endforeach; ?>
        </div>
        <?php
        unset($_SESSION[$type]);
    }
}

// Call the function for success messages
showMessage('success');

// Call the function for error messages
showMessage('error');