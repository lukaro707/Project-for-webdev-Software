<?php
// ValidationTesting.php


include '../databaseConnection.php';

$email = "chinedunkem3@gmail.com";
$password = "StrongP@ssword1";
$username = "newuser";
$tournamentDate = "2025-05-15";
$entryFee = 20;

echo "<h3>Validation 1: Email Format</h3>";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.<br>";
} else {
    echo "Valid email format.<br>";
}

echo "<h3>Validation 2: Password Strength</h3>";
function validatePasswordStrength($password) {
    if (strlen($password) < 8) return false;
    if (!preg_match('/[A-Z]/', $password)) return false;
    if (!preg_match('/[a-z]/', $password)) return false;
    if (!preg_match('/[0-9]/', $password)) return false;
    if (!preg_match('/[!@#$%^&*(),.?\\\":{}|<>]/', $password)) return false;
    return true;
}

if (!validatePasswordStrength($password)) {
    echo "Password is too weak.<br>";
} else {
    echo "Password strength is good.<br>";
}

echo "<h3>Validation 3: Username Exists</h3>";
$usernameEscaped = mysqli_real_escape_string($conn, $username);
$query = "SELECT * FROM player WHERE Username = '$usernameEscaped'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "Username already exists.<br>";
} else {
    echo "Username is available.<br>";
}

echo "<h3>Validation 4: Tournament Date</h3>";
$currentDate = date('Y-m-d');
if ($tournamentDate <= $currentDate) {
    echo "Tournament date must be a future date.<br>";
} else {
    echo "Tournament date is valid.<br>";
}

echo "<h3>Validation 5: Entry Fee</h3>";
if ($entryFee < 0) {
    echo "Entry fee cannot be negative.<br>";
} else {
    echo "Entry fee is valid.<br>";
}

mysqli_close($conn); // Close database connection
?>
