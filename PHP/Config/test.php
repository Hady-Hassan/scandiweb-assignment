<?php
require_once 'Connection.php';
$connection->connect();

echo $connection->getConnection()->host_info;