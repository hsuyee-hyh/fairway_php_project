<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container text-center" style="max-width:600px">
        <h1 class="h3 mt-4 mb-3">Login</h1>

        <?php if (isset($_GET['suspended'])): ?>
            <div class="alert alert-danger">Account Suspended</div>
        <?php endif ?>

        <?php if (isset($_GET['wrong'])): ?>
            <div class="alert alert-warning">Incorrect Password</div>
        <?php endif ?>


        <?php if (isset($_GET['incorrect'])): ?>
            <div class="alert alert-warning">Incorrect Email or Password</div>
        <?php endif ?>

        <!-- register check  -->
        <?php if (isset($_GET['register'])): ?>
            <div class="alert alert-success">Register Success, please Login</div>
        <?php endif ?>

        <form action="_actions/login.php" method="post" class="mb-2">
            <input type="email" name="email" id="" class="form-control mb-2" placeholder="Email" required>
            <input type="password" name="password" id="" placeholder="password" class="form-control mb-2">
            <button class="btn btn-primary w-100">Login</button>
        </form>

        <a href="register.php">Register</a>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>