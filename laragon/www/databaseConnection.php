<?php
    $connection = new PDO("mysql:dbname=tournament_database;host=localhost", "root", "", array(PDO::ATTR_ERRMOD => PDO::ERRMOD_EXCEPTION));