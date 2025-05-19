<?php
include ("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

// db connect
$table = new UsersTable(new MySQL);

// insert query
$table->insert([
    "name" => $_POST['name'],
    "email"=> $_POST['email'],
    "phone"=> $_POST['phone'],
    "address"=> $_POST['address'],
    "password"=> $_POST['password']
]);


// redirect to index.php
HTTP::redirect("/index.php", "register=success");