<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "db_config.php";
require_once "functions.php";

if (isset($_GET['token'])) {
    $token = trim($_GET['token']);
}

if (!empty($token) and strlen($token) === 40) {

    $sql = "UPDATE users SET active = 1, registration_expires = NOW() WHERE registration_token = :token";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->execute();


    if ($stmt->rowCount() > 0) {
        redirection('index.php?r=6');
    } else {
        redirection('index.php?r=12');
    }
} else {
    redirection('index.php?r=0');
}