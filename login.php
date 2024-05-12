

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="loginCSS.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
<nav class = "backHome">
    <a href="index.php">Back to the Home Page</a>
</nav>
<div class = "main">
    <h1>Login</h1>
    <br><br>
    <form action="index.php" method = "post" id = "form1">
        <label for="email">E-Mail: </label>
        <input type="text" id="email" name="email">
        <br><br><br>
        <label for="passw">Password: </label>
        <input type="password" id="passw" name="passw">
        <br><br>
        <button type="submit" name = "logButt" form="form1" value="Login">Login</button>
        <?php
        require_once 'db_config.php';

        $l = 0;

        if (isset($_GET["l"]) and is_numeric($_GET['l'])) {
            $l = (int)$_GET["l"];

            if (array_key_exists($l, $messages)) {
                echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$l] . '
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


