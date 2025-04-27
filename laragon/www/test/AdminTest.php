<?php
// AdminTest.php
class Admin {
    private $password;

    public function setPassword($password) { $this->password = $password; }
    public function verifyPassword($input) { return $this->password === $input; }
}

$admin = new Admin();
$admin->setPassword("adminPass");

$testInput = "adminPass";

if ($admin->verifyPassword($testInput)) {
    echo "Password verification passed.<br>";
} else {
    echo "Password verification failed.<br>";
}
?>