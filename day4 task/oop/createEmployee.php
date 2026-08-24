<?php
session_start();
require "./connection.php";
require './index.php';

if (isset($_POST['btn-create'])) {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $BD = $_POST["BD"];
    $gender = $_POST["gender"];
    $salary = $_POST["salary"];
    $dep_num_fk = $_POST["dep_num_fk"];
    
    $result = $db->create("employee", [
        "name" => $name,
        "address" => $address,
        "BD" => $BD,
        "gender" => $gender,
        "salary" => $salary,
        "dep_num_fk" => $dep_num_fk ?: null
    ]);

    if ($result === "created successfully") {
        header("location:allEmployees.php?successMessage=Employee created successfully");
        exit;
    } else {
        $errorMessage = "Failed to create employee";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Employee</title>
</head>
<body>
    <?php if (isset($errorMessage)): ?>
        <p class='mt-5 alert alert-danger w-75 m-auto text-center'><?= $errorMessage ?></p>
    <?php endif; ?>
    
    <div class="container mt-4">
        <h2>Create Employee</h2>
        <form action="createEmployee.php" method="post" class="border border-primary w-75 p-5">
            
            <label>Name:</label>
            <input class="form-control mb-3" type="text" name="name" required>

            <label>Address:</label>
            <input class="form-control mb-3" type="text" name="address">

            <label>Birth Date:</label>
            <input class="form-control mb-3" type="date" name="BD">
            
            <label>Gender:</label>
            <select class="form-control mb-3" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <label>Salary:</label>
            <input class="form-control mb-3" type="number" step="0.01" name="salary">
            
            <label>Department Number (Optional):</label>
            <input class="form-control mb-3" type="number" name="dep_num_fk">

            <input class="btn btn-success" type="submit" value="Create Employee" name="btn-create">
            <a href="allEmployees.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
