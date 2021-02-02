<?php
$password = "lösenord"; // Byt för varje användare
echo password_hash($password, PASSWORD_DEFAULT);
?>