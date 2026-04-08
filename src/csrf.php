<!-- token generate/verify  -->
<?php
    function csrf_token(): string {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
        }
    return $_SESSION['csrf_token'];
}