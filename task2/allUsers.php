<?php
session_start();
$users = require __DIR__ . '/users.php';
// if not logged in, redirect to login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{padding-top:70px}</style>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>All Users</h2>
    </div>

    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>userName</th>
                <th>UserEmail</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['id']) ?></td>
                <td><?= htmlspecialchars($u['userName']) ?></td>
                <td><?= htmlspecialchars($u['UserEmail']) ?></td>
                <td>
                    <button class="btn btn-sm btn-danger">delete</button>
                    <button class="btn btn-sm btn-primary">update</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
</body>
</html>