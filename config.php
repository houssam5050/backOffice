<?php
require "db.php";

try {
    $con = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);

    $stm1 = $con->prepare("create table favorits ( id int NOT NULL AUTO_INCREMENT,user_id bigint(20) ,product_id 	bigint(20)	, created_at timestamp	, primary key (id))");
    $stm2 = $con->prepare("create table login( id int NOT NULL AUTO_INCREMENT, username varchar(100), email varchar(150), password varchar(255), created_at timestamp,  primary key (id))");
    $stm3 = $con->prepare("create table payment( id int NOT NULL AUTO_INCREMENT,product_id int(9), user_id int(9), primary key (id))");
    $stm4 = $con->prepare("create table products( id int NOT NULL AUTO_INCREMENT, name varchar(255), image varchar(255), price decimal(10,2), category varchar(100), created_at timestamp, updated_at timestamp,  primary key (id))");
    $stm5 = $con->prepare("create table team( id int NOT NULL AUTO_INCREMENT,fname varchar(250), lname varchar(250), job varchar(250),  primary key (id))");
    $stm6 = $con->prepare("create table users( id int NOT NULL AUTO_INCREMENT, username varchar(100), email Index varchar(150), password varchar(255), remember_token varchar(100), created_at timestamp, updated_at timestamp, primary key (id))");
    $stm7 = $con->prepare("create table orders( id int NOT NULL AUTO_INCREMENT, user_id 	int(11), product_id text, total decimal(10,0), status varchar(255), quantity varchar(255), ucreated_at timestamp, primary key (id))");
    $stm5 = $con->prepare("create table team( id int NOT NULL AUTO_INCREMENT,fname varchar(250), lname varchar(250), job varchar(250),  primary key (id))");

    // $stm = $con->prepare("create table users( id int NOT NULL AUTO_INCREMENT, firstname varchar (255) null, lastname varchar(255) null, primary key (id))");
    //$stm = $con->prepare("alter table users add email varchar(255) null");
    //$stm = $con->prepare("drop table users");
    $stm1->execute();
    $stm2->execute();
    $stm3->execute();
    $stm4->execute();
    $stm5->execute();
    $stm6->execute();
    $stm7->execute();

} catch (PDOException $e) {
    die($e);
}
?>