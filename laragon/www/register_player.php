<?php
include 'databaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO player (Username, Password, EntryFeePermissions, IsBanned, CreatedAt)
            VALUES ('$username', '$password', 1, 0, NOW())";

    $_SESSION['userID'] = mysqli_insert_id($conn); 
    $_SESSION['username'] = $username;
    $_SESSION['role'] = 'player';
    header("Location: dashboard.php");
    exit();


    if (mysqli_query($conn, $sql)) {
        echo "Player registered successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register as Player</title>
</head>
<body>

<h1>Register - Player</h1>
<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>
</form>

</body>
</html>
