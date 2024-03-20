<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "dogwalkxampp";

$connection = mysqli_connect("$host", "$username", "$password","$db") or die(mysqli_error($connection));
