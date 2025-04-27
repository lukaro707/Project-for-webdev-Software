<?php
session_start();
?>

<!DOCTYPE html>
< lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - CompeteNow</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>


<?php include('templates/header.php'); ?>


<div class="hero">
    <h1>Welcome to CompeteNow</h1>
    <p>Your ultimate platform to join, create, and compete in the hottest gaming tournaments. Ready to show your skills?</p>
    <div class="buttons">
        <a href="register_player.php">Get Started</a>
        <a href="tournament.php">Browse Tournaments</a>
</div>



<div class="textBox">
    <h2>About CompeteNow</h2>
    <p>CompeteNow connects players and organizers around the world through dynamic tournaments and exciting competitions. Whether you are a casual player or a hardcore competitor, our platform gives you the tools to compete, win, and grow your reputation in the gaming community.</p>

</div>

<?php include('templates/footer.php'); ?>

</html>
