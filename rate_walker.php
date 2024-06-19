<?php
session_start();
require("db_config.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['u_id']; // User ID from session
    $walkerId = $_POST['walker_id'];
    $rating = $_POST['rating'];

    // Prevent a user from rating themselves
    if ($userId == $walkerId) {
        echo "You cannot rate yourself.";
        exit();
    }

    try {
        $checkRatingSql = "SELECT * FROM ratings WHERE user_id = :user_id AND walker_id = :walker_id";
        $stmt = $pdo->prepare($checkRatingSql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':walker_id', $walkerId, PDO::PARAM_INT);
        $stmt->execute();
        $ratingExists = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($ratingExists) {
            echo "You have already rated this walker.";
        } else {
            $insertRatingSql = "INSERT INTO ratings (user_id, walker_id, rating) VALUES (:user_id, :walker_id, :rating)";
            $stmt = $pdo->prepare($insertRatingSql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':walker_id', $walkerId, PDO::PARAM_INT);
            $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
            $stmt->execute();
            echo "Thank you for your rating!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: walkers.php");
    exit();
}
?>
