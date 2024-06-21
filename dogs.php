<?php
// Include necessary files and establish database connection
require_once 'db_config.php';
require_once 'functions.php';

session_start(); // Start session if not already started

// Function to check if the user is a dog walker
function isDogWalker($username, $pdo) {
    $sql = "SELECT u_id, walk_switch FROM users WHERE u_email = :username AND walk_switch = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Check if the user is a dog walker
$isDogWalker = false;
if (isset($_SESSION['username'])) {
    $walkerData = isDogWalker($_SESSION['username'], $pdo);
    if ($walkerData && isset($walkerData['u_id'])) {
        $isDogWalker = true;
        $walker_id = $walkerData['u_id'];
    }
}

// Fetch dogs information
try {
    $sql = "SELECT d_id, d_pic, d_name, d_breed, d_gender, d_age, d_desc, walk_day, booked_by FROM dogs";
    $stmt = $pdo->query($sql);
    $dogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

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
        <input placeholder="Search" name="search" type="text" value="<?php echo htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : ''); ?>">
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

            } else {
                echo '<p>No walk day selected</p>';
            }

            // Booking button for dog walkers
            if ($isDogWalker) {
                if (!$walkDay || $bookedBy == $walker_id) {
                    echo '
<form method="post" action="dogs.php">
    <input type="hidden" name="dog_id" value="' . $value['d_id'] . '">
    <button type="submit" name="book_walk" class="btn btn-primary">Book Dog Walk</button>
</form>';
                } else {
                    echo '<p>This dog has already been booked by another walker.</p>';
                }
            }

            echo '
        </div>
    </div>
</div>';
        }
        ?>
    </div>
</div>

<?php
// Handle form submission to book a dog walk
if (isset($_POST['book_walk'])) {
    $dog_id = $_POST['dog_id'];

    try {
        // Update activity_column for the walker
        $stmt = $pdo->prepare('UPDATE users SET activity_column = activity_column + 1 WHERE u_id = :walker_id');
        $stmt->bindParam(':walker_id', $walker_id, PDO::PARAM_INT);
        $stmt->execute();

        // Optionally, you can redirect or display a success message
        // Example redirect:
        // header('Location: dogs.php?success=1');
        // exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error updating activity: " . $e->getMessage();
    }
}
?>

<script>
    // Function to show popup
    function showPopup(popupId) {
        var popup = document.getElementById(popupId);
        if (popup) {
            popup.classList.add('show');
        }
    }

    // Function to hide popup
    function hidePopup(popupId) {
        var popup = document.getElementById(popupId);
        if (popup) {
            popup.classList.remove('show');
        }
    }
</script>
</body>
</html>
