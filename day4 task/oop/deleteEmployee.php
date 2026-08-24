<?php
session_start();
require "./connection.php";

if (isset($_GET['ssn'])) {
    $ssn = $_GET['ssn'];
    $result = $db->delete("employee", $ssn, "ssn");
    
    if ($result) {
        header("location:allEmployees.php?successMessage=Employee deleted successfully");
        exit;
    } else {
        header("location:allEmployees.php?errorMessage=Failed to delete employee");
        exit;
    }
} else {
    header("location:allEmployees.php");
    exit;
}
?>
