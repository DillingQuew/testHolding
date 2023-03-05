<?php
include 'DB/DataBase.php';
use DB\DataBase\DataBase;

$pdo = DataBase::DB();

$person = $pdo->prepare('INSERT INTO Persons (FirstName, LastName, Job, Salary) 
                               VALUES (:FirstName, :LastName, :Job, :Salary)');

                              //INSERT INTO table_name (column1, column2, column3, ...)
                              //VALUES (value1, value2, value3, ...);
$person->execute(array(
    'FirstName' => $_POST['FirstName'],
    'LastName'=>$_POST['LastName'],
    'Job'=>$_POST['Job'],
    'Salary'=>$_POST['Salary'],
));
header("Location: /");
die();