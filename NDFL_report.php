<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>НДФЛ</title>
</head>
<body>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Отчет</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
include 'DB/DataBase.php';
use DB\DataBase\DataBase;
session_start();

$pdo = DataBase::DB();
$stmt = $pdo->prepare('SELECT * FROM log WHERE (time BETWEEN "2023-01-01 00:00:00" AND "2023-12-31 11:59:59") AND row_id = :Id ORDER BY time');
$stmt->execute(array('Id' => $_GET['Id']));
$sum = $pdo->prepare('SELECT row_id, SUM(Salary)  AS person_sum FROM `log` WHERE row_id = :Id GROUP BY row_id');
$sum->execute(array('Id' => $_GET['Id']));
$count = 0;
$num = '';
$arrayPrepare = $stmt->fetchAll(PDO::FETCH_UNIQUE);
$SalaryAll = $sum->fetchAll(PDO::FETCH_UNIQUE);
$previousValue = null;

?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Месяц</th>
        <th scope="col">Имя</th>
        <th scope="col">Фамилия</th>
        <th scope="col">Должность</th>
        <th scope="col">Зарплата</th>
    </tr>
    </thead>
    <tr class="container col-md">
        <h1>Отчет НДФЛ за 2023г</h1>
    </tr>

    <?php foreach($arrayPrepare as $obj)
    {
        $timestamp = strtotime($obj['time']);
        $month = date('m', strtotime($obj['time']));

        if($previousValue) {
            $num = (int)date('m', strtotime($obj['time'])) - $previousValue - 1;
        }
        $previousValue = (int)date('m', strtotime($obj['time']));
        ?>
        <tr>
            <td><?php echo ++$count?></td>
            <td><?php echo $month?></td>
            <td><?php echo $obj['FirstName']?></td>
            <td><?php echo $obj['LastName']?></td>
            <td><?php echo $obj['Job']?></td>
            <td><?php echo $obj['Salary']?> руб. </td>
<!--            <td>--><?php //echo $_SESSION['test'];?><!--</td>-->
        </tr>
        <?php

    }
    ?>

    </tbody>
</table>
<h3 style="text-align: right">Суммарный доход за год
    <?php foreach($SalaryAll as $obj)
    {
        echo $obj['person_sum'] . ' руб.';
    }
    ?>

</h3>
</body>
</html>
</body>
</html>