<?php

require "./connection.php";
require './index.php';

if (isset($_POST['btn-register'])) {
    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];
    // $hasPassword = md5($userPassword);

    /**
     * check email exist or not 
     * 
     * Insert 
     */
    //================================ Check Data match regix ==========


    //-------------- name ----------

    $namePattern = '/^[a-zA-Z]{3,}$/';
    if (!preg_match($namePattern, $userName)) {
        header("location:register.php?errorMessage=enter a valid name must be string and more than 3 charaxters");
        exit;
    }


    //-------------- password ----------
    $passwordPattern = '/^[0-9]{5,15}$/';
    if (!preg_match($passwordPattern, $userPassword)) {
        header("location:register.php?errorMessage=enter a valid password must be numbers and more than 5 numbers");
        exit;
    }

    //-------------- email ----------

    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        header("location:register.php?errorMessage=enter a valid Email");
        exit;
    }






    //=========================================


    //====================== Check Email =================
    $ckeckEmail = "SELECT * FROM `users` WHERE email=:email";
    $sqlCheckEmail = $connection->prepare($ckeckEmail);

    $sqlCheckEmail->execute([
        ":email" => $userEmail
    ]);

    $emailExist = $sqlCheckEmail->fetch(PDO::FETCH_ASSOC);
    if ($emailExist) {
        header("location:register.php?errorMessage=Email Already Exist");
        exit;
    }


    //================================== Insert Data ========
    // $queryInsert = "insert into users (name,email,password)values('$userName','$userEmail','$userPassword')";


    $hasPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    try {
        $queryInsert = "insert into users (name,email,password)values(:name,:email,:password)";

        // $queryInsert = "insert into users (name,email,password)values(?,?,?)";
        $sqlInsert = $connection->prepare($queryInsert);
        $sqlInsert->execute(
            [
                ":name" => $userName,
                ":email" => $userEmail,
                // ":password" => $userPassword
                ":password" => $hasPassword

            ]
        );
        // $sqlInsert->execute(
        //     [
        //          $userName,
        //          $userEmail,
        //          $userPassword

        //     ]
        // );
        header("location:login.php?successMessage=register successfully");
        exit;
    } catch (Error $e) {
        //throw $th;

        echo $e->getMessage();
    }
}

//******************** login ********************** */

if (isset($_POST["btn-login"])) {
    var_dump($_POST["btn-login"]);
    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];


    $ckeckEmail = "SELECT * FROM `users` WHERE email=:email";
    $sqlCheckEmail = $connection->prepare($ckeckEmail);

    $sqlCheckEmail->execute([
        ":email" => $userEmail
    ]);

    $data = $sqlCheckEmail->fetch(PDO::FETCH_ASSOC);
    var_dump($data);
    // $hashPassword= password_verify($userPassword,$data['password']);
    if ($data && password_verify($userPassword, $data['password'])) {
        header("location:profile.php?successMessage=login successfully");
        $_SESSION['loginID'] = $data['id'];
        exit;
    } else {
        header("location:login.php?errorMessage=check your email or password");
        exit;
    }

    /***
     * 
     */
}
