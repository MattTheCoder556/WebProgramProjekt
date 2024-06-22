<?php
ob_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



require_once "db_config.php";

/**
 * Function redirects user to given URL
 *
 * @param string $url
 */
function redirection($url) {
    header("Location:$url");
    exit();
}

/**
 * Function checks that login parameters exist in users table
 *
 * @param string $email
 * @param string $enteredPassword
 * @return array
 */
function checkUserLogin(string $email, string $enteredPassword): array {
    global $pdo;

    $sql = "SELECT u_id, u_pic AS profPic, u_pass, u_fname AS firstname, u_lname AS lastname, u_email AS email, u_phone AS phone, u_address AS address FROM users WHERE u_email=:email AND active = 1 AND is_banned = 0 LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $data = [];
    if ($stmt->rowCount() > 0) {
        $registeredPassword = $result['u_pass'];
        if (password_verify($enteredPassword, $registeredPassword)) {
            $data['u_id'] = $result['u_id'];
            $data['firstname'] = $result['firstname'];
            $data['lastname'] = $result['lastname'];
            $data['email'] = $result['email'];
            $data['phone'] = $result['phone'];
            $data['address'] = $result['address'];
            $data['profPic'] = $result['profPic'];
        }
    }

    return $data;
}


/**
 * Function checks that email exists in users table
 * @param PDO $pdo
 * @param string $email
 * @return bool
 */
function existsUser(PDO $pdo, string $email): bool {
    $sql = "SELECT COUNT(*) FROM users WHERE u_email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchColumn() > 0;
}

/**
 * Function registers user and returns ID of created user
 * @param PDO $pdo
 * @param string $password
 * @param string $firstname
 * @param string $lastname
 * @param string $email
 * @param string $address
 * @param string $token
 * @param string $phoneNum
 * @param bool $wSwitch
 * @return int
 */
function registerUser   (PDO $pdo, string $password, string $firstname, string $lastname, string $email, string $address, string $token, string $phoneNum, bool $wSwitch): int {
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    $forgotten_password_token = '';
    $forgotten_password_expires = date('Y-m-d H:i:s', strtotime('+1 day'));
        $is_banned = 0;
        $u_rating = 0;
        $activity_column = 0;




    $sql = "INSERT INTO users (u_fname, u_lname, u_email, u_pass, u_phone, u_address, walk_switch, registration_token, registration_expires, active, forgotten_password_token, forgotten_password_expires, is_banned, u_rating, activity_column)
            VALUES (:firstname, :lastname, :email, :passwordHashed, :phone, :address, :switch, :token, DATE_ADD(now(), INTERVAL 1 DAY), 0, :forgotten_password_token, :forgotten_password_expires, :is_banned, :u_rating, :activity_column)";
    $stmt = $pdo->prepare($sql);
   // $stmt->bindParam(':profPic', $profilePic, PDO::PARAM_STR);
    $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':passwordHashed', $passwordHashed, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phoneNum, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindValue(':switch', $wSwitch, PDO::PARAM_INT);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->bindParam(':forgotten_password_token', $forgotten_password_token, PDO::PARAM_STR);
        $stmt->bindParam(':forgotten_password_expires', $forgotten_password_expires, PDO::PARAM_STR);
        $stmt->bindParam(':is_banned', $is_banned, PDO::PARAM_INT);
        $stmt->bindParam(':u_rating', $u_rating, PDO::PARAM_INT);
        $stmt->bindParam(':activity_column', $activity_column, PDO::PARAM_INT); 






    $stmt->execute();

    return $pdo->lastInsertId();
}


/**
 * Function creates random token for given length in bytes
 * @param int $length
 * @return string|null
 */
function createToken(int $length): ?string {
    try {
        return bin2hex(random_bytes($length));
    } catch (\Exception $e) {
        error_log("****************************************");
        error_log($e->getMessage());
        error_log("file:" . $e->getFile() . " line:" . $e->getLine());
        return null;
    }
}

/**
 * Function creates code with given length and returns it
 *
 * @param $length
 * @return string
 */
function createCode($length): string {
    $down = 97;
    $up = 122;
    $i = 0;
    $code = "";

    $div = mt_rand(3, 9);

    while ($i < $length) {
        if ($i % $div == 0)
            $character = strtoupper(chr(mt_rand($down, $up)));
        else
            $character = chr(mt_rand($down, $up));
        $code .= $character;
        $i++;
    }
    return $code;
}

/**
 * Function tries to send email with activation code
 * @param PDO $pdo
 * @param string $email
 * @param array $emailData
 * @param string $body
 * @param int $id_user
 * @return void
 */
function sendEmail(PDO $pdo, string $email, array $emailData, string $body, int $id_user): void {

    if(!isset($email, $title, $message, $radio)){

        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'mail.duke.stud.vts.su.ac.rs';
            $mail->SMTPAuth = true;
            $mail->Username = 'duke';
            $mail->Password = 'c826FtxhnVDUmK3';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;


            //Recipients
            $mail->setFrom('duke@duke.stud.vts.su.ac.rs', 'The Duke');
            $mail->addAddress($email, 'User');
            //$mail->addAddress('ellen@example.com');
            //$mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');


            $mail->isHTML(true);
            $mail->Subject = "Register";
            $mail->Body = $body;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

/**
 * Function inserts data in database for e-mail sending failure
 * @param PDO $pdo
 * @param int $id_user
 * @param string $message
 * @return void
 */
function addEmailFailure(PDO $pdo, int $id_user, string $message): void {
    $sql = "INSERT INTO user_email_failures (id_user, message, date_time_added)
            VALUES (:id_user, :message, now())";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);
    $stmt->execute();
}

/**
 * Function returns user data for given field and given value
 * @param PDO $pdo
 * @param string $data
 * @param string $field
 * @param mixed $value
 * @return mixed
 */
function getUserData(PDO $pdo, string $data, string $field, string $value): string {
    $sql = "SELECT $data as data FROM users WHERE $field = :value LIMIT 0,1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':value', $value, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $data = '';

    if ($stmt->rowCount() > 0) {
        $data = $result['data'];
    }

    return $data;
}

/**
 * Function sets the forgotten token
 * @param PDO $pdo
 * @param string $email
 * @param string $token
 * @return void
 */
function setForgottenToken(PDO $pdo, string $email, string $token): void {
    $sql = "UPDATE users SET forgotten_password_token = :token, forgotten_password_expires = DATE_ADD(now(), INTERVAL 6 HOUR) WHERE u_email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
}

function upload_profile_pic($name, $email)
{
    global $conn;
    $sql = "UPDATE users SET profile_pic =:name  WHERE email=:email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
}
?>
