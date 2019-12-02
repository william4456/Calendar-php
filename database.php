<?php $servername = "localhost";
$username = "wjacob";
$password = "root";
$dbname = "calendar";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
