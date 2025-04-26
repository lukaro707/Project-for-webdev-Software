<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - CompeteNow</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100%;
            background: #f5f7fa;
        }

        .hero {
            background: url('img/backgrounf.avif') center/cover no-repeat;
            height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
            box-shadow: inset 0 0 0 1000px rgba(0, 0, 0, 0.4);
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
            max-width: 600px;
        }

        .buttons {
            display: flex;
            gap: 20px;
        }

        .buttons a {
            text-decoration: none;
            background-color: #4CAF50;
            padding: 12px 24px;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .buttons a:hover {
            background-color: #45a049;
        }

        .content {
            padding: 40px;
            text-align: center;
            background-color: white;
        }

        .content h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 18px;
            color: #555;
            max-width: 800px;
            margin: auto;
        }
    </style>
</head>
<body>

<?php include('templates/header.php'); ?>

<div class="hero">
    <h1>Welcome to CompeteNow</h1>
    <p>Your ultimate platform to join, create, and compete in the hottest gaming tournaments. Ready to show your skills?</p>
    <div class="buttons">
        <a href="register_player.php">Get Started</a>
        <a href="tournament.php">Browse Tournaments</a>
    </div>
</div>

<div class="content">
    <h2>About CompeteNow</h2>
    <p>CompeteNow connects players and organizers around the world through dynamic tournaments and exciting competitions. Whether you are a casual player or a hardcore competitor, our platform gives you the tools to compete, win, and grow your reputation in the gaming community.</p>
</div>

</body>
</html>
