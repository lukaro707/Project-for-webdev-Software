<?php
session_start();
include 'databaseConnection.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'player') {
    header("Location: login.php");
    exit;
}

$playerID = $_SESSION['userID'];
$tournamentID = $_POST['tournamentID'];

// Prevent duplicate entries
$checkSql = "SELECT * FROM tournament_player WHERE PlayerID = $playerID AND TournamentID = $tournamentID";
$checkResult = mysqli_query($conn, $checkSql);

if (mysqli_num_rows($checkResult) > 0) {
    // Already joined
    header("Location: tournament.php?joined=already");
} else {
    // Insert new registration
    $sql = "INSERT INTO tournament_player (TournamentID, PlayerID, RegistrationDate)
            VALUES ($tournamentID, $playerID, NOW())";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: tournament.php?joined=success");
    } else {
        header("Location: tournament.php?joined=error");
    }
}
exit;
