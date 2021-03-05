<?php
$host = 'localhost';     // adresa server MySQL
$user = 'root';          // Nume utilizator
$pass = '';              // Parola de access
$dbname = 'cs';         // Nume baza de date

$con = mysqli_connect($host, $user, $pass, $dbname);
if (!$con) {
    echo "Eroare: Nu a fost posibilă conectarea la MySQL." . PHP_EOL;
    echo "Valoarea errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Valoarea error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


?>