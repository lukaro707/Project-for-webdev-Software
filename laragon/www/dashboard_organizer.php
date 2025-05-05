<?php
session_start();
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'organizer') {
    header("Location: login.php");
    exit;
}

include 'databaseConnection.php';

$currentPage = 'dashboard'; // for navbar highlighting

// Fetch tournaments created by this organizer
$organizerUsername = $_SESSION['username'];
$tournamentSql = "
    SELECT TournamentID, StartTime, PrizePool, EntryFee
    FROM tournament
    WHERE OrganizerUsername = :organizerUsername
";
$stmt = $conn->prepare($tournamentSql);
$stmt->execute([':organizerUsername' => $organizerUsername]);
$tournamentResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Organizer Dashboard - CompeteNow</title>
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

        .tournament-card {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 8px;
            background-color: #fdfdfd;
        }

        .empty {
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>

<?php include('templates/header.php'); ?>

<div class="dashboard-container">
    <h2>Welcome Organizer, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h2>

    <div class="grid">
        <!-- Created Tournaments -->
        <div class="card">
            <h3>Your Tournaments</h3>
            <ul>
                <?php if (count($tournamentResult) > 0): ?>
                    <?php foreach ($tournamentResult as $row): ?>
                        <li class="tournament-card">
                            <strong>Tournament #<?php echo htmlspecialchars($row['TournamentID']); ?></strong><br>
                            Prize Pool: $<?php echo htmlspecialchars($row['PrizePool']); ?><br>
                            Entry Fee: $<?php echo htmlspecialchars($row['EntryFee']); ?><br>
                            Start Time: <?php echo date('M d, Y @ H:i', strtotime($row['StartTime'])); ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="empty">You haven't created any tournaments yet.</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Create New Tournament -->
        <div class="card">
            <h3>Create New Tournament</h3>
            <p>Organize a new competition for players!</p>
            <a href="tournamentCreation.php" class="button">Create Tournament</a>
        </div>

        <!-- Manage Tournaments -->
        <div class="card">
            <h3>Manage Tournaments</h3>
            <p>Edit or delete your existing tournaments.</p>
            <a href="manage_tournaments.php" class="button">Manage Tournaments</a>
        </div>

        <div>
        <a href="view_help_requests.php" class="button">View Help Requests</a>
        </div>
    </div>
</div>

</body>
</html>
