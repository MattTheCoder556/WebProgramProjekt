<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
            http-equiv="X-UA-Compatible"
            content="IE=edge"
    />
    <meta
            name="viewport"
            content="width=device-width,
                   initial-scale=1.0"
    />
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
        $sql = "SELECT d_pic, d_name, d_breed, d_gender, d_age, d_desc FROM dogs " . $sql_str;
        $stmt = $pdo->query($sql);

        $dogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();

/*if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $search_arr = explode(' ', $search);
    $search_terms = array_filter($search_arr, function($value) {
        return mb_strlen($value) > 2;
    });

    if (!empty($search_terms)) {
        $where = array();
        foreach ($search_terms as $term) {
            $where[] = "d_name LIKE ? OR d_breed LIKE ? OR d_gender LIKE ? OR d_age LIKE ?";
        }
        $where_clause = implode(' OR ', $where);
        $sql = "SELECT * FROM dogs WHERE '$where_clause'";

        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $param = '%' . $search . '%';
        $params = array_fill(0, count($search_terms) * 2, $param);
        $i = 1;
        foreach ($params as $param) {
            $stmt->bindParam($i++, $param, PDO::PARAM_STR);
        }

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}*/
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
</body>
<div class="cards">
    <!--<form class="product-search" method="get">
        <input placeholder="Search" name="search" type="text">
        <button type="submit">Go</button>
    </form>-->
    <div class="row">
        <?php
        if (!empty($dogs)) {
            foreach ($dogs as $key => $value) {
                echo '
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <img src="Images/'.$value['d_pic'].'" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">'.$value['d_name'].'</h5>
                    <p class="card-text">'.$value['d_breed'].'<br>'.$value['d_gender'].'<br>'.$value['d_age'].'<br>'.$value['d_desc'].'</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>';
            }
        } else {
            echo '<p class="dogerror"> Looks like the dogs have gone to sleep :( </p>';
        }
        ?>
    </div>

    <style>
        .popup {
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            border-radius: 10px;
            background-color: rgba(
                    0,
                    0,
                    0,
                    0.4
            );
            display: none;
        }
        .popup-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888888;
            width: 30%;
            font-weight: bolder;
        }
        .popup-content button {
            display: block;
            margin: 0 auto;
        }
        .show {
            display: block;
        }
    </style>

    <h3>
        Add your pet here!
    </h3>
    <button id = "addNew" name = "click" style = "border-radius: 10px">Click me</button>

        <div id="myPopup" class="popup">
            <div class="popup-content" style = "border: 1px solid; padding: 5px; border-radius: 10px; text-align: center">
                <h4>Insert information about your pet!</h4>
                <div style = "border: 1px solid; padding: 5px; border-radius: 10px; text-align: center">
                    <form name = "addPet" method = "POST" enctype="multipart/form-data" action = "upload.php">
                        <label for = "file">Picture: </label><br>
                        <input placeholder="Photo" type="file" name='d_pic'><br>
                        <label for = "name">Name: </label><br>
                        <input placeholder="Name" type="text" name='d_name'><br>
                        <label for = "breed">Breed: </label><br>
                        <input placeholder="Breed" type="text" name='d_breed'><br>
                        <label for = "gender">Gender: </label><br>
                        <input placeholder="Gender" type="text" name='d_gender'><br>
                        <label for = "age">Age: </label><br>
                        <input placeholder="Age" type="text" name='d_age'><br>
                        <label for = "desc" style = "text-align: center">About your pet: </label><br>
                        <textarea placeholder="Description" name = 'd_desc' rows="7"></textarea><br>
                        <input type = "submit" name="submit" value="Submit" onclick="refreshPage()">
                        <script>
                            if ( window.history.replaceState ) {
                                window.history.replaceState( null, null, window.location.href );
                            }
                        </script>
                    </form>
                    <button id="closePopup">
                        Close
                    </button>
                </div>
            </div>
        </div>
    <script src = "popupWindow.js"></script>
</div>
</html>