<?php
$host = 'localhost';
$db = 'tournament';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Successfully Connected to Database<br/><br/>";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
