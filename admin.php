<?php

include("./vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;

use Helpers\Auth;

$auth = Auth::check();

$table = new UsersTable(new MySQL);
$users = $table->all();

// $table->update($users);

$roles = $table->allRoles();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js" defer></script>
    <title>Admin</title>
</head>

<body>
    <nav class="navbar bg-primary navbar-dark navbar-expand">
        <div class="container">
            <a href="#" class="navbar-brand">Admin</a>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="./profile.php" class="nav-link"><?= $auth->name ?></a>
            </li>
            <li class="nav-item">
                <a href="./_actions/logout.php" class="nav-link">Logout</a>
            </li>
        </ul>
    </nav>


    <div class="container mt-4">
        <div class="table-responsive-sm">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <th scope="row"><?= $user->id ?></th>
                            <td><?= $user->name ?></td>
                            <td><?= $user->email ?></td>
                            <td><?= $user->password ?></td>

                            <td>
                                <?php if ($user->role_id == 3): ?>
                                    <span class="badge bg-success">
                                        <?= $user->role ?>
                                    </span>
                                <?php elseif ($user->role_id == 2): ?>
                                    <span class="badge bg-primary">
                                        <?= $user->role ?>
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">
                                        <?= $user->role ?>
                                    </span>
                                <?php endif ?>
                            </td>


                            <?php if ($auth->role_id >= 2): ?>
                                <td>
                                    <div class="btn-group dropdown">
                                        <?php if ($auth->role_id == 3): ?>
                                            <a href="#" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">Role</a>
                                            <div class="dropdown-menu">
                                                <?php foreach ($roles as $role): ?>
                                                    <a href="./_actions/role.php?id=<?= $user->id ?>&role=<?= $role->id ?>" class="dropdown-item"><?= $role->name ?></a>
                                                <?php endforeach ?>
                                            </div>
                                        <?php endif ?>

                                        <?php if ($auth->role_id == 2 or $auth->role_id == 3): ?>
                                            <?php if ($user->suspended): ?>
                                                <a href="./_actions/unsuspend.php?id=<?= $user->id ?>" class="btn btn-sm btn-warning">Ban</a>
                                            <?php else: ?>
                                                <a href="./_actions/suspend.php?id=<?= $user->id ?>" class="btn btn-sm btn-outline-warning">Ban</a>
                                            <?php endif ?>
                                        <?php endif ?>

                                        <a href="./_actions/delete.php?id=<?= $user->id ?>"
                                            class="btn btn-sm btn-outline-danger">Delete</a>
                                    </div>
                                </td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>