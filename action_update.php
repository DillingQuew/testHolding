<?php
include 'DB/DataBase.php';
use DB\DataBase\DataBase;

$pdo = DataBase::DB();

$person = $pdo->prepare('UPDATE Persons SET FirstName = :FirstName, 
               LastName = :LastName, Job = :Job, Salary = :Salary WHERE id = :Id');
$person->execute(array(
    'Id' => $_POST['Id'],
    'FirstName' => $_POST['FirstName'],
    'LastName'=>$_POST['LastName'],
    'Job'=>$_POST['Job'],
    'Salary'=>$_POST['Salary'],
));
header("Location: /");
die();