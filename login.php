<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/loginCSS.css">

    <title>Login</title>
</head>
<body>
<div class="main">
    <a href="index.php"><i class="bi bi-house-fill"></i></a>
    <h1 class="text-center">Login</h1>
    <form action="web.php" method="post" name="form1" class="mt-4">
        <div class="mb-3">
            <label for="email" class="form-label">E-Mail:</label>
            <input type="text" id="email" name="username" class="form-control">
        </div>
        <div class="mb-3">
            <label for="passw" class="form-label">Password:</label>
            <input type="password" id="passw" name="passw" class="form-control">
        </div>
        <input type="hidden" name="action" value="login">
        <button type="submit" name="Submit" class="btn btn-primary btn-block">Login</button>
        <?php
        require_once 'db_config.php';

        $l = 0;

        if (isset($_GET["l"]) and is_numeric($_GET['l'])) {
            $l = (int)$_GET["l"];

            if (array_key_exists($l, $messages)) {
                echo '
                    <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                        ' . $messages[$l] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
            }
        }
        ?>
    </form>
    <p class="text-center mt-3">Don't have an account yet? Click <a href="register.php">here</a> to register!</p>

    <a href="#" id="fl">Have you forgotten your password?</a>
    <form action="web.php" method="post" name="forget" id="forgetForm">
        <div class="pt-3">
            <label for="forgetEmail" class="form-label">E-mail</label>
            <input type="text" class="form-control" id="forgetEmail" placeholder="Enter your e-mail address"
                   name="email">
            <small></small>
        </div>
        <script src = "CSS/hide.js"></script>
        <div class="pt-3">
            <input type="hidden" name="action" value="forget">
            <button type="submit" class="btn btn-primary">Reset password</button>
        </div>
    </form>
</div>

</body>
</html>
