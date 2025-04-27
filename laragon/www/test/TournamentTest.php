<?php
// TournamentTest.php
require_once '../tournamentClass.php';

echo "<h2>Testing Tournament Class - Age Restriction</h2>";

$tournament = new Tournament();
$tournament->setAgeRequirements(18);

$playerAge = 16;
$allowed = $playerAge >= $tournament->getAgeRequirements();

echo $allowed ? "Player can join tournament." : "Player is too young to join.";
?>

