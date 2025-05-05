<?php
// AdminTest.php
class Admin {
    private $password;

    public function setPassword($password) { $this->password = $password; }
    public function verifyPassword($input) { return $this->password === $input; }
}

$admin = new Admin();
$admin->setPassword("adminPass");//saves the password

$testInput = "adminPass";

if ($admin->verifyPassword($testInput)) { //this checks if an entered password matches the stored one
    echo "Password verification passed.<br>";
} else {
    echo "Password verification failed.<br>";
}
?>