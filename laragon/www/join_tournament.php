<?php
session_start();
include 'databaseConnection.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'player') {
    header("Location: login.php");
    exit;
}

$playerID = $_SESSION['userID'];
$tournamentID = $_POST['tournamentID'];

$checkStmt = $conn->prepare("SELECT * FROM tournament_player WHERE PlayerID = :playerID AND TournamentID = :tournamentID");
$checkStmt->execute([
    'playerID' => $playerID,
    'tournamentID' => $tournamentID
]);

if ($checkStmt->rowCount() > 0) {
    header("Location: tournament.php?joined=already");
} else {
    $insertStmt = $conn->prepare("INSERT INTO tournament_player (TournamentID, PlayerID, RegistrationDate) VALUES (:tournamentID, :playerID, NOW())");

    if ($insertStmt->execute(['tournamentID' => $tournamentID, 'playerID' => $playerID])) {
        header("Location: tournament.php?joined=success");
    } else {
        header("Location: tournament.php?joined=error");
    }
}
exit;
