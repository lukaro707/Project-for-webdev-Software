<?php
session_start();
include 'databaseConnection.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'organizer') {
    header("Location: login.php");
    exit;
}

$tournamentID = $_GET['tournament_id'] ?? null;

if (!$tournamentID) {
    echo "Invalid tournament ID.";
    exit;
}

$stmt = $conn->prepare("SELECT Name FROM tournament WHERE TournamentID = ?");
$stmt->execute([$tournamentID]);
$tournament = $stmt->fetch();

if (!$tournament) {
    echo "Tournament not found.";
    exit;
}

$query = "
    SELECT p.Username, tp.RegistrationDate 
    FROM tournament_player tp
    JOIN player p ON tp.PlayerID = p.PlayerID
    WHERE tp.TournamentID = ?
";
$playerStmt = $conn->prepare($query);
$playerStmt->execute([$tournamentID]);
$players = $playerStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Players - <?= htmlspecialchars($tournament['Name']) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('templates/header.php'); ?>

    <div class="dashboard-container">
        <h2>Registered Players for: <?= htmlspecialchars($tournament['Name']) ?></h2>

        <?php if (count($players) > 0): ?>
            <ul>
                <?php foreach ($players as $player): ?>
                    <li>
                        <strong><?= htmlspecialchars($player['Username']) ?></strong> —
                        Registered on <?= date("M d, Y @ H:i", strtotime($player['RegistrationDate'])) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No players have registered yet.</p>
        <?php endif; ?>

        <a href="manage_tournaments.php" class="button">Back to Manage Tournaments</a>
    </div>
</body>
</html>
