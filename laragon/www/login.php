
<?php
session_start();
include 'databaseConnection.php';
include('templates/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    switch ($role) {
        case 'player':
            $table = 'player';
            $idField = 'PlayerID';
            $usernameField = 'Username';
            break;
        case 'admin':
            $table = 'admin';
            $idField = 'AdminID';
            $usernameField = 'AdminNumber';
            break;
        case 'organizer':
            $table = 'tournamentorganizer';
            $idField = 'OrganizationID';
            $usernameField = 'Username';
            break;
        default:
            die("Invalid role selected.");
    }

    $stmt = $conn->prepare("SELECT * FROM $table WHERE $usernameField = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && (
        ($role === 'admin' && $password === $user['Password']) ||
        (($role === 'player' || $role === 'organizer') &&
            (password_verify($password, $user['Password']) || $password === $user['Password']))
    )) {
        $_SESSION['userID'] = $user[$idField];
        $_SESSION['username'] = $user[$usernameField];
        $_SESSION['role'] = $role;

        switch ($role) {
            case 'player':
                header("Location: dashboard.php");
                break;
            case 'organizer':
                header("Location: dashboard_organizer.php");
                break;
            case 'admin':
                header("Location: dashboard_admin.php");
                break;
        }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login - CompeteNow</title>

    
    <style>
        body {
            color: #ffff;
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
            color: #ffff;
            background: rgba(34, 34, 34, 0.7);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #ffff;
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
    <div class="hero">
        <div class="textBox">

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

        New here? <a href="register_player.php">Register as a Player</a>
    </div>
</div>
    </div>
    </div>
</body>
<div class="footer">
    <?php include('templates/footer.php'); ?>    </div>
</html>
