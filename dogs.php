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


$sql_str = "";

if (isset($sql_str)) {
    $sql = "SELECT dog_name, dog_pic, dog_breed, dog_age, dog_bday, dog_gender FROM dogs " . $sql_str;
    if ($result = $connection -> query($sql)) {
        while ($row = $result -> fetch_assoc()) {
            $dogs[] = $row;
        }
    }
}

?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav me-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Homepage</a>
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
        </div>
        <div class="mx-auto order-0">
            <a class="navbar-brand mx-auto">Zoomies</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</body>
<div class = "cards">
    <div class = "row">
        <?php
        if (!empty($dogs)) {
            foreach ($dogs as $key => $value) {
                echo '
        <div class = "col-lg-3 col-sm-6">
            <div class="card">
                <img src="'.$value['dog_pic'].'" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">'.$value['dog_name'].'</h5>
                    <p class="card-text">'.$value['dog_breed'].'<br>'.$value['dog_age'].'<br>'.$value['dog_bday'].'<br>'.$value['dog_gender'].'</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>';
            }
        }
        else {
            echo '<p class="dogerror"> Looks like the dogs have gone to sleep :( </p>';
        }
        ?>
    </div>
</div>
</html>

