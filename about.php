<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/aboutCSS.css">
    <title>About Us</title>
</head>
<body>
<?php
require("db_config.php");

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
            session_start();

            if(!isset($_SESSION['username'])){
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
                    <a class="nav-link" href="user.php"><i class="bi bi-person-fill"></i>&nbsp;Profile</a>
                </li>
                </ul>';
            }
            ?>
        </div>
    </div>
</nav>
<div class="head">
    <h1 class="h1">About the company!</h1>
    <br>
    <p class="p1">Don't have time to take your dog for a walk, because your overcrowded with work? Maybe your sick and
        don't have the energy to go out?<br><b>No problem!</b><br>
        Our company focuses on these people who need someone to help them out, and make their pets happy and live out
        their zooming needs. <br>We even plan to collaborate with shelters, so even they get the love they all need and
        deserve.</p>
</div>
<div class = "row dogimg">
    <img src="Images/krakenimages-376KN_ISplE-unsplash.jpg" class = "col-lg-6 col-md-12 dg">
    <img src="Images/eric-ward-ISg37AI2A-s-unsplash.jpg" class = "col-lg-6 col-md-12 dg">
</div>
<div class=head2>
    <h1 class="h1">Beginnings</h1>
    <br>
    <p class="p2">The idea came form seeing a lot of friends and family struggling to break some time to spend time with
        their pets, and the pets getting a liiitle bit overweight.<br>
        Asking on the internet if someone is available(e.g. Facebook, Instagram, etc.) can be a little tedious, so I
        came up with an idea that is easy to do and practical for everyday use.</p>
    <br><div class = "web">A <div class = "w">w</div><div class = "e">e</div><div class = "b">b</div><div class = "s">s</div><div class = "i">i</div><div class = "t">t</div><div class = "e">e</div><div class = "ex">!</div></div><br>
    <p class = "p2">On here, everyone can either put up their dog, so people can see their pets lovely attributes(name, age, breed,
        etc.), and if you want to get out and move yourself, you can even register as a Dog Walker!</p>
</div>
</body>
</html>

<?php
