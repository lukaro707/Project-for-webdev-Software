<?php
class Player {
    public $playerID;
    public $username;
    public $password;
    public $score;
    public $isBanned;
    public $team;

    public function setPlayerID($playerID) {
        $this->playerID = $playerID;
    }
    public function getPlayerID() {
        return $this->playerID;
    }

    public function setUsername($username) {
        $this->username = $username;
    }
    public function getUsername() {
        return $this->username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    public function getPassword() {
        return $this->password;
    }

    public function setScore($score) {
        $this->score = $score;
    }
    public function getScore() {
        return $this->score;
    }

    public function setIsBanned($isBanned) {
        $this->isBanned = $isBanned;
    }
    public function getIsBanned() {
        return $this->isBanned;
    }

    public function setTeam($team) {
        $this->team = $team;
    }
    public function getTeam() {
        return $this->team;
    }

    // Display method
    public function displayPlayer() {
        echo "<br>-----------------";
        echo "<br>-- P L A Y E R --";
        echo "<br>-----------------";
        echo "<br>ID: " . $this->getPlayerID();
        echo "<br>Username: " . $this->getUsername();
        echo "<br>Password: " . $this->getPassword(); 
        echo "<br>Score: " . $this->getScore();
        echo "<br>Banned: " . ($this->getIsBanned() ? "Yes" : "No");
        echo "<br>Team: " . $this->getTeam() . "<br>";
    }
}
?>