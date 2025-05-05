<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="footer">
    <p>&copy; 2025 CompeteNow. All rights reserved.</p>

    <?php if (isset($_SESSION['userID']) && $_SESSION['role'] === 'player'): ?>
        <p><a href="help.php" style="text-decoration: underline; color: #4CAF50;">Need help? Contact support</a></p>
    <?php endif; ?>

    <p>Follow us on:
        <a href="https://facebook.com"><img src="img/facebook.png" alt="Facebook" width="20" height="20"></a>
        <a href="https://x.com"><img src="img/x.png" alt="X" width="20" height="20"></a>
        <a href="https://instagram.com"><img src="img/instagram.png" alt="Instagram" width="40" height="22"></a>
    </p>
</div>
