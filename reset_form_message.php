<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="alert alert-info">
                <?php
                include_once 'db_config.php';
                $rf = 0;

                if (isset($_GET["rf"]) and is_numeric($_GET['rf'])) {
                    $rf = (int)$_GET["rf"];

                    if (array_key_exists($rf, $messages)) {
                        echo '<p>' . $messages[$rf] . '</p>';
                    }
                }
                ?>
            </div>
            <a href="index.php" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
</div>
</body>
</html>
