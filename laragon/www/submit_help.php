<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require 'databaseConnection.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'player') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = trim($_POST['message']);
    $playerID = $_SESSION['userID'];

    if (!empty($message)) {
        $sql = "INSERT INTO help_requests (PlayerID, Message, CreatedAt) VALUES (:playerID, :message, NOW())";
        $stmt = $conn->prepare($sql);
        $success = $stmt->execute([
            ':playerID' => $playerID,
            ':message' => $message
        ]);

        if ($success) {
            header("Location: help.php?status=sent");
            exit;
        } else {
            echo "Failed to save request.";
        }
    } else {
        echo "Message cannot be empty.";
    }
} else {
    echo "Invalid request.";
}
