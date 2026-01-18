<?php
require "db.php";
$stm = $pdo->prepare("SELECT * FROM login WHERE email=:email AND password=:password");
$stm->bindParam(":email", $_POST["email"]);
$stm->bindParam(":password", $_POST["password"]);
$stm->execute();
$result = $stm->fetch();

if (is_array($result) == true) {
    session_start();
    $_SESSION["account"] = $result;
    header("location:products.php");
} else {
    header("location:index.php");
}