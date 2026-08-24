<?php
// cradentials
$dbhost = "localhost";
$dbType = "mysql";
$dbName = "iti_sm_php_g2_2026";
$userName = "root";
$password = "";





$connection = new PDO("$dbType:host=$dbhost;dbname=$dbName", $userName, $password);
// var_dump($connection);

session_start();
// Insert , select 


// $query = "select * from department";
// // var_dump($select);

// // string ---> sql
// $sqlQuery = $connection->prepare($query);
// // var_dump($sqlQuery);
// // execute 
// $sqlQuery->execute();
//                               // More than row           
// $allDepartments = $sqlQuery->fetch(PDO::FETCH_ASSOC);
// // $allDepartments = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
// var_dump($allDepartments);



// // insert  into table department 

// $queryInsert="insert into department (name,employee_ssn)values('php',5)"; // string
// // $sqlInsert=$connection->prepare($queryInsert);
// // $sqlInsert->execute();

// $sqlInsert=$connection->query($queryInsert); // prepare + execute 