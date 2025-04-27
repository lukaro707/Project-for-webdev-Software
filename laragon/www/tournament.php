<?php
session_start();
include("templates/header.php");
include 'databaseConnection.php';
include 'tournamentClass.php';

$playerID = $_SESSION['userID'] ?? null;

// Fetch all tournaments
$sql = "SELECT * FROM tournament";
$result = mysqli_query($conn, $sql);

// Get list of tournaments this player has already joined
$joinedTournaments = [];
if ($playerID && $_SESSION['role'] === 'player') {
    $joinedQuery = "SELECT TournamentID FROM tournament_player WHERE PlayerID = $playerID";
    $joinedResult = mysqli_query($conn, $joinedQuery);
    while ($row = mysqli_fetch_assoc($joinedResult)) {
        $joinedTournaments[] = $row['TournamentID'];
    }
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
        
    </style>
</head>
<body>
    <div class="hero">
    

<div class="tournament-list">
    <h1>Tournament Discovery Page</h1>
    <h3>List of Tournaments</h3>
    <p>Here, you can find a list of currently available tournaments.
        Do you have what it takes to win?
    </p>

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

    <?php
    if (mysqli_num_rows($result) > 0):
        while ($row = mysqli_fetch_assoc($result)):
            $tournament = new Tournament();
            $tournament->setTournamentID($row['TournamentID']);
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
                <h2><?php echo $tournament->getOrganizerUsername(); ?>'s Tournament</h2>
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
        <?php endwhile;
    else:
        echo "<p>No tournaments found.</p>";
    endif;

    mysqli_close($conn);
    ?>
    </div>



    

</body>
<?php include("templates/footer.php"); ?>
</html>
