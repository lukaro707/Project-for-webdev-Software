<?php
session_start();
include 'databaseConnection.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'organizer') {
    header("Location: login.php");
    exit;
}

$organizerUsername = $_SESSION['username'];
$stmt = $conn->prepare("SELECT TournamentID, Name, StartTime, PrizePool, EntryFee FROM tournament WHERE OrganizerUsername = :username");
$stmt->execute(['username' => $organizerUsername]);
$tournaments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Tournaments</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 30px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .dashboard-container {
            max-width: 1000px;
            margin: auto;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .top-bar a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
        }

        .tournament-card {
            background: white;
            border: 1px solid #ddd;
            border-left: 4px solid #4CAF50;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }

        .tournament-card h3 {
            margin: 0 0 10px;
            color: #333;
        }

        .tournament-card p {
            margin: 4px 0;
            color: #555;
        }

        .actions {
            margin-top: 10px;
        }

        .actions a,
        .actions form button {
            display: inline-block;
            margin-right: 10px;
            padding: 8px 16px;
            font-weight: bold;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }

        .delete-btn:hover,
        .edit-btn:hover {
            opacity: 0.9;
        }

        .no-tournaments {
            font-style: italic;
            color: #777;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <div class="top-bar">
        <h2>Manage Your Tournaments</h2>
        <a href="dashboard_organizer.php">⬅ Back to Dashboard</a>
    </div>

    <?php if (count($tournaments) > 0): ?>
        <?php foreach ($tournaments as $tournament): ?>
            <div class="tournament-card">
                <h3><?php echo htmlspecialchars($tournament['Name']); ?></h3>
                <p>Start Time: <?php echo date('Y-m-d H:i', strtotime($tournament['StartTime'])); ?></p>
                <p>Prize Pool: $<?php echo $tournament['PrizePool']; ?></p>
                <p>Entry Fee: $<?php echo $tournament['EntryFee']; ?></p>
                <div class="actions">
                    <a href="edit_tournament.php?id=<?php echo $tournament['TournamentID']; ?>" class="edit-btn">Edit</a>
                    <form method="POST" action="delete_tournament.php" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this tournament?');">
                        <input type="hidden" name="tournament_id" value="<?php echo $tournament['TournamentID']; ?>">
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>

                    <a href="view_registered_players.php?tournament_id=<?= $row['TournamentID']; ?>" class="btn btn-info">View Players</a>

                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-tournaments">You haven't created any tournaments yet.</p>
    <?php endif; ?>
</div>

</body>
</html>
