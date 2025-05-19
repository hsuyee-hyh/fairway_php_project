<?php

include ("../vendor/autoload.php");

use Libs\Database\UsersTable;
use Libs\Database\MySQL;

$table = new UsersTable(new MySQL);

$latest_id = $table->insert([
    'name' => "Alice",
    'email' => "alice@gmail.com",
    'phone' => "093434543",
    'address' =>"Some Address",
    'password' =>"password"
]);

echo $latest_id;