<?php
session_start();
require_once 'db_config.php';
require_once 'functions.php';


if($_SESSION['u_pic'] != null && $_SESSION['u_pic'] != 'unregistered.jpg') {
    $old_name = "ProfPic/" . $_SESSION['username'] . ".jpg";
    if(file_exists($old_name))
        unlink($old_name);
    else
        error_log("Couldn't find the picture".$old_name);
}
if ($_FILES['file']["error"] > 0) {
    echo "Something went wrong during file upload!";
} else {
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        $file_name = $_FILES['file']["name"];
        $file_temp = $_FILES["file"]["tmp_name"];
        $file_size = $_FILES["file"]["size"];
        $file_type = $_FILES["file"]["type"];
        $file_error = $_FILES['file']["error"];
        $full_path = $_FILES['file']["full_path"];

        if (!exif_imagetype($file_temp))
            exit("File is not a picture!");

        $new_file_name = $_SESSION['username']. ".jpg";
        $directory = "ProfPic";

        $upload = "$directory/$new_file_name";

        if (move_uploaded_file($file_temp, $upload)) {
            $email = $_SESSION['email'];
            upload_profile_pic($file_name, $email);
            $_SESSION['u_pic'] = $file_name;
            redirection('profile.php');
        } else
            var_dump($file_temp);
            echo "<br>";
            var_dump($upload);
            echo "<p><b>Problem while uploading picture!</b></p>";
        }
    }
