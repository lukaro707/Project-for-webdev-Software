<?php
session_start();
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'player') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player Help - CompeteNow</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            resize: vertical;
        }

        button {
            background-color: #4CAF50;
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 15px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php $currentPage = 'help'; include 'templates/header.php'; ?>

<div class="form-container">
    <h2>Submit a Help Request</h2>
    <form method="POST" action="submit_help.php">
        <label for="message">Your Issue:</label><br>
        <textarea name="message" required></textarea><br>
        <button type="submit">Submit Request</button>
    </form>
</div>

<?php if (isset($_GET['status']) && $_GET['status'] === 'sent'): ?>
    <p style="color: green; font-weight: bold;">Your request has been sent. We’ll get back to you soon!</p>
<?php endif; ?>


</body>
</html>
