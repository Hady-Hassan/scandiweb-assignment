<?php
require_once 'PHP\Config\DataBase Connection.php';

$host = "localhost";
$username = "root";
$password = "";
$database = "scandiweb";

$connection = new Database($host, $username, $password, $database);

print($connection->connect());

//check connection
