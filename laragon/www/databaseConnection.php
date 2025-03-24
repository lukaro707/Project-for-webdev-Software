<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tournament";   

    $conn = new mysqli($servername, $username, $password, $dbname);

    
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
   }
  else
   {
     echo "Successfully Connected to Database<br/><br/>";
   }

    

    ?>