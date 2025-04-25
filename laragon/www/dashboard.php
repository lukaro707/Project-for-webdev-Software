<?php
session_start();
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'player') {
    header("Location: login.php");
    exit;
}

include 'databaseConnection.php';

// 1. Fetch tournaments the player is registered in
$playerID = $_SESSION['userID'];
$tournamentSql = "
    SELECT t.TournamentID, t.StartTime, t.OrganizerUsername
    FROM tournament_player tp
    INNER JOIN tournament t ON tp.TournamentID = t.TournamentID
    WHERE tp.PlayerID = $playerID
";
$tournamentResult = mysqli_query($conn, $tournamentSql);

// 2. Fetch upcoming matches
$matchSql = "
    SELECT tm.MatchID, tm.TournamentID, tm.IsHeld, t.StartTime
    FROM tournament_match tm
    JOIN tournament_player tp ON tm.TournamentID = tp.TournamentID
    JOIN tournament t ON tm.TournamentID = t.TournamentID
    WHERE tp.PlayerID = $playerID AND tm.IsHeld = 0
    ORDER BY t.StartTime ASC
";
$matchResult = mysqli_query($conn, $matchSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player Dashboard - CompeteNow</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
        }

        .dashboard-container {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
        }

        h2 {
            color: #222;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            margin-top: 0;
            color: #333;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        .button:hover {
            background-color: #45a049;
        }

        .stat {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .empty {
            color: #999;
            font-style: italic;
        }

        .tournament-card {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 8px;
            background-color: #fdfdfd;
        }
    </style>
</head>
<body>

<?php include('templates/header.php'); ?>

<div class="dashboard-container">
    <h2>Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h2>

    <div class="grid">
        <!-- Registered Tournaments -->
        <div class="card">
            <h3>Registered Tournaments</h3>
            <ul>
                <?php if (mysqli_num_rows($tournamentResult) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($tournamentResult)): ?>
                        <li class="tournament-card">
                            <strong>Tournament #<?php echo htmlspecialchars($row['TournamentID']); ?></strong><br>
                            Organized by: <em><?php echo htmlspecialchars($row['OrganizerUsername']); ?></em><br>
                            <span style="color: #555;">
                                🕒 Starts: <?php echo date('M d, Y @ H:i', strtotime($row['StartTime'])); ?>
                            </span>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li class="empty">You're not registered in any tournaments yet.</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Upcoming Matches -->
        <div class="card">
            <h3>Upcoming Matches</h3>
            <ul>
                <?php if (mysqli_num_rows($matchResult) > 0): ?>
                    <?php while ($match = mysqli_fetch_assoc($matchResult)): ?>
                        <li class="tournament-card">
                            Match #<?php echo $match['MatchID']; ?> — Tournament <?php echo $match['TournamentID']; ?><br>
                            <span style="color: #555;">
                                🕒 Starts: <?php echo date('M d, Y @ H:i', strtotime($match['StartTime'])); ?>
                            </span>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li class="empty">No upcoming matches found.</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Stats -->
        <div class="card">
            <h3>Your Stats</h3>
            <p class="stat">Wins: [Coming soon]</p>
            <p class="stat">Losses: [Coming soon]</p>
            <p class="stat">Current Rank: [Coming soon]</p>
        </div>

        <!-- Join Tournaments -->
        <div class="card">
            <h3>Join New Tournaments</h3>
            <p>Find new competitions and show your skills!</p>
            <a href="tournament.php" class="button">Browse Tournaments</a>
        </div>
    </div>
</div>

</body>
</html>
