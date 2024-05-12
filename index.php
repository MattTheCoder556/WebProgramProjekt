<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="indexCSS.css">
    <title>Dogwalking</title>
</head>
<body>
<?php
require("db_config.php");
require 'functions.php';

try {
    $sql_str = "";

    if (isset($sql_str)) {
        $sql = "SELECT u_fname, u_lname, u_email, u_phone, active FROM users WHERE walk_switch = 1" . $sql_str;
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
            if(!isset($u['active'])) {
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
<div class = bod1>
    <h2>Welcome to Zoomies<sup>TM</sup></h2><p class = "p1">Where you can search for people who will enable your pet to
        live out their zzzzzzooming needs.</p>
    <p class = "p1">If you want to help these people make their best friends happy, you can also sign up to be a
        dog walker! </p>
    <div class = "row dogimg">
        <div class="col-1"></div>
        <img src="Images/matt-nelson-aI3EBLvcyu4-unsplash.jpg" class = "col-lg-5 col-md-12 dg">
        <img src="Images/camilo-fierro-z7rcwqCi77s-unsplash.jpg" class = "col-lg-5 col-md-12 dg">
        <div class="col-1"></div>
    </div>
</div>
<div class="active">
    <p class ="pr">Our top 5 Most Active Dog Walkers</p>
    <div class = "row">
        <div class = col-lg-1></div>
        <?php
        if (!empty($u)) {
            foreach ($u as $key => $value) {
                $c = 1;
                $c++;
                if($c > 5){
                    break;
                }
                echo'   
           
       <div class = "col-lg-2 col-md-4">
           <div class="card">
               <div class="card-body">
                   <h5 class="card-title">"'. $value['u_fname'] ." ". $value['u_lname'] .'"</h5>
                   <p class="card-text">Activity</p>
               </div>
           </div>
       </div>';
            }
            }
            else
            {
                echo '<p class="dogerror">No users posted right now</p>';
            }
            ?>
    <br><br><br>
    <p class="pr">Our 5 Top Rated Dog Walker</p>
    <div class = "row">
        <div class = col-lg-1>
        </div>
        <?php
        if (!empty($u)) {
            foreach ($u as $key => $value) {
                $c = 1;
                $c++;
                if($c > 5){
                    break;
                }
                echo'   
           
       <div class = "col-lg-2 col-md-4">
           <div class="card">
               <div class="card-body">
                   <h5 class="card-title">"'. $value['u_fname'] ." ". $value['u_lname'] .'"</h5>
                   <p class="card-text">Rating</p>
               </div>
           </div>
       </div>';
            }
        }
        else
        {
            echo '<p class="dogerror">No users posted right now</p>';
        }
        ?>
    </div>
    <a href = "adminUsers.php">To admin</a>
</body>
</html>

