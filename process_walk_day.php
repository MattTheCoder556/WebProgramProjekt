<?php
require_once 'db_config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dog_id = $_POST['dog_id'];
    $walk_day = $_POST['walk_day'];
    $walker_id = $_SESSION['u_id'];

    try {
        $checkSql = "SELECT booked_by FROM dogs WHERE d_id = :dog_id";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->bindParam(':dog_id', $dog_id, PDO::PARAM_INT);
        $checkStmt->execute();
        $existingBooking = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if (!$existingBooking['booked_by']) {
            $updateSql = "UPDATE dogs SET walk_day = :walk_day, booked_by = :walker_id WHERE d_id = :dog_id";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->bindParam(':walk_day', $walk_day, PDO::PARAM_STR);
            $updateStmt->bindParam(':walker_id', $walker_id, PDO::PARAM_INT);
            $updateStmt->bindParam(':dog_id', $dog_id, PDO::PARAM_INT);
            $updateStmt->execute();

        }

        echo "<script>alert('Booking confirmed!'); window.location.href = 'dogs.php';</script>";
    } catch (PDOException $e) {
        echo "Error updating booking: " . $e->getMessage();
    }
} else {
    header("Location: dogs.php");
    exit();
}
?>
