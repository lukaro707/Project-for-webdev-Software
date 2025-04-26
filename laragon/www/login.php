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
        $error = "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - CompeteNow</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 12px 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #f9f9f9;
            transition: border 0.2s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            font-weight: bold;
            font-size: 16px;
            border-radius: 6px;
            margin-top: 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        .register-link {
            margin-top: 15px;
            display: block;
            font-size: 14px;
        }

        .register-link a {
            text-decoration: none;
            color: #4CAF50;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h1>CompeteNow Login</h1>

    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <select name="role" required>
            <option value="">Login as...</option>
            <option value="player">Player</option>
            <option value="admin">Admin</option>
            <option value="organizer">Organizer</option>
        </select>

        <button type="submit">Login</button>
    </form>

    <div class="register-link">
        New here? <a href="register_player.php">Register as a Player</a>
    </div>
</div>

</body>
</html>
