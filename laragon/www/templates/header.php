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

    /* Move this outside hover */
    .active-link {
        background-color: #4CAF50;
        padding: 6px 12px;
        border-radius: 5px;
    }
</style>

<div class="navbar">
    <!-- Left: Logo + Main navigation -->
    <div class="navbar-left">
        <h1>CompeteNow</h1>
        <div class="nav-links">
            <a href="index.php" class="<?php echo (isset($currentPage) && $currentPage == 'home') ? 'active-link' : ''; ?>">Home</a>
            <a href="tournament.php" class="<?php echo (isset($currentPage) && $currentPage == 'tournaments') ? 'active-link' : ''; ?>">Tournaments</a>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'organizer'): ?>
                <a href="tournamentCreation.php" class="<?php echo (isset($currentPage) && $currentPage == 'create') ? 'active-link' : ''; ?>">Create</a>
            <?php endif; ?>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="adminPanel.php" class="<?php echo (isset($currentPage) && $currentPage == 'admin') ? 'active-link' : ''; ?>">Admin</a>
            <?php endif; ?>

            <li><a href="leaderboard.php" class="<?= $currentPage === 'leaderboard' ? 'active' : '' ?>">Leaderboard</a></li>

        </div>
    </div>

    <!-- Right: Auth section -->
    <div class="nav-auth">
        <?php if (isset($_SESSION['userID'])): ?>
            <span>👤 <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="dashboard.php" class="<?php echo (isset($currentPage) && $currentPage == 'dashboard') ? 'active-link' : ''; ?>">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php" class="<?php echo (isset($currentPage) && $currentPage == 'login') ? 'active-link' : ''; ?>">Login</a>
            <a href="register_player.php" class="<?php echo (isset($currentPage) && $currentPage == 'register') ? 'active-link' : ''; ?>">Register</a>
        <?php endif; ?>
    </div>
</div>
