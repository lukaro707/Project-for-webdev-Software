<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tournament Page</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>

<?php
    include("templates/header.php");

    // Sample data for players and matches
    $players = ["Player 1", "Player 2", "Player 3", "Player 4"];
    $matches = [
        ["Player 1", "Player 2"],
        ["Player 3", "Player 4"],
        ["Winner of Match 1", "Winner of Match 2"]
    ];
?>

<div>
    <h1>Tournament Page</h1>
    <p>View Tournament Bracket and Report Scores</p>
</div>
<br>
<strong>Start Time:</strong> 2.00 PM <br>
<strong>Location: </strong> Europe<br><br>

<!-- Registration Form -->
<form action="register.php" method="post">
    <label for="playerName">Player Name:</label>
    <input type="text" id="playerName" name="playerName" required><br><br>
    <button type="submit">Register for Tournament</button>
</form>
<br>

<!-- Player List -->
<div>
    <h2>Registered Players</h2>
    <ul>
        <?php foreach ($players as $player): ?>
            <li><?php echo htmlspecialchars($player); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<br>

<!-- Simple Tournament Bracket -->
<div style="height:40vh;width:100%;overflow:scroll;border-style:solid">
    <h2>Tournament Bracket</h2>
    <ul>
        <?php foreach ($matches as $match): ?>
            <li><?php echo htmlspecialchars($match[0]) . " vs " . htmlspecialchars($match[1]); ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- Match Results Form -->
<div>
    <h2>Report Match Results</h2>
    <form action="report_results.php" method="post">
        <label for="match">Match:</label>
        <select id="match" name="match">
            <?php foreach ($matches as $index => $match): ?>
                <option value="<?php echo $index; ?>"><?php echo htmlspecialchars($match[0]) . " vs " . htmlspecialchars($match[1]); ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="winner">Winner:</label>
        <input type="text" id="winner" name="winner" required><br><br>
        <button type="submit">Submit Result</button>
    </form>
</div>

<div>
    <h2>Tournament Winner</h2>
    <?php
        if (isset($matches[2][2])) {
            echo "<p>Congratulations to " . htmlspecialchars($matches[2][2]) . " for winning the tournament!</p>";
        } else {
            echo "<p>The tournament is still ongoing.</p>";
        }
    ?>
</div>
</body>
</html>