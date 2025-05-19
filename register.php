<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container text-center" style="max-width:600px">
        <h1 class="h3 mt-4 mb-3">Register</h1>

        <?php if(isset($_GET['incorrect'])): ?>
        <div class="alert alert-warning">Incorrect Email or Password</div>

        <?php endif ?>

        <form action="_actions/create.php" method="post" class="mb-2">
            <input type="text" name="name" id="" class="form-control mb-2" placeholder="name" required>
            <input type="email" name="email" id="" class="form-control mb-2" placeholder="Email" required>
            <input type="text" name="phone" class="form-control mb-2" id="" placeholder="phone" required>
            <input type="password" name="password" id="" placeholder="password" class="form-control mb-2">
    
            <textarea name="address" class="form-control mb-2"  id="" placeholder="address" required></textarea>
            <button class="btn btn-primary w-100">Register</button>
        </form>

        <a href="index.php">Login</a>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>