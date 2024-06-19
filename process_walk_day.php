<?php
// process_walk_day.php

require("db_config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dogId = $_POST['dog_id'];
    $walkDay = $_POST['walk_day'];
    $walkerId = $_SESSION['u_id'];

    // Check if the dog is already booked
    $sqlCheckBooking = "SELECT booked_by FROM dogs WHERE d_id = :dog_id";
    $stmtCheckBooking = $pdo->prepare($sqlCheckBooking);
    $stmtCheckBooking->bindParam(':dog_id', $dogId, PDO::PARAM_INT);
    $stmtCheckBooking->execute();
    $currentBooking = $stmtCheckBooking->fetch(PDO::FETCH_ASSOC);

    if ($currentBooking && $currentBooking['booked_by'] !== null) {
        // Dog is already booked
        echo "This dog has already been booked by another walker.";
        exit();
    }

    // Update the database with the new walk_day and walker
    try {
        $pdo->beginTransaction();

        // Update dogs table
        $sqlUpdate = "UPDATE dogs SET walk_day = :walk_day, booked_by = :walker_id WHERE d_id = :dog_id";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':walk_day', $walkDay, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':walker_id', $walkerId, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':dog_id', $dogId, PDO::PARAM_INT);
        $stmtUpdate->execute();

        $pdo->commit();

        // Redirect back to dogs.php or show success message
        header("Location: dogs.php");
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Error updating walk day: " . $e->getMessage();
    }
}
?>
