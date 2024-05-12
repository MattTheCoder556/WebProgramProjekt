<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="dogsCSS.css">
    <title>Our Dogs</title>
</head>
<body>
<?php
require("db_config.php");
require 'functions.php';

try {
    $sql_str = "";

    if (isset($sql_str)) {
        $sql = "SELECT u_fname, u_lname, u_phone, u_email, walk_switch FROM users WHERE walk_switch != NULL" . $sql_str;
        $stmt = $pdo->query($sql);

        $u = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Zoomies</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Homepage</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="walkers.php">Our Walkers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dogs.php">Our Dogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            <?php
            if(!isset($u['registration_token'])) {
                echo '
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
            </ul>
                ';
            }
            else{
                echo'
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="user.php"><i class="bi bi-person-fill"></i></a>
                </li>
                ';
            }
            ?>
        </div>
    </div>
</nav>
<div class="row">
    <?php
    if (!empty($u)) {
        foreach ($u as $key => $value) {
            echo '
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">'.$value['u_fname'].'" "'.$value['u_lname'].'</h5>
                    <p class="card-text">'.$value['u_phone'].'<br>'.$value['u_email'].'</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>';
        }
    } else {
        echo '<p class="dogerror"> Something went wrong! </p>';
    }
    ?>
</div>
</body>
</html>
