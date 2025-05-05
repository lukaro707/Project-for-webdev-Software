<?php
session_start();
include 'databaseConnection.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'player') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playerID = $_SESSION['userID'];
    $tournamentID = $_POST['tournament_id'] ?? null;
    $score = $_POST['score'] ?? null;

    // Sanitize and validate score
    $score = intval($score);
    if (!$tournamentID || $score < 0) {
        echo "Invalid tournament or score.";
        exit;
    }

    try {
        $stmt = $conn->prepare("INSERT INTO reported_scores (PlayerID, TournamentID, Score) VALUES (:playerID, :tournamentID, :score)");
        $stmt->execute([
            ':playerID' => $playerID,
            ':tournamentID' => $tournamentID,
            ':score' => $score
        ]);

        // ✅ Display confirmation
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Score Submitted</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    text-align: center;
                    padding-top: 50px;
                }
                .message-box {
                    background-color: white;
                    padding: 30px;
                    margin: auto;
                    border-radius: 10px;
                    max-width: 400px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
                .message-box h2 {
                    color: green;
                }
                a.button {
                    display: inline-block;
                    margin-top: 20px;
                    padding: 10px 20px;
                    background-color: #4CAF50;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                }
            </style>
        </head>
        <body>
            <div class='message-box'>
                <h2>Thanks for the report</h2>
                <p>A verification is being done to confirm your report.</p>
                <a class='button' href='dashboard.php'>Return to Dashboard</a>
            </div>
        </body>
        </html>";
        exit;

    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
} else {
    header("Location: report_score.php");
    exit;
}
?>
