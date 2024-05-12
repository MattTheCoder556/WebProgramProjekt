<?php
require_once 'db_config.php';

function printr ($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

try {
    $dsn = "mysql:host=localhost;dbname=dogwalkxampp";
    $username = "root";
    $password = "";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
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
                $sql .= " WHERE dogs_id = ?";
                $values[] = $operation['update'];
                $stmt = $pdo->prepare($sql);
                $stmt->execute($values);
            }
            else {
                $sql = "SELECT dogs_id, dog_pic, dog_name, dog_breed, dog_age, dog_bday, dog_gender FROM dogs WHERE dogs_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$operation['update']]);
                $update = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            break;
        case 'delete':
            $sql = "DELETE FROM dogs WHERE dogs_id = ?";
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
$sql = "SELECT dogs_id, dog_pic, dog_name, dog_breed, dog_age, dog_bday, dog_gender FROM dogs";
$stmt = $pdo->query($sql);
$dogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                    <td>Dog ID</td>
                    <td>Photo</td>
                    <td>Name</td>
                    <td>Breed</td>
                    <td>Age</td>
                    <td>Birthday</td>
                    <td>Gender</td>
                    <td colspan="2">Operations</td>
                </tr>
                <?php
                foreach ($dogs as $key => $value) {
                    echo '<tr>
                                    <td>' . $value['dogs_id'] . '</td>
                                    <td><img width="80px" height="80px" src ="' . $value['dog_pic'] . '"></td>
                                    <td>' . $value['dog_name'] . '</td>
                                    <td>' . $value['dog_breed'] . '</td>
                                    <td>' . $value['dog_age'] . '</td>
                                    <td>' . $value['dog_bday'] . '</td>
                                    <td>' . $value['dog_gender'] . '</td>
                                    <td><button class="admin__table-button" type="submit" name="operation[update]" value="' . $value['dogs_id'] . '">Update</button></td>
                                    <td><button class="admin__table-button" type="submit" name="operation[delete]" value="' . $value['dogs_id'] . '">Delete</button></td>
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
                <div class="update__item"><input placeholder="Photo" type="text" name='dog_pic' value="<?php if(isset($update)){echo $update['dog_pic'];} ?>"></div>
                <div class="update__item"><input placeholder="Name" type="text" name='dog_name' value="<?php if(isset($update)) {echo $update['dog_name'];} ?>"></div>
                <div class="update__item"><input placeholder="Breed" type="text" name='dog_breed' value="<?php if(isset($update)){echo $update['dog_breed'];} ?>"></div>
                <div class="update__item"><input placeholder="Age" type="text" name='dog_age' value="<?php if(isset($update)){echo $update['dog_age'];} ?>"></div>
                <div class="update__item"><input placeholder="Birthday" type="date" name='dog_bday' value="<?php if(isset($update)){echo $update['dog_bday'];} ?>"></div>
                <div class="update__item"><input placeholder="Gender" type="text" name='dog_gender' value="<?php if(isset($update)){echo $update['dog_gender'];} ?>"></div>
                <button class="admin__table-new" type="submit" name="submit" value="true">Send</button>
            </form>
        </div>
    </section>
<?php } ?>
