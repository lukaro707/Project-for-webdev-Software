<?php
session_start();
include 'databaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    switch ($role) {
        case 'player':
            $table = 'player';
            $idField = 'PlayerID';
            break;
        case 'admin':
            $table = 'admin';
            $idField = 'AdminID';
            break;
        case 'organizer':
            $table = 'tournamentorganizer';
            $idField = 'OrganizationID';
            break;
        default:
            die("Invalid role selected.");
    }

    $sql = "SELECT * FROM $table WHERE Username = '$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['userID'] = $user[$idField];
        $_SESSION['username'] = $user['Username'];
        $_SESSION['role'] = $role;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h1>Login</h1>
<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Role:</label><br>
    <select name="role" required>
        <option value="player">Player</option>
        <option value="admin">Admin</option>
        <option value="organizer">Organizer</option>
    </select><br><br>

    <button type="submit">Login</button>
</form>
</body>
</html>
