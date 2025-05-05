<?php
session_start();
include("templates/header.php");
include 'databaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if username already exists
    $checkStmt = $conn->prepare("SELECT * FROM player WHERE Username = :username");
    $checkStmt->bindParam(':username', $username);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        $error = "Username already exists. Please choose another.";
    } else {
        // Insert new player
        $sql = "INSERT INTO player (Username, Password, EntryFeePermissions, IsBanned, CreatedAt)
                VALUES (:username, :password, 1, 0, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            header("Location: login.php?registered=1");
            exit;
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CompeteNow</title>
    <style>
        body {
            background-image: url("img/backgrounf.avif");
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
        }

        .register-container {
            margin: 20px;
            background: rgba(34, 34, 34, 0.8);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            color: #fff;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 26px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #f9f9f9;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
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
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        .login-link {
            margin-top: 15px;
            display: block;
            font-size: 14px;
        }

        .login-link a {
            text-decoration: none;
            color: #4CAF50;
        }
    </style>
</head>
<body>

<main>
    <div class="register-container">
        <h1>Create Account</h1>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="register_player.php">
            <input type="text" name="username" placeholder="Choose a Username" required>
            <input type="password" name="password" placeholder="Choose a Password" required>
            <button type="submit">Register</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</main>

<?php include("templates/footer.php"); ?>
</body>
</html>
