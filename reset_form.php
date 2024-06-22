<?php
require_once 'db_config.php';

if (isset($_GET['token'])) {
    $token = trim($_GET['token']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Reset Password</h2>
            <form action="forget.php" method="post" id="resetForm">
                <div class="mb-3">
                    <label for="resetEmail" class="form-label">E-mail address</label>
                    <input type="text" class="form-control" id="resetEmail" name="resetEmail"
                           placeholder="Enter your email" required>
                </div>

                <div class="mb-3">
                    <label for="resetPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="resetPassword" name="resetPassword"
                           placeholder="Enter new password" required>
                </div>

                <div class="mb-3">
                    <label for="resetPasswordConfirm" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="resetPasswordConfirm" name="resetPasswordConfirm"
                           placeholder="Confirm new password" required>
                </div>

                <input type="hidden" name="action" value="resetPassword">
                <input type="hidden" name="token" value="<?php echo $token ?>">


                <button type="submit" class="btn btn-primary">Reset Password</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
