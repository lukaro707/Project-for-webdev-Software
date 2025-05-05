<?php
session_start();
include 'databaseConnection.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'organizer') {
    header("Location: login.php");
    exit;
}

$tournamentID = $_GET['id'] ?? null;

if (!$tournamentID) {
    echo "Invalid tournament ID.";
    exit;
}

$stmt = $conn->prepare("SELECT * FROM tournament WHERE TournamentID = :id");
$stmt->execute(['id' => $tournamentID]);
$tournament = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tournament) {
    echo "Tournament not found.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tournament</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        label { display: block; margin-top: 10px; }
        input, textarea { width: 300px; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Edit Tournament: <?php echo htmlspecialchars($tournament['Name']); ?></h2>

    <form action="update_tournament.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $tournamentID; ?>">

        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($tournament['Name']); ?>" required>

        <label>Start Time:</label>
        <input type="datetime-local" name="start_time" value="<?php echo date('Y-m-d\TH:i', strtotime($tournament['StartTime'])); ?>" required>

        <label>Age Requirements:</label>
        <input type="number" name="age" value="<?php echo $tournament['AgeRequirements']; ?>" required>

        <label>Prize Pool:</label>
        <input type="number" name="prize" value="<?php echo $tournament['PrizePool']; ?>" required>

        <label>Entry Fee:</label>
        <input type="number" name="entry_fee" value="<?php echo $tournament['EntryFee']; ?>" required>

        <label>Rules:</label>
        <textarea name="rules" required><?php echo htmlspecialchars($tournament['Rules']); ?></textarea>

        <label>Border Restriction:</label>
        <select name="border">
            <option value="1" <?php echo $tournament['HasBorderRestriction'] ? 'selected' : ''; ?>>Yes</option>
            <option value="0" <?php echo !$tournament['HasBorderRestriction'] ? 'selected' : ''; ?>>No</option>
        </select>

        <button type="submit">Update Tournament</button>
    </form>
</body>
</html>
