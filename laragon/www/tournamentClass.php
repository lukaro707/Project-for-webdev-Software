<?php
class Tournament {
    private $tournamentID;
    private $organizerUsername;
    private $startTime;
    private $ageRequirements;
    private $rules;
    private $hasBorderRestriction;
    private $prizePool;
    private $entryFee;

    private $name;  

    public function __construct(
        $tournamentID = null,
        $organizerUsername = null,
        $startTime = null,
        $ageRequirements = null,
        $rules = null,
        $hasBorderRestriction = null,
        $prizePool = null,
        $entryFee = null
    ) {
        $this->tournamentID = $tournamentID;
        $this->organizerUsername = $organizerUsername;
        $this->startTime = $startTime;
        $this->ageRequirements = $ageRequirements;
        $this->rules = $rules;
        $this->hasBorderRestriction = $hasBorderRestriction;
        $this->prizePool = $prizePool;
        $this->entryFee = $entryFee;
    }


    public function getName() {
        return $this->name;
    }

    public function getTournamentID() {
        return $this->tournamentID;
    }

    public function getOrganizerUsername() {
        return $this->organizerUsername;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function getAgeRequirements() {
        return $this->ageRequirements;
    }

    public function getRules() {
        return $this->rules;
    }

    public function getHasBorderRestriction() {
        return $this->hasBorderRestriction;
    }

    public function getPrizePool() {
        return $this->prizePool;
    }

    public function getEntryFee() {
        return $this->entryFee;
    }

    // Setters

    public function setName($name) {
        $this->name = $name;
    }
    
    public function setTournamentID($tournamentID) {
        $this->tournamentID = $tournamentID;
    }

    public function setOrganizerUsername($organizerUsername) {
        $this->organizerUsername = $organizerUsername;
    }

    public function setStartTime($startTime) {
        $this->startTime = $startTime;
    }

    public function setAgeRequirements($ageRequirements) {
        $this->ageRequirements = $ageRequirements;
    }

    public function setRules($rules) {
        $this->rules = $rules;
    }

    public function setHasBorderRestriction($hasBorderRestriction) {
        $this->hasBorderRestriction = $hasBorderRestriction;
    }

    public function setPrizePool($prizePool) {
        $this->prizePool = $prizePool;
    }

    public function setEntryFee($entryFee) {
        $this->entryFee = $entryFee;
    }

    // Display method
    public function displayTournament() {
        echo "<br>-----------------------";
        echo "<br>-- T O U R N A M E N T --";
        echo "<br>-----------------------";
        echo "<br>ID: " . $this->getTournamentID();
        echo "<br>Organizer: " . $this->getOrganizerUsername();
        echo "<br>Start Time: " . $this->getStartTime();
        echo "<br>Age Requirements: " . $this->getAgeRequirements();
        echo "<br>Rules: " . $this->getRules();
        echo "<br>Border Restriction: " . ($this->getHasBorderRestriction() ? "Yes" : "No");
        echo "<br>Prize Pool: $" . $this->getPrizePool();
        echo "<br>Entry Fee: $" . $this->getEntryFee() . "<br>";
    }
}
?>