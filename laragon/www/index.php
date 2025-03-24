<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tournament Discovery Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .tournament-list {
            margin-top: 20px;
        }
        .tournament-item {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .tournament-item h2 {
            margin: 0;
        }
        .tournament-item img {
            max-width: 100%;
            height: auto;
        }
    </style>
    <script src=""></script>
</head>
<body>

<?php
    include("templates/header.php");
?>

<div class="tournament-list">
    <h1>Tournament Discovery Page</h1>
    <h3>List of Tournaments</h3>
    <input type="text" placeholder="Search...">

    <?php

    
    include 'databaseConnection.php'; 
    include 'tournamentClass.php'; 

    $sql = "SELECT * FROM tournament;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $tournament = new Tournament();
            $tournament->setTournamentID($row['TournamentID']);
            $tournament->setOrganizerUsername($row['OrganizerUsername']);
            $tournament->setStartTime($row['StartTime']);
            $tournament->setAgeRequirements($row['AgeRequirements']);
            $tournament->setRules($row['Rules']);
            $tournament->setHasBorderRestriction($row['HasBorderRestriction']);
            $tournament->setPrizePool($row['PrizePool']);
            $tournament->setEntryFee($row['EntryFee']);

            echo '<div class="tournament-item">';
            echo '<a href="www.google.com"><h2>' . $tournament->getOrganizerUsername() . "'s Tournament</h2></a>";
            echo '<p>Start Time: ' . $tournament->getStartTime() . '</p>';
            echo '<p>Age Requirements: ' . $tournament->getAgeRequirements() . '+</p>';
            echo '<p>Rules: ' . $tournament->getRules() . '</p>';
            echo '<p>Border Restriction: ' . ($tournament->getHasBorderRestriction() ? "Yes" : "No") . '</p>';
            echo '<p>Prize Pool: $' . $tournament->getPrizePool() . '</p>';
            echo '<p>Entry Fee: $' . $tournament->getEntryFee() . '</p>';
            echo '</div>';
        }
    } else {
        echo "<p>No tournaments found.</p>";
    }

    mysqli_close($conn);
    ?>
</div>

</body>
</html>