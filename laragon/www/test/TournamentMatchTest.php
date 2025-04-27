<?php
// TournamentMatchTest.php
class TournamentMatch {
    private $isHeld = false;

    public function startMatch() { $this->isHeld = true; }
    public function getIsHeld() { return $this->isHeld; }
}

$match = new TournamentMatch();

$match->startMatch();

echo $match->getIsHeld() ? "Match is now held." : "Match not started.";
?>
