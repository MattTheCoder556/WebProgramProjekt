<?php
require 'db_config.php';
require 'functions.php';

if ($_FILES['d_pic']["error"] > 0) {
    echo "Something went wrong during file upload!";
} else {
    if (is_uploaded_file($_FILES['d_pic']['tmp_name'])) {

        $file_name = $_FILES['d_pic']["name"];
        $file_temp = $_FILES["d_pic"]["tmp_name"];
        $file_error = $_FILES['d_pic']["error"];

        $ext_temp = explode(".", $file_name);
        $extension = end($ext_temp);

        $directory = "Images";

        $upload = "$directory/$file_name";

        if (!file_exists($upload)) {
            if (move_uploaded_file($file_temp, $upload)) {
                $name = $_POST['d_name'];
                $breed = $_POST['d_breed'];
                $gender = $_POST['d_gender'];
                $age = $_POST['d_age'];
                $desc = $_POST['d_desc'];

                $sql = "INSERT INTO dogs (d_pic, d_name, d_breed, d_gender, d_age, d_desc) VALUES (?, ?, ?, ?, ?, ?)";
                $query = $pdo->prepare($sql);
                $query->bindParam(1, $file_name, PDO::PARAM_STR);
                $query->bindParam(2, $name, PDO::PARAM_STR);
                $query->bindParam(3, $breed, PDO::PARAM_STR);
                $query->bindParam(4, $gender, PDO::PARAM_STR);
                $query->bindParam(5, $age, PDO::PARAM_INT);
                $query->bindParam(6, $desc, PDO::PARAM_STR);

                $query->execute();
                header("Location: dogs.php");
                exit();
            } else {
                echo "<p><b>Error!</b></p>";
            }
        }
    }
}