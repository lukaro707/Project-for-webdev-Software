<?php
session_start();
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'organizer') {
    header("Location: login.php");
    exit;
}

$currentPage = 'create';
include('templates/header.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Tournament</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container {
            max-width: 500px;
            margin: auto;
            background: #fdfdfd;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            background: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }

        .form-container button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Create a New Tournament</h2>
        <form action="create_tournament_handler.php" method="POST">
            <label>Tournament Name:</label>
            <input type="text" name="name" required>

            <label>Start Time:</label>
            <input type="datetime-local" name="start_time" required>

            <label>Age Requirement:</label>
            <input type="number" name="age" required min="0">

            <label>Prize Pool ($):</label>
            <input type="number" name="prize" required min="0">

            <label>Entry Fee ($):</label>
            <input type="number" name="entry_fee" required min="0">

            <label>Rules:</label>
            <textarea name="rules" required></textarea>

            <label>Border Restriction:</label>
            <select name="border_restriction">
                <option value="1">Yes</option>
                <option value="0" selected>No</option>
            </select>

            <button type="submit">Create Tournament</button>
        </form>
    </div>
</body>
</html>
