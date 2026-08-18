<?php
session_start();

$error = '';
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $users = require __DIR__ . '/users.php';
    $found = null;
    foreach ($users as $u) {
        if (strcasecmp($u['UserEmail'], $email) === 0 && $u['password'] === $password) {
            $found = $u;
            break;
        }
    }

    if ($found) {
        // store minimal user info in session
        $_SESSION['user'] = [
            'id' => $found['id'],
            'userName' => $found['userName'],
            'UserEmail' => $found['UserEmail']
        ];
        header('Location: allUsers.php');
        exit;
    } else {
        $error = 'Wrong email or password';
        // do not redirect; show error on the same page
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php require_once 'nav.php'; ?>
<div class="container d-flex justify-content-center align-items-center" style="min-height:80vh;">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Login</h3>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" required value="<?= htmlspecialchars($email) ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
</body>
</html>