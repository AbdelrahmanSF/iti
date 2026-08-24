<?php
session_start();
require "./connection.php";
require './index.php';

if (isset($_POST['btn-register'])) {
    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];

    $namePattern = '/^[a-zA-Z]{3,}$/';
    if (!preg_match($namePattern, $userName)) {
        header("location:register.php?errorMessage=enter a valid name must be string and more than 3 charaxters");
        exit;
    }

    $passwordPattern = '/^[0-9]{5,15}$/';
    if (!preg_match($passwordPattern, $userPassword)) {
        header("location:register.php?errorMessage=enter a valid password must be numbers and more than 5 numbers");
        exit;
    }

    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        header("location:register.php?errorMessage=enter a valid Email");
        exit;
    }

    $allUsers = $db->index("users");
    if ($allUsers) {
        foreach ($allUsers as $user) {
            if ($user['email'] === $userEmail) {
                header("location:register.php?errorMessage=Email Already Exist");
                exit;
            }
        }
    }

    $hasPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    
    $result = $db->create("users", [
        "name" => $userName,
        "email" => $userEmail,
        "password" => $hasPassword
    ]);

    if ($result === "created successfully") {
        header("location:login.php?successMessage=register successfully");
        exit;
    } else {
        header("location:register.php?errorMessage=" . urlencode($result));
        exit;
    }
}

if (isset($_POST["btn-login"])) {
    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];

    $allUsers = $db->index("users");
    $foundUser = null;
    
    if ($allUsers) {
        foreach ($allUsers as $user) {
            if ($user['email'] === $userEmail) {
                $foundUser = $user;
                break;
            }
        }
    }

    if ($foundUser && password_verify($userPassword, $foundUser['password'])) {
        header("location:allUsers.php?successMessage=login successfully");
        $_SESSION['loginID'] = $foundUser['id'];
        exit;
    } else {
        header("location:login.php?errorMessage=check your email or password");
        exit;
    }
}
?>