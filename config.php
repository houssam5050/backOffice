<?php
require "db.php";

$correct_username = "houssam_devloper";
$correct_password = "houssam@12345";

$stmt = $con->prepare("INSERT INTO login (username, password, created_at) VALUES (?, ?, NOW())");
$stmt->bind_param("ss", $correct_username, $correct_password);
$stmt->execute();

?>