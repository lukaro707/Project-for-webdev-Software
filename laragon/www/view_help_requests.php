<?php
session_start();
require 'databaseConnection.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'organizer') {
    header("Location: login.php");
    exit;
}

$sql = "SELECT hr.*, p.Username FROM help_requests hr JOIN player p ON hr.PlayerID = p.PlayerID ORDER BY hr.CreatedAt DESC";
$stmt = $conn->query($sql);
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Help Requests - Organizer View</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .request-box {
            background: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            margin: 15px auto;
            max-width: 800px;
            border-radius: 8px;
        }

        .request-box h4 {
            margin-bottom: 5px;
        }

        .request-box p {
            margin: 0;
        }
    </style>
</head>
<body>
<?php $currentPage = ''; include 'templates/header.php'; ?>

<h2 style="text-align:center; margin-top:30px;">Help Requests from Players</h2>

<?php foreach ($requests as $req): ?>
    <div class="request-box">
        <h4>From: <?= htmlspecialchars($req['Username']) ?></h4>
        <p><strong>Date:</strong> <?= $req['CreatedAt'] ?></p>
        <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($req['Message'])) ?></p>
    </div>
<?php endforeach; ?>

</body>
</html>
