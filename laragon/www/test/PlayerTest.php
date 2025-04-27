<?php
// PlayerTest.php
require_once '../PlayerClass.php';

echo "<h2>Testing Player Class - Score Update</h2>";

$player = new Player();
$player->setPlayerID(1);
$player->setUsername("TestPlayer");
$player->setScore(50);

// Simulate scoring points
$player->setScore($player->getScore() + 20);

echo "Updated Score: " . $player->getScore() . "<br>";
assert($player->getScore() === 70);
?>

