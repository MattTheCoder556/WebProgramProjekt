<?php
require_once 'db_config.php';
require 'functions.php';

function printr ($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}



// Operations -> Add new, Update, Delete
if (isset($_POST['operation'])) {
    if (isset($_POST['submit'])) {
        $exceptions = array('submit','operation');
        foreach ($_POST as $key => $value) {
            if (!in_array($key, $exceptions)) {
                $sql_array[] = "`{$key}` = ?";
                $values[] = $value;
            }
        }
    }
    $operation = $_POST['operation'];
    switch (key($operation)) {
        case 'add_new':
            if (isset($_POST['submit'])) {
                $sql = "INSERT INTO users SET ";
                $sql .= implode(', ', $sql_array);
                $stmt = $pdo->prepare($sql);
                $stmt->execute($values);
            }
            else {
                $add_new = true;
            }
            break;
        case 'update':
            if (isset($_POST['submit'])) {
                $sql = "UPDATE users SET ";
                $sql .= implode(', ', $sql_array);
                $sql .= " WHERE u_id = ?";
                $values[] = $operation['update'];
                $stmt = $pdo->prepare($sql);
                $stmt->execute($values);
            }
            else {
                $sql = "SELECT u_id, u_fname, u_lname, u_email, u_pass, u_phone, u_address, walk_switch FROM users WHERE u_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$operation['update']]);
                $update = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            break;
        case 'delete':
            $sql = "DELETE FROM users WHERE u_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$operation['delete']]);
            break;
    }
    // Send sql to server
    if (isset($_POST['submit']) || key($operation) == 'delete') {
        echo "The process ended successfully";
    }
}

// POST data from database
$sql = "SELECT u_id, u_fname, u_lname, u_email, u_pass, u_phone, u_address, walk_switch FROM users";
$stmt = $pdo->query($sql);
$u = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="main-cover main-cover-admin">
    <a href="index.php">Back to Home</a>
    <div class="page-wrapper">
        <div class="block-title block-title--white">Admin</div>
    </div>
</section>

<section class="block">
    <div class="page-wrapper">
        <form method="POST">
            <table class="admin__table">
                <tr class="first">
                    <td>User ID</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Email</td>
                    <td>Password</td>
                    <td>Phone Number</td>
                    <td>Address</td>
                    <td>Walker?</td>
                    <td colspan="2">Operations</td>
                </tr>
                <?php
                include "adminCS.php";
                if($value['walk_switch'] == 0){
                    $ws = "YES";
                }
                else{
                    $ws = "NO";
                }
                foreach ($u as $key => $value) {
                    echo '<tr>
                                    <td>' . $value['u_id'] . '</td>
                                    <td>' . $value['u_fname'] . '</td>
                                    <td>' . $value['u_lname'] . '</td>
                                    <td>' . $value['u_email'] . '</td>
                                    <td>' . $value['u_pass'] . '</td>
                                    <td>' . $value['u_phone'] . '</td>
                                    <td>' . $value['u_address'] . '</td>
                                    <td>' . $ws . '</td>
                                    <td><button class="admin__table-button" type="submit" name="operation[update]" value="' . $value['u_id'] . '">Update</button></td>
                                    <td><button class="admin__table-button" type="submit" name="operation[delete]" value="' . $value['u_id'] . '">Delete</button></td>
                                </tr>';
                }
                ?>
            </table>
            <button class="admin__table-new" type="submit" name="operation[add_new]" value="true">Add new</button>
        </form>
    </div>
</section>

<?php if (isset($update) || isset($add_new)) { ?>
    <section class="block">
        <div class="page-wrapper">
            <h1>Enter the data</h1>
            <form class="admin__update" method="POST">
                <input type="hidden" name="operation[<?php echo key($operation) ?>]" value="<?php echo $operation[key($operation)] ?>">
                <div class="update__item"><input placeholder="Fname" type="text" name='u_fname' value="<?php if(isset($update)){echo $update['u_fname'];} ?>"></div>
                <div class="update__item"><input placeholder="Lame" type="text" name='u_lname' value="<?php if(isset($update)) {echo $update['u_lname'];} ?>"></div>
                <div class="update__item"><input placeholder="Email" type="text" name='u_email' value="<?php if(isset($update)){echo $update['u_email'];} ?>"></div>
                <div class="update__item"><input placeholder="Password" type="text" name='u_pass' value="<?php if(isset($update)){echo $update['u_pass'];} ?>"></div>
                <div class="update__item"><input placeholder="PhoneNum" type="text" name='u_phone' value="<?php if(isset($update)){echo $update['u_phone'];} ?>"></div>
                <div class="update__item"><input placeholder="Address" type="text" name='u_address' value="<?php if(isset($update)){echo $update['u_address'];} ?>"></div>
                <div class="update__item"><label for = "walk">Walker?</label><input placeholder="WalkSwitch" type="checkbox" id = "walk" name='walk_switch' value="<?php if(isset($update)){echo $update['walk_switch'];} ?>"></div>
                <button class="admin__table-new" type="submit" name="submit" value="true">Send</button>
            </form>
        </div>
    </section>
<?php } ?>
