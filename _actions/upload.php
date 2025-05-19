<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;

use Helpers\HTTP;
use Helpers\Auth;

$auth = Auth::check();

print_r($_FILES);

$name = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$type = $_FILES['photo']['type'];

if ($type == "image/jpeg" or $type == "image/png" or $type == "image/jpg") {
    move_uploaded_file($tmp_name, "photos/$name");

    $auth->photo = $name;

    $table = new UsersTable(new MySQL);

    $table->updatePhoto($auth->id, $name);

    HTTP::redirect("/profile.php");
} else {
    HTTP::redirect("/profile.php", "error=type");
}
