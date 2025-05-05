<?php
// PlayerTest.php
require_once '../PlayerClass.php';

echo "<h2>Testing Player Class - Score Update</h2>";

$player = new Player(); //creates new oobject
$player->setPlayerID(1);
$player->setUsername("TestPlayer");
$player->setScore(50); //sets it to 50 

// Simulate scoring points
$player->setScore($player->getScore() + 20);// score updating

echo "Updated Score: " . $player->getScore() . "<br>";
assert($player->getScore() === 70);
?>

