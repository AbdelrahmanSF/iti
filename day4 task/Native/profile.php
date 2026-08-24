<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 

require "./connection.php";

if(isset($_SESSION['loginID']))
    {
        $userId=$_SESSION['loginID'];
        $query='select * from users where id=:id';
        $sqlQuery=$connection->prepare($query);
        $sqlQuery->execute([
            ":id"=>$userId
        ]);
        $userData=$sqlQuery->fetch(PDO::FETCH_ASSOC);
    }

  if(isset($_GET["successMessage"]))
        {
         echo "<p class=' mt-5 alert alert-success w-75 m-auto text-center'>". $_GET["successMessage"]."</p>";
        }
    ?>
?>
    
<h1>All users </h1>

<p> <?php  echo $userData['name']; ?>  </p>
</body>
</html>