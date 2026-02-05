<?php

$host = "localhost";
// $dbname = " u900885204_hamdan_db";
// $username = " u900885204_hamdan";
// $password = ' ^82^3MV;s$Vv';

$dbname = 'office';
$username = 'root';
$password = '';
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
  die("Error" . $e->getMessage());
}

?>