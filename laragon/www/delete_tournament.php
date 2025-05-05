<?php
session_start();
include 'databaseConnection.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'organizer') {
    header("Location: login.php");
    exit;
}

$tournamentID = $_POST['tournament_id'] ?? null;

if ($tournamentID) {
    $stmt = $conn->prepare("DELETE FROM tournament WHERE TournamentID = :id");
    $stmt->execute(['id' => $tournamentID]);
}

header("Location: manage_tournaments.php?deleted=1");
exit;
?>
