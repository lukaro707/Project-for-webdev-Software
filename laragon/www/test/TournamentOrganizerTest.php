<?php
// TournamentOrganizerTest.php
class TournamentOrganizer {
    private $organizationID;
    private $createdTournaments = [];

    public function __construct($id) { $this->organizationID = $id; }

    public function createTournament($tournamentName) {
        $this->createdTournaments[] = $tournamentName;
    }

    public function getCreatedTournaments() { return $this->createdTournaments; }
}

$organizer = new TournamentOrganizer(5);
$organizer->createTournament("Summer Cup");

foreach ($organizer->getCreatedTournaments() as $tournament) {
    echo "Created Tournament: $tournament<br>";
}
?>