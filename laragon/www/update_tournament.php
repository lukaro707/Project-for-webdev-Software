<?php
session_start();
include 'databaseConnection.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'organizer') {
    header("Location: login.php");
    exit;
}

$id = $_POST['id'];
$name = $_POST['name'];
$start = $_POST['start_time'];
$age = $_POST['age'];
$prize = $_POST['prize'];
$entry_fee = $_POST['entry_fee'];
$rules = $_POST['rules'];
$border = $_POST['border'];

$sql = "UPDATE tournament SET 
    Name = :name, 
    StartTime = :start, 
    AgeRequirements = :age, 
    PrizePool = :prize, 
    EntryFee = :entry_fee, 
    Rules = :rules, 
    HasBorderRestriction = :border 
    WHERE TournamentID = :id";

$stmt = $conn->prepare($sql);
$success = $stmt->execute([
    ':name' => $name,
    ':start' => $start,
    ':age' => $age,
    ':prize' => $prize,
    ':entry_fee' => $entry_fee,
    ':rules' => $rules,
    ':border' => $border,
    ':id' => $id
]);

header("Location: manage_tournaments.php?update=" . ($success ? "success" : "error"));
exit;
?>
