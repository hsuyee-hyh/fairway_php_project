<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;


$mysql = new MySQL;
$connection = $mysql->connect();

$result = $connection->query("SELECT * FROM roles");
print_r($result->fetchAll());