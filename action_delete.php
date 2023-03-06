<?php

include 'DB/DataBase.php';

use DB\DataBase\DataBase;

$pdo = DataBase::DB();

$person = $pdo->prepare('DELETE FROM Persons WHERE Id = :Id');



$person->execute(array(
    'Id' => $_POST['Id']
));
header("Location: /");
die();