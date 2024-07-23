<?php
$password = "uth@oo123"; //admin@example.com
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo $hashedPassword;

?>