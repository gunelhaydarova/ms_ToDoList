<?php

$servername = "localhost";
$username = "root";
$password = "";

try {
    $db_conn = new PDO("mysql:host=$servername;dbname=restapi", $username, $password);
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
