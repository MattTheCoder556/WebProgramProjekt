<?php
session_start();
require_once "db_config.php";
require_once "functions.php";

$password = "";
$passwordConfirm = "";
$firstname = "";
$lastname = "";
$email = "";
$phoneNum = "";
$address = "";
$wSwitch = "";
$action = "";

$referer = $_SERVER['HTTP_REFERER'];
//var_dump($referer);
//var_dump(SITE);

//var_dump($referer);
//exit();

$action = $_POST["action"];

//isset($action) and in_array($action, $actions) and
if (isset($action) and in_array($action, $actions) and str_contains($referer, SITE)) {
    //var_dump($_POST['firstname']);
    //exit();


    switch ($action) {
        case "login":

            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);

            if (!empty($username) and !empty($password)) {
                //$data = checkUserLogin($pdo, $username, $password);
                $data = checkUserLogin($username, $password);

                if ($data and is_int($data['u_id'])) {
                    $_SESSION['username'] = $username;
                    $_SESSION['u_id'] = $data['u_id'];
                    redirection('user.php');
                } else {
                    redirection('login.php?l=1');
                }

            } else {
                redirection('login.php?l=1');
            }
            break;


        case "register" :

            if (isset($_POST['firstname'])) {
                $firstname = trim($_POST["firstname"]);
            }

            if (isset($_POST['lastname'])) {
                $lastname = trim($_POST["lastname"]);
            }

            if (isset($_POST['email'])) {
                $email = trim($_POST["email"]);
            }

            if (isset($_POST['passw'])) {
                $password = trim($_POST["passw"]);
            }

            if (isset($_POST['passwConfirm'])) {
                $passwordConfirm = trim($_POST["passwConfirm"]);
            }

            if (isset($_POST['phone'])) {
                $phoneNum = trim($_POST["phone"]);
            }

            if (isset($_POST['dogw'])) {
                $wSwitch = trim($_POST["dogw"]);
            }

            if (isset($_POST['address'])) {
                $address = trim($_POST["address"]);
            }

            if (empty($firstname)) {
                redirection('register.php?r=4');
            }

            if (empty($lastname)) {
                redirection('register.php?r=4');
            }

            if (empty($password)) {
                redirection('register.php?r=9');
            }

            if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
                redirection('register.php?r=10');
            }

            if (empty($passwordConfirm)) {
                redirection('register.php?r=9');
            }

            if ($password !== $passwordConfirm) {
                redirection('register.php?r=7');
            }

            if (empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                redirection('register.php?r=8');
            }

            if (empty($phoneNum)) {
                redirection('register.php?r=4');
            }

            if (empty($address)) {
                redirection('register.php?r=4');
            }

            if (!existsUser($pdo, $email)) {
                $token = createToken(20);
                if ($token) {
                    $id_user = registerUser($pdo, $password, $firstname, $lastname, $email, $address, $phoneNum, $wSwitch,$token);
                    try {
                        $body = "Your username is $email. To activate your account click on the <a href=" . SITE . "active.php?token=$token>link</a>";
                        sendEmail($pdo, $email, $emailMessages['register'], $body, $id_user);
                        redirection("register.php?r=3");
                    } catch (Exception $e) {
                        error_log("****************************************");
                        error_log($e->getMessage());
                        error_log("file:" . $e->getFile() . " line:" . $e->getLine());
                        redirection("register.php?r=11");
                    }
                }
            } else {
                redirection('register.php?r=2');
            }

            break;

        /*case "forget" :
            $email = trim($_POST["email"]);
            if (!empty($email) and getUserData($pdo, 'id_user', 'email', $email)) {
                $token = createToken(20);
                if ($token) {
                    setForgottenToken($pdo, $email, $token);
                    $id_user = getUserData($pdo, 'id_user', 'email', $email);
                    try {
                        $body = "To start the process of changing password, visit <a href=" . SITE . "forget.php?token=$token>link</a>.";
                        sendEmail($pdo, $email, $emailMessages['forget'], $body, $id_user);
                        redirection('index.php?f=13');
                    } catch (Exception $e) {
                        error_log("****************************************");
                        error_log($e->getMessage());
                        error_log("file:" . $e->getFile() . " line:" . $e->getLine());
                        redirection("index.php?f=11");
                    }
                } else {
                    redirection('index.php?f=14');
                }
            } else {
                redirection('index.php?f=13');
            }
            break;*/

        default:
            redirection('register.php?r=0');
            break;
    }

} else {
    redirection('register.php?r=0');

}

