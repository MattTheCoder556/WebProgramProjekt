<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="registerCSS.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <title>Register</title>
</head>
<body>
<nav class = "backHome">
    <a href="index.php">Back to the Home Page</a>
</nav>
<div class = "main">
    <h1>Register</h1>
    <br><br>
    <form action="web.php" method = "POST" name = "form1">
        <label for="fname">First Name: </label>
        <input type="text" id="fname" name="firstname">
        <br><br><br>
        <label for="lname">Last Name: </label>
        <input type="text" id="lname" name="lastname">
        <br><br><br>
        <label for="email">E-Mail: </label>
        <input type="text" id="email" name="email">
        <br><br><br>
        <label for="passw">Password: </label>
        <input type="password" id="passw" name="passw">
        <br><br><br>
        <label for="passwconf">Confirm Password: </label>
        <input type="password" id="passwconf" name="passwConfirm">
        <br><br><br>
        <label for="phnum">Phone Number: </label>
        <input type="text" id="phnum" name="phone">
        <br><br><br>
        <label for="address">Address: </label>
        <input type="text" id="address" name="address">
        <br><br><br>
        <input type="checkbox" id="dogw1" name="dogw" value="True">
        <label for = "dogw1">I would like to be a Dog walker!</label>
        <br><br><br>
        <input type="hidden" name="action" value="register">
        <button type="submit" name="Submit">Register</button>
        <?php
        require_once "db_config.php";

        $r = 0;

        if (isset($_GET["r"]) and is_numeric($_GET['r'])) {
            $r = (int)$_GET["r"];

            if (array_key_exists($r, $messages)) {
                echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$r] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
            }
        }
        ?>
    </form>
</div>
</body>
</html>

