<?php
require "./connection.php";
require './index.php';

$allEmployees = $db->index("employee");
if(empty($allEmployees)) {
    $allEmployees = []; // Ensure it's an array even if empty
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employees</title>
</head>
<body>
<?php
    if(isset($_GET["errorMessage"])) {
        echo "<p class=' mt-5 alert alert-danger w-75 m-auto text-center'>". htmlspecialchars($_GET["errorMessage"])."</p>";
    }
    if(isset($_GET["successMessage"])) {
        echo "<p class=' mt-5 alert alert-success w-75 m-auto text-center'>". htmlspecialchars($_GET["successMessage"])."</p>";
    }
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Employees List</h2>
        <a href="createEmployee.php" class="btn btn-success">Add Employee</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>SSN</th>
                <th>Name</th>
                <th>Address</th>
                <th>Birth Date</th>
                <th>Gender</th>
                <th>Salary</th>
                <th>Department FK</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($allEmployees as $emp): ?>
            <tr>
                <td><?= htmlspecialchars($emp["ssn"]) ?></td>
                <td><?= htmlspecialchars($emp["name"]) ?></td>
                <td><?= htmlspecialchars($emp["address"]) ?></td>
                <td><?= htmlspecialchars($emp["BD"]) ?></td>
                <td><?= htmlspecialchars($emp["gender"]) ?></td>
                <td><?= htmlspecialchars($emp["salary"]) ?></td>
                <td><?= htmlspecialchars($emp["dep_num_fk"]) ?></td>
                <td>
                    <a href="editEmployee.php?ssn=<?= $emp["ssn"] ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="deleteEmployee.php?ssn=<?= $emp["ssn"] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if(empty($allEmployees)): ?>
            <tr><td colspan="8" class="text-center">No employees found</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
