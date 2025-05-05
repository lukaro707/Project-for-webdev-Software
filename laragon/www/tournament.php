<?php
session_start();
$currentPage = 'tournaments';
include("templates/header.php");
include 'databaseConnection.php';
include 'tournamentClass.php';

$playerID = $_SESSION['userID'] ?? null;
$searchTerm = $_GET['search'] ?? '';

// Fetch tournaments (with optional search)
if (!empty($searchTerm)) {
    $searchWildcard = '%' . $searchTerm . '%';
    $sql = "SELECT Name, TournamentID, OrganizerUsername, StartTime, AgeRequirements, Rules, HasBorderRestriction, PrizePool, EntryFee 
            FROM tournament 
            WHERE Name LIKE :search OR OrganizerUsername LIKE :search";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':search' => $searchWildcard]);
} else {
    $sql = "SELECT Name, TournamentID, OrganizerUsername, StartTime, AgeRequirements, Rules, HasBorderRestriction, PrizePool, EntryFee 
            FROM tournament";
    $stmt = $conn->query($sql);
}
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get tournaments this player has already joined
$joinedTournaments = [];
if ($playerID && $_SESSION['role'] === 'player') {
    $joinedQuery = "SELECT TournamentID FROM tournament_player WHERE PlayerID = :playerID";
    $joinedStmt = $conn->prepare($joinedQuery);
    $joinedStmt->execute([':playerID' => $playerID]);
    $joinedTournaments = $joinedStmt->fetchAll(PDO::FETCH_COLUMN);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tournament Page</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <style>
        .search-form {
            text-align: center;
            margin-bottom: 25px;
        }

        .search-form input[type="text"] {
            padding: 8px;
            width: 50%;
            max-width: 400px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-form button {
            padding: 8px 16px;
            margin-left: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="hero">
<div class="tournament-list">
    <h1>Tournament Discovery Page</h1>
    <h3>List of Tournaments</h3>
    <p>Here, you can find a list of currently available tournaments. Do you have what it takes to win?</p>

    <!-- ✅ Search Form -->
    <form method="GET" action="tournament.php" class="search-form">
        <input type="text" name="search" placeholder="Search by name or organizer..." value="<?= htmlspecialchars($searchTerm) ?>">
        <button type="submit">Search</button>
    </form>

    <!-- Feedback Messages -->
    <?php if (isset($_GET['joined'])): ?>
        <div class="message <?php echo $_GET['joined'] === 'success' ? 'success' : 'error'; ?>">
            <?php
            if ($_GET['joined'] === 'success') echo "You’ve successfully joined the tournament!";
            elseif ($_GET['joined'] === 'already') echo "You’ve already joined this tournament.";
            else echo "Something went wrong. Please try again.";
            ?>
        </div>
    <?php endif; ?>

    <?php if (count($result) > 0): ?>
        <?php foreach ($result as $row): ?>
            <?php
            $tournament = new Tournament();
            $tournament->setTournamentID($row['TournamentID']);
            $tournament->setName($row['Name']);
            $tournament->setOrganizerUsername($row['OrganizerUsername']);
            $tournament->setStartTime($row['StartTime']);
            $tournament->setAgeRequirements($row['AgeRequirements']);
            $tournament->setRules($row['Rules']);
            $tournament->setHasBorderRestriction($row['HasBorderRestriction']);
            $tournament->setPrizePool($row['PrizePool']);
            $tournament->setEntryFee($row['EntryFee']);
            $tournamentID = $tournament->getTournamentID();
            ?>

            <div class="tournament-item">
                <h2><?php echo htmlspecialchars($tournament->getName() ?? 'Untitled Tournament'); ?></h2>
                <p><strong>Organizer:</strong> <?php echo htmlspecialchars($tournament->getOrganizerUsername()); ?></p>
                <p>Start Time: <?php echo $tournament->getStartTime(); ?></p>
                <p>Age Requirements: <?php echo $tournament->getAgeRequirements(); ?>+</p>
                <p>Rules: <?php echo $tournament->getRules(); ?></p>
                <p>Border Restriction: <?php echo $tournament->getHasBorderRestriction() ? "Yes" : "No"; ?></p>
                <p>Prize Pool: $<?php echo $tournament->getPrizePool(); ?></p>
                <p>Entry Fee: $<?php echo $tournament->getEntryFee(); ?></p>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'player'): ?>
                    <?php if (in_array($tournamentID, $joinedTournaments)): ?>
                        <button disabled>Already Joined</button>
                    <?php else: ?>
                        <form method="POST" action="join_tournament.php">
                            <input type="hidden" name="tournamentID" value="<?php echo $tournamentID; ?>">
                            <button type="submit">Join Tournament</button>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No tournaments found.</p>
    <?php endif; ?>
</div>
</body>
<?php include("templates/footer.php"); ?>
</html>
