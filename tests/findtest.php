<?php

include ("../vendor/autoload.php");

use Libs\Database\UsersTable;
use Libs\Database\MySQL;

$table = new UsersTable(new MySQL);
$found_user = $table->find("alice@gmail.com", "password");

if ($found_user){
    print_r($found_user);
}else{
    echo "incorrect email or password";
}
