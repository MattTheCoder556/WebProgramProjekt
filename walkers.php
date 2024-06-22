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
    <title>Our Walkers</title>
</head>
<body>
<?php
require("db_config.php");
session_start();

$search = isset($_GET['search']) ? $_GET['search'] : '';

try {
    $sql = "SELECT u_id, u_pic, u_fname, u_lname, u_phone, u_email FROM users WHERE walk_switch != 0";
    if (!empty($search)) {
        $sql .= " AND (u_fname LIKE :search OR u_lname LIKE :search OR u_email LIKE :search OR u_phone LIKE :search)";
    }
    $stmt = $pdo->prepare($sql);
    if (!empty($search)) {
        $searchParam = '%' . $search . '%';
        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
    }
    $stmt->execute();
    $walkers = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            } else {
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
<div class="cards mt-4">
    <form class="product-search mb-4" method="get" action="walkers.php">
        <input class="form-control" placeholder="Search users" name="search" type="text" value="<?php echo htmlspecialchars($search); ?>">
        <button class="btn btn-primary mt-2" type="submit">Go</button>
    </form>
    <div class="row">
        <?php
        if (!empty($walkers)) {
            foreach ($walkers as $walker) {
                $profilePicPath = 'ProfPic/' . $walker['u_pic'];

                echo '
        <div class="col-lg-3 col-sm-6">
                    <div class="card mb-4">
                        <img src="'.$profilePicPath.'" class="card-img-top" alt="Profile Picture">
                        <div class="card-body">
                            <h5 class="card-title">'.$walker['u_fname'].' '.$walker['u_lname'].'</h5>
                            <p class="card-text">'.$walker['u_phone'].'<br>'.$walker['u_email'].'</p>';

                if(isset($_SESSION['username'])) {
                    $userId = $_SESSION['u_id'];
                    $walkerId = $walker['u_id'];

                    if ($userId == $walkerId) {
                        echo '<p>You cannot rate yourself.</p>';
                    } else {
                        $checkRatingSql = "SELECT * FROM ratings WHERE user_id = :user_id AND walker_id = :walker_id";
                        $stmt = $pdo->prepare($checkRatingSql);
                        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
                        $stmt->bindParam(':walker_id', $walkerId, PDO::PARAM_INT);
                        $stmt->execute();
                        $ratingExists = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($ratingExists) {
                            echo '<p>Thank you for rating!</p>';
                        } else {
                            echo '
                        <form method="post" action="rate_walker.php">
                            <input type="hidden" name="walker_id" value="'.$walkerId.'">
                            <label for="rating">Rate this walker:</label>
                            <select name="rating" id="rating" class="form-select">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                        </form>';
                        }
                    }
                }

                echo '
                </div>
            </div>
        </div>';
            }
        } else {
            echo '<p class="dogerror">No walkers found!</p>';
        }
        ?>
    </div>
</div>
</body>
</html>
