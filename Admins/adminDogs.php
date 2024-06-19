<?php
require_once '../db_config.php';
require '../functions.php';
include "adminCS.php";
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
                $sql = "INSERT INTO dogs SET ";
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
                $sql = "UPDATE dogs SET ";
                $sql .= implode(', ', $sql_array);
                $sql .= " WHERE d_id = ?";
                $values[] = $operation['update'];
                $stmt = $pdo->prepare($sql);
                $stmt->execute($values);
            }
            else {
                $sql = "SELECT d_id, d_pic, d_name, d_breed, d_gender, d_age, d_desc, walk_day  FROM dogs WHERE d_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$operation['update']]);
                $update = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            break;
        case 'delete':
            $sql = "DELETE FROM dogs WHERE d_id = ?";
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
$sql = "SELECT d_id, d_pic, d_name, d_breed, d_gender, d_age, d_desc, walk_day  FROM dogs";
$stmt = $pdo->query($sql);
$dogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="main-cover main-cover-admin">
    <a href="../admins.php">Back to Menu</a>
    <div class="page-wrapper">
        <div class="block-title block-title--white">Admin</div>
    </div>
</section>

<section class="block">
    <div class="page-wrapper">
        <form method="POST">
            <table class="admin__table">
                <tr class="first">
                    <td>Dog ID</td>
                    <td>Photo</td>
                    <td>Name</td>
                    <td>Breed</td>
                    <td>Gender</td>
                    <td>Age</td>
                    <td>About your pet</td>
                    <td>Walk Day</td>
                    <td colspan="2">Operations</td>
                </tr>
                <?php
                include "adminCS.php";
                foreach ($dogs as $key => $value) {
                    echo '<tr>
                                    <td>' . $value['d_id'] . '</td>
                                    <td><img width="80px" height="80px" src ="Images/' . $value['d_pic'] . '"></td>
                                    <td>' . $value['d_name'] . '</td>
                                    <td>' . $value['d_breed'] . '</td>
                                    <td>' . $value['d_gender'] . '</td>
                                    <td>' . $value['d_age'] . '</td>
                                    <td>' . $value['d_desc'] . '</td>
                                    <td>' . $value['walk_day'] . '</td>
                                    <td><button class="admin__table-button" type="submit" name="operation[update]" value="' . $value['d_id'] . '">Update</button></td>
                                    <td><button class="admin__table-button" type="submit" name="operation[delete]" value="' . $value['d_id'] . '">Delete</button></td>
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
            <form class="admin__update" action = "../uploadUser.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="operation[<?php echo key($operation) ?>]" value="<?php echo $operation[key($operation)] ?>">
                <div class="update__item"><input placeholder="Photo" type="file" name='d_pic' value="<?php if(isset($update)){echo $update['d_pic'];} ?>"></div>
                <div class="update__item"><input placeholder="Name" type="text" name='d_name' value="<?php if(isset($update)) {echo $update['d_name'];} ?>"></div>
                <div class="update__item"><input placeholder="Breed" type="text" name='d_breed' value="<?php if(isset($update)){echo $update['d_breed'];} ?>"></div>
                <div class="update__item"><input placeholder="Gender" type="text" name='d_gender' value="<?php if(isset($update)){echo $update['d_gender'];} ?>"></div>
                <div class="update__item"><input placeholder="Age" type="text" name='d_age' value="<?php if(isset($update)){echo $update['d_age'];} ?>"></div>
                <textarea class = update__item placeholder="Description" name = 'd_desc'><?php if(isset($update)){echo $update['d_desc'];} ?></textarea>
                <div class="update__item"><input placeholder="WalkDay" type="text" name='walk_day' value="<?php if(isset($update)){echo $update['walk_day'];} ?>"></div>
                <input type = "submit" class="admin__table-new" type="submit" name="submit" value="true">Send</input>
            </form>
        </div>
    </section>
<?php } ?>
<p>Click <a href="../logout.php">here</a> to Logout!</p>

