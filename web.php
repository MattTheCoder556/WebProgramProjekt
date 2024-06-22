<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require  "db_config.php";
require "functions.php";

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



$action = $_POST["action"];

if ($action != "" and in_array($action, $actions) and strpos($referer, SITE) !== false) {


    switch ($action) {
        case "login":
            $username = trim($_POST["username"]);
            $password = trim($_POST["passw"]);

            if ($username == "admin" && $password == "admin") {
                redirection("admins.php");
            }

            if (!empty($username) && !empty($password)) {
                $data = checkUserLogin($username, $password);

                if (!empty($data)) {
                    $_SESSION['u_id'] = $data['u_id'];
                    $_SESSION['firstname'] = $data['firstname'];
                    $_SESSION['lastname'] = $data['lastname'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['phone'] = $data['phone'];
                    $_SESSION['address'] = $data['address'];
                    $_SESSION['profPic'] = $data['profPic'];
                    $_SESSION['dogw'] = $data['dogw'];
                    $_SESSION['username'] = $username;
                    redirection('user.php');
                } else {
                    redirection('login.php?l=1');
                }
            } else {
                redirection('login.php?l=4');
            }
            break;


        case "register":

            //$profPic = trim($_POST['profilePic']);
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
            $email = trim($_POST['email']);
            $password = trim($_POST['passw']);
            $passwordConfirm = trim($_POST['passwConfirm']);
            $phoneNum = trim($_POST['phone']);
            $wSwitch = isset($_POST['dogw']) ? trim($_POST['dogw']) : 0;
            $address = trim($_POST['address']);

            if (empty($firstname) || empty($lastname) || empty($password) || empty($passwordConfirm) || empty($email) || empty($phoneNum) || empty($address)) {
                redirection('register.php?r=4');
            }

            if ($password !== $passwordConfirm) {
                redirection('register.php?r=7');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                redirection('register.php?r=8');
            }

            if (!existsUser($pdo, $email)) {
                $token = createToken(20);
                if ($token) {
                    $id_user = registerUser($pdo, $password, $firstname, $lastname, $email, $address, $token, $phoneNum, $wSwitch);

                    try {
                        $body = "Your username is $email. To activate your account click on the <a href=\"" . SITE . "active.php?token=$token\">link</a>";
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


            if (isset($_POST['firstname'])) {
                $firstname = trim($_POST["firstname"]);
                $_SESSION['firstname'] = $firstname;
            }

            if (isset($_POST['lastname'])) {
                $lastname = trim($_POST["lastname"]);
                $_SESSION['lastname'] = $lastname;
            }

            if (isset($_POST['email'])) {
                $email = trim($_POST["email"]);
                $_SESSION['email'] = $email;
            }

            if (isset($_POST['passw'])) {
                $password = trim($_POST["passw"]);
            }

            if (isset($_POST['passwConfirm'])) {
                $passwordConfirm = trim($_POST["passwConfirm"]);
            }

            if (isset($_POST['phone'])) {
                $phoneNum = trim($_POST["phone"]);
                $_SESSION['phone'] = $phoneNum;
            }

            if (isset($_POST['dogw'])) {
                $wSwitch = trim($_POST["dogw"]);
                $_SESSION['dogw'] = $wSwitch;
            }

            if (isset($_POST['address'])) {
                $address = trim($_POST["address"]);
                $_SESSION['address'] = $address;
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

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
                    $id_user = registerUser($pdo, $password, $firstname, $lastname, $email, $address, $token, $phoneNum, $wSwitch);

                    try {
                        $body = "Your username is $email. To activate your account click on the <a href=\"" . SITE . "active.php?token=$token\">link</a>";
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

        case "forget" :
            $email = trim($_POST["email"]);
            if (!empty($email) and getUserData($pdo, 'u_id', 'u_email', $email)) {
                $token = createToken(20);
                if ($token) {
                    setForgottenToken($pdo, $email, $token);
                    $id_user = getUserData($pdo, 'u_id', 'u_email', $email);
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
            break;

        default:
            redirection('index.php?l=0');
            break;
    }

} else {
    redirection('index.php?l=0');
}
?>

	