<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/dogsCSS.css">
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
            background-color: rgba(0, 0, 0, 0.4);
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
    <title>Our Dogs</title>
</head>
<body>
<?php
require("db_config.php");
session_start();

function isDogWalker($username, $pdo) {
    $sql = "SELECT walk_switch FROM users WHERE u_email = :username AND walk_switch = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$search = isset($_GET['search']) ? $_GET['search'] : '';

try {
    $sql = "SELECT d_id, d_pic, d_name, d_breed, d_gender, d_age, d_desc, walk_day, booked_by FROM dogs";
    if (!empty($search)) {
        $sql .= " WHERE d_name LIKE :search OR d_breed LIKE :search OR d_gender LIKE :search OR d_age LIKE :search OR d_desc LIKE :search";
    }
    $stmt = $pdo->prepare($sql);
    if (!empty($search)) {
        $searchParam = '%' . $search . '%';
        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
    }
    $stmt->execute();
    $dogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$isDogWalker = false;
if (isset($_SESSION['username'])) {
    $isDogWalker = isDogWalker($_SESSION['username'], $pdo);
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
            if (!isset($_SESSION['username'])) {
                echo '
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                </ul>';
            } else {
                echo '
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

<div class="cards">
    <form class="product-search" method="get" action="dogs.php">
        <input placeholder="Search" name="search" type="text" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Go</button>
    </form>
    <div class="row">
        <?php
        foreach ($dogs as $key => $value) {
            // Fetch other dog details
            $dogName = $value['d_name'];
            $dogBreed = $value['d_breed'];
            $dogGender = $value['d_gender'];
            $dogAge = $value['d_age'];
            $dogDesc = $value['d_desc'];
            $walkDay = $value['walk_day'];
            $bookedBy = $value['booked_by'];

            echo '
<div class="col-lg-3 col-sm-6">
    <div class="card">
        <img src="Images/' . $value['d_pic'] . '" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title">Name: ' . $dogName . '</h5>
            <p class="card-text">Breed: ' . $dogBreed . '<br>Gender: ' . $dogGender . '<br>Age: ' . $dogAge . '<br>Description: ' . $dogDesc . '</p>';

            // Display walk day and booked by if it exists
            if ($walkDay) {
                echo '<p>Walk Day: ' . $walkDay . '</p>';
                if ($bookedBy) {
                    echo '<p>Booked by: ' . $bookedBy . '</p>';
                }
            } else {
                echo '<p>No walk day selected</p>';
            }

            // Existing button for dog walkers
            if ($isDogWalker) {
                if (!$walkDay || $bookedBy == $_SESSION['u_id']) {
                    echo '
<button class="btn btn-primary" id = "openPopUp" onclick="showPopup(\'popup-' . $key . '\')">Select Walk Day</button>';
                } else {
                    echo '<p>This dog has already been booked by another walker.</p>';
                }
            }

            // Popup for selecting walk day
            echo '
    <div id="popup-' . $key . '" class="popup">
        <div class="popup-content">
            <h4>Select Walk Day for ' . $dogName . '</h4>
            <form method="POST" action="process_walk_day.php">
                <input type="hidden" name="dog_id" value="' . $value['d_id'] . '">
                <label for="walk_day">Select Day:</label>
                <input type="date" id="walk_day" name="walk_day" required>
                <br><br>
                <button type="submit" class="btn btn-success">Submit</button>
                <button id = "closePopUp" type="button" onclick="hidePopup(\'popup-' . $key . '\')" class="btn btn-danger">Cancel</buttonid>
            </form>
        </div>
    </div>';

            echo '
        </div>
    </div>
</div>';
        }
        ?>
        <?php
        if (isset($_SESSION['username'])) {
            echo '
        <div class="tit"> 
            <h3>
                Add your pet here!
            </h3>
            <button class = "butt_border" id="addNew" name="click">Click me</button>
        </div>
        <div id="myPopup" class="popup">
            <div class="popup-content">
                <h4>Insert information about your pet!</h4>
                <div style="border: 1px solid; padding: 5px; border-radius: 10px; text-align: center">
                    <form name="addPet" method="POST" enctype="multipart/form-data" action="upload.php">
                        <label for="file">Picture: </label><br>
                        <input placeholder="Photo" type="file" name="d_pic"><br>
                        <label for="name">Name: </label><br>
                        <input placeholder="Name" type="text" name="d_name"><br>
                        <label for="breed">Breed: </label><br>
                        <input placeholder="Breed" type="text" name="d_breed"><br>
                        <label for="gender">Gender: </label><br>
                        <input placeholder="Gender" type="text" name="d_gender"><br>
                        <label for="age">Age: </label><br>
                        <input placeholder="Age" type="text" name="d_age"><br>
                        <label for="desc" style="text-align: center">About your pet: </label><br>
                        <textarea placeholder="Description" name="d_desc" rows="7"></textarea><br>
                        <input type="submit" name="submit" value="Submit" onclick="refreshPage()">
                        <script>
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, window.location.href);
                            }
                        </script>
                    </form>
                    <button id="closePopup">
                        Close
                    </button>
                </div>
            </div>
        </div>
        <script src="CSS/popupWindow.js"></script>
        ';
        }
        ?>
    </div>
</div>

<script>
    function showPopup(popupId) {
        var popup = document.getElementById(popupId);
        if (popup) {
            popup.classList.add('show');
        }
    }

    function hidePopup(popupId) {
        var popup = document.getElementById(popupId);
        if (popup) {
            popup.classList.remove('show');
        }
    }
</script>
</body>
</html>
