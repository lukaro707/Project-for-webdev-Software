<?php
include("templates/header.php");
session_start();
session_unset();
session_destroy();
header("Location: login.php");
include("templates/footer.php");
exit;
