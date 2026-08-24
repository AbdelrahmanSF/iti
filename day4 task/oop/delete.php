<?php
session_start();
require "./connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $db->delete("users", $id);
    
    if ($result) {
        header("location:allUsers.php?successMessage=User deleted successfully");
        exit;
    } else {
        header("location:allUsers.php?errorMessage=Failed to delete user");
        exit;
    }
} else {
    header("location:allUsers.php");
    exit;
}
?>
