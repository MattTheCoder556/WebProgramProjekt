<?php
require 'db_config.php';
require 'functions.php';

if ($_FILES['u_pic']["error"] > 0) {
    echo "Something went wrong during file upload!";
} else {
    if (is_uploaded_file($_FILES['u_pic']['tmp_name'])) {

        $file_name = $_FILES['u_pic']["name"];
        $file_temp = $_FILES["u_pic"]["tmp_name"];
        $file_error = $_FILES['u_pic']["error"];

        $ext_temp = explode(".", $file_name);
        $extension = end($ext_temp);

        $directory = "ProfPic";

        $upload = "$directory/$file_name";

        if (!file_exists($upload)) {
            if (move_uploaded_file($file_temp, $upload)) {

                $sql = "INSERT INTO user (u_pic) VALUES (?)";
                $query = $pdo->prepare($sql);
                $query->bindParam(1, $file_name, PDO::PARAM_STR);

                $query->execute();
                header("Location: user.php");
                exit();
            } else {
                echo "<p><b>Error!</b></p>";
            }
        }
    }
}