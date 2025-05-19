
<?php

include("../vendor/autoload.php");

use Libs\Database\UsersTable;
use Libs\Database\MySQL;

use Helpers\HTTP;


// extract user => find()
$table = new UsersTable(new MySQL);

$found_user = $table->find($_POST['email'], $_POST['password']);

// store user in $_SESSION
// redirect to profile.php
if ($found_user == "wrong password") {
    HTTP::redirect("/index.php", "wrong=password");
} else if ($found_user) {
    if ($user->suspended == 1) {
        HTTP::redirect("/index.php", "suspended=account");
    }
    session_start();
    $_SESSION['user'] = $found_user;
    HTTP::redirect("/profile.php");
} else {
    HTTP::redirect("/index.php", "incorrect=login");
}



// store user in $_SESSION
// $email = $_POST['email'];
// $password = $_POST['password'];

// if ($email == "alice@gmail.com" && $password =="password"){
// session_start();
// $_SESSION['user'] = [ "name" => "Alice" ];
// header("location: ../profile.php");
// }else{
// header("location: ../index.php?incorrect=login");
// }
?>
