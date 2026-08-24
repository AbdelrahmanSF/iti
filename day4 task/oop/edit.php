<?php
session_start();
require "./connection.php";
require './index.php';

$userData = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $db->show("users", $id);
    if ($data && count($data) > 0) {
        $userData = $data[0];
    } else {
        header("location:allUsers.php?errorMessage=User not found");
        exit;
    }
}

if (isset($_POST['btn-update'])) {
    $id = $_POST['id'];
    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];
    
    $updateData = [
        "name" => $userName,
        "email" => $userEmail
    ];
    
    if (!empty($_POST["userPassword"])) {
        $updateData["password"] = password_hash($_POST["userPassword"], PASSWORD_DEFAULT);
    }
    
    $result = $db->update("users", $id, $updateData);
    if ($result) {
        header("location:allUsers.php?successMessage=User updated successfully");
        exit;
    } else {
        $errorMessage = "Failed to update user";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <?php if (isset($errorMessage)): ?>
        <p class='mt-5 alert alert-danger w-75 m-auto text-center'><?= $errorMessage ?></p>
    <?php endif; ?>
    
    <?php if ($userData): ?>
    <section class="m-3">
        <form action="edit.php?id=<?= $userData['id'] ?>" method="post" class="border border-primary w-75 m-auto p-5">
            <input type="hidden" name="id" value="<?= $userData['id'] ?>">
            
            <label>Name:</label>
            <input class="form-control m-3" type="text" name="userName" value="<?= htmlspecialchars($userData['name']) ?>" required>

            <label>Email:</label>
            <input class="form-control m-3" type="email" name="userEmail" value="<?= htmlspecialchars($userData['email']) ?>" required>

            <label>New Password (leave empty to keep current):</label>
            <input class="form-control m-3" type="password" name="userPassword" placeholder="Enter New Password">

            <input class="btn btn-primary" type="submit" value="Update" name="btn-update">
        </form>
    </section>
    <?php endif; ?>
</body>
</html>