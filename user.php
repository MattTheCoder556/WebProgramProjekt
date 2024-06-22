<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/dogsCSS.css">
    <title>User</title>
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
            session_start();

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
    <div class="container mt-4">
        <div class="square">
            <div class="d-flex flex-column align-items-center">
                <div class="img mb-3">
                    <?php
                    if (isset($_SESSION['profPic'])) {
                        $profPic = $_SESSION['profPic'];
                        echo '<img src="' . $profPic . '" class="profile-pic">';
                    }
                    ?>
                </div>
                <div class="text-center lighterSQ">
                    <p>Name: <br><?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : ''; echo ' '; echo isset($_SESSION['lastname']) ? $_SESSION['lastname'] : ''; ?></p>
                    <p>E-Mail: <br><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></p>
                    <p>Phone Number: <br><?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : ''; ?></p>
                    <p>Address: <br><?php echo isset($_SESSION['address']) ? $_SESSION['address'] : ''; ?></p>
                    <p>Click <a href="updateUser.php">here</a> to update your Profile!</p>
                    <p>Click <a href="logout.php">here</a> to Logout!</p>
                </div>
            </div>
        </div>
       
    </div>
</div>
</body>
</html>
