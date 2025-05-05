<?php
session_start();
$currentPage= 'leaderboard' ;
include 'databaseConnection.php';
include("templates/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional global styles -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: #f1f4f9;
        }

        .leaderboard-container {
            max-width: 800px;
            margin: 60px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        h2 span {
            font-size: 1.4em;
            margin-right: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 14px 20px;
            text-align: center;
        }

        th {
            background-color: #28a745;
            color: #fff;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e6f7ff;
        }

        .rank {
            font-weight: bold;
            color: #555;
        }

        .rank::before {
            content: "🏅 ";
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="leaderboard-container">
    <h2><span>🏆</span>Leaderboard – Most Tournaments Joined</h2>

    <?php
    try {
        $sql = "
            SELECT p.Username, COUNT(tp.TournamentID) AS TournamentsJoined
            FROM player p
            JOIN tournament_player tp ON p.PlayerID = tp.PlayerID
            GROUP BY p.PlayerID
            ORDER BY TournamentsJoined DESC
            LIMIT 10
        ";
        $stmt = $conn->query($sql);
        $players = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($players): ?>
            <table>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Tournaments Joined</th>
                </tr>
                <?php foreach ($players as $index => $player): ?>
                    <tr>
                        <td class="rank"><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($player['Username']) ?></td>
                        <td><?= $player['TournamentsJoined'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p style="text-align:center; color: #666;">No data available.</p>
        <?php endif;

    } catch (PDOException $e) {
        echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
    }
    ?>
    <a class="back-link" href="dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>