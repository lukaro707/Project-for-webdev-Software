<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bracketdatabase";   

    $conn = new mysqli($servername, $username, $password, $dbname);

    $qryResult = mysqli_query($conn, "SELECT * FROM user");

    while ($row = mysqli_fetch_assoc($qryResult)){
        echo $row["UserID"] . $row["Username"] . $row["Password"] . $row["EntryFeePermissions"] . $row["isBanned"];
    }