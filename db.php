<?php

$lhost = "localhost";
$dbname = 'office';
$username = 'root';
$password = '';
try {
  $pdo = new PDO("mysql:host=$lhost;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
  die("Error" . $e->getMessage());
}

?>