<?php

$host = "localhost";
$dbname = "netland";
$user = "bit_academy";
$password = "bit_academy";
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $err) {
    echo "Database connection problem. " . $err->getMessage();
    exit();
}
