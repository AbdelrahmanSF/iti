<?php
session_start();
require "./connection.php";
require './index.php';

$empData = null;
if (isset($_GET['ssn'])) {
    $ssn = $_GET['ssn'];
    $data = $db->show("employee", $ssn, "ssn");
    if ($data && count($data) > 0) {
        $empData = $data[0];
    } else {
        header("location:allEmployees.php?errorMessage=Employee not found");
        exit;
    }
}

if (isset($_POST['btn-update'])) {
    $ssn = $_POST['ssn'];
    
    $updateData = [
        "name" => $_POST["name"],
        "address" => $_POST["address"],
        "BD" => $_POST["BD"],
        "gender" => $_POST["gender"],
        "salary" => $_POST["salary"],
        "dep_num_fk" => $_POST["dep_num_fk"] ?: null
    ];
    
    $result = $db->update("employee", $ssn, $updateData, "ssn");
    if ($result) {
        header("location:allEmployees.php?successMessage=Employee updated successfully");
        exit;
    } else {
        $errorMessage = "Failed to update employee";
        // Reload data to repopulate the form in case of error
        $empData = $updateData;
        $empData['ssn'] = $ssn;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
</head>
<body>
    <?php if (isset($errorMessage)): ?>
        <p class='mt-5 alert alert-danger w-75 m-auto text-center'><?= $errorMessage ?></p>
    <?php endif; ?>
    
    <?php if ($empData): ?>
    <div class="container mt-4">
        <h2>Edit Employee</h2>
        <form action="editEmployee.php?ssn=<?= $empData['ssn'] ?>" method="post" class="border border-primary w-75 p-5">
            <input type="hidden" name="ssn" value="<?= $empData['ssn'] ?>">
            
            <label>Name:</label>
            <input class="form-control mb-3" type="text" name="name" value="<?= htmlspecialchars($empData['name'] ?? '') ?>" required>

            <label>Address:</label>
            <input class="form-control mb-3" type="text" name="address" value="<?= htmlspecialchars($empData['address'] ?? '') ?>">

            <label>Birth Date:</label>
            <input class="form-control mb-3" type="date" name="BD" value="<?= htmlspecialchars($empData['BD'] ?? '') ?>">
            
            <label>Gender:</label>
            <select class="form-control mb-3" name="gender">
                <option value="male" <?= (isset($empData['gender']) && $empData['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                <option value="female" <?= (isset($empData['gender']) && $empData['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
            </select>

            <label>Salary:</label>
            <input class="form-control mb-3" type="number" step="0.01" name="salary" value="<?= htmlspecialchars($empData['salary'] ?? '') ?>">
            
            <label>Department Number:</label>
            <input class="form-control mb-3" type="number" name="dep_num_fk" value="<?= htmlspecialchars($empData['dep_num_fk'] ?? '') ?>">

            <input class="btn btn-primary" type="submit" value="Update Employee" name="btn-update">
            <a href="allEmployees.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <?php endif; ?>
</body>
</html>
