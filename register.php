<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/registerCSS.css">

    <title>Register</title>
    <script src = "CSS/miscScripts.js"></script>
</head>
<body>
<div class="main">
    <a href="index.php"><i class="bi bi-house-fill"></i></a>
    <h1 class="text-center">Register</h1>
    <form action="web.php" method="POST" name="form1" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="fname" class="form-label">First Name:</label>
            <input type="text" id="fname" name="firstname" class="form-control">
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">Last Name:</label>
            <input type="text" id="lname" name="lastname" class="form-control">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-Mail:</label>
            <input type="text" id="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="passw" class="form-label">Password:</label>
            <input type="password" id="passw" name="passw" class="form-control" onkeyup="checkPassword()">
            <span id="passwReq"></span>
        </div>
        <div class="mb-3">
            <label for="passwconf" class="form-label">Confirm Password:</label>
            <input type="password" id="passwconf" name="passwConfirm" class="form-control">
        </div>
        <div class="mb-3">
            <label for="phnum" class="form-label">Phone Number:</label>
            <input type="text" id="phnum" name="phone" class="form-control">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" id="address" name="address" class="form-control">
        </div>
        <div class="form-check mb-3 text-center">
            <input type="checkbox" id="dogw1" name="dogw" value="True" class="form-check-input">
            <label for="dogw1" class="form-check-label">I would like to be a Dog walker!</label>
        </div>
        <div class="mb-3 d-grid gap-2">
            <input type="hidden" name="action" value="register">
            <button type="submit" name="Submit" class="btn btn-primary">Register</button>
        </div>
        <?php
        require_once "db_config.php";

        $r = 0;

        if (isset($_GET["r"]) and is_numeric($_GET['r'])) {
            $r = (int)$_GET["r"];

            if (array_key_exists($r, $messages)) {
                echo '
                    <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                        ' . $messages[$r] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
            }
        }
        ?>
    </form>
    <p class="text-center mt-3">Already have an account? Click <a href="login.php">here</a> to login!</p>
</div>
</body>
</html>
