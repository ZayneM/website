<?php
//CONNECTION FILE
$host = "localhost";
$username = "zayne";
$pass = "2Everykid!";
$dbname = "zayne";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);
$connection = new PDO($dsn, $username, $pass, $options);
