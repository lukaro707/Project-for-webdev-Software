<?php
session_start();
include 'databaseConnection.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'organizer') {
    header("Location: login.php");
    exit;
}

$organizer = $_SESSION['username'];

$sql = "INSERT INTO tournament 
    (Name, OrganizerUsername, StartTime, AgeRequirements, PrizePool, EntryFee, Rules, HasBorderRestriction)
    VALUES (:name, :organizer, :start, :age, :prize, :entry_fee, :rules, :border)";

$stmt = $conn->prepare($sql);

$success = $stmt->execute([
    ':name' => $_POST['name'],
    ':organizer' => $organizer,
    ':start' => $_POST['start_time'],
    ':age' => $_POST['age'],
    ':prize' => $_POST['prize'],
    ':entry_fee' => $_POST['entry_fee'],
    ':rules' => $_POST['rules'],
    ':border' => $_POST['border_restriction']
]);

if ($success) {
    header("Location: dashboard_organizer.php?created=success");
} else {
    header("Location: dashboard_organizer.php?created=error");
}
?>
