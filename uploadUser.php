<?php
require 'db_config.php';
require 'functions.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}



$user_id = $_SESSION['u_id'];
echo 'error';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateProfile'])) {
    // Handle Profile Picture Upload
    if (isset($_FILES['imgUp']) && $_FILES['imgUp']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['imgUp']['name'];
        $file_temp = $_FILES['imgUp']['tmp_name'];
        $file_error = $_FILES['imgUp']['error'];

        $ext_temp = explode(".", $file_name);
        $extension = end($ext_temp);

        $directory = "ProfPic";

        $upload = "$directory/$file_name";

        if (move_uploaded_file($file_temp, $upload)) {
            // Update profile picture in the database
            $sql = "UPDATE users SET u_pic = ? WHERE u_id = ?";
            $query = $pdo->prepare($sql);
            $query->execute([$file_name, $user_id]);

            $_SESSION['profPic'] = $upload; // Update session variable with new profile picture path
        } else {
            echo "<p><b>Error uploading profile picture!</b></p>";
        }
    }

    // Handle Profile Information Update
    $firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : $_SESSION['firstname'];
    $lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : $_SESSION['lastname'];
    $email = !empty($_POST['email']) ? $_POST['email'] : $_SESSION['email'];
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : $_SESSION['phone'];
    $address = !empty($_POST['address']) ? $_POST['address'] : $_SESSION['address'];

    // Update only if there are changes
    if ($firstname !== $_SESSION['firstname'] || $lastname !== $_SESSION['lastname'] || $email !== $_SESSION['email'] || $phone !== $_SESSION['phone'] || $address !== $_SESSION['address']) {
        $sql = "UPDATE users SET u_fname = ?, u_lname = ?, u_email = ?, u_phone = ?, u_address = ? WHERE u_id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$firstname, $lastname, $email, $phone, $address, $user_id]);

        // Update session variables with new data
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['address'] = $address;
    }

    // Redirect back to profile page
    header("Location: user.php");
    exit();
}
?>
