<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<style>
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #24292e;
        padding: 15px 30px;
        color: white;
        font-family: Arial, sans-serif;
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .navbar h1 {
        margin: 0;
        font-size: 24px;
    }

    .nav-links, .nav-auth {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .nav-links a, .nav-auth a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        padding: 6px 12px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .nav-links a:hover, .nav-auth a:hover {
        background-color: #444c56;
    }
</style>

<div class="navbar">
    <!-- Left: Logo + Main navigation -->
    <div class="navbar-left">
        <h1>CompeteNow</h1>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="tournament.php">Tournaments</a>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'organizer'): ?>
                <a href="tournamentCreation.php">Create</a>
            <?php endif; ?>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="adminPanel.php">Admin</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Right: Auth section -->
    <div class="nav-auth">
        <?php if (isset($_SESSION['userID'])): ?>
            <span>👤 <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register_player.php">Register</a>
        <?php endif; ?>
    </div>
</div>
