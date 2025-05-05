<?php
session_start();
include 'databaseConnection.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'player') {
    header("Location: login.php");
    exit;
}

$playerID = $_SESSION['userID'];

// Fetch tournaments the player is registered for
$sql = "
    SELECT t.TournamentID, t.Name 
    FROM tournament_player tp
    JOIN tournament t ON tp.TournamentID = t.TournamentID
    WHERE tp.PlayerID = :playerID
";
$stmt = $conn->prepare($sql);
$stmt->execute([':playerID' => $playerID]);
$tournaments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report Score</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .score-container {
            background-color: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            color: #444;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            font-size: 15px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .back-btn {
            background-color: #ccc;
            color: #333;
        }

        .back-btn:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>
    <div class="score-container">
        <h2>Report Score</h2>

        <form action="submit_score.php" method="POST">
            <label for="tournament_id">Select Tournament:</label>
            <select name="tournament_id" id="tournament_id" required>
                <?php foreach ($tournaments as $t): ?>
                    <option value="<?= $t['TournamentID'] ?>"><?= htmlspecialchars($t['Name']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="score">Your Score:</label>
            <input type="text" name="score" id="score" placeholder="e.g., 2-1" required>

            <button type="submit" class="submit-btn">Submit Score</button>
        </form>

        <form action="dashboard.php" method="get">
            <button type="submit" class="back-btn">Back to Dashboard</button>
        </form>
    </div>
</body>
</html>
