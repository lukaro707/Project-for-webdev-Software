<?php
session_start();
include 'databaseConnection.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'player') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playerID = $_SESSION['userID'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE player SET Password = :password WHERE PlayerID = :playerID";
        $stmt = $conn->prepare($sql);
        
        if ($stmt->execute([':password' => $hashedPassword, ':playerID' => $playerID])) {
            header("Location: dashboard.php?password=success");
        } else {
            header("Location: dashboard.php?password=error");
        }
    } else {
        header("Location: dashboard.php?password=error");
    }
}
?>
