<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сотрудники</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
session_start();

include 'DB/DataBase.php';
use DB\DataBase\DataBase;
$pdo = DataBase::DB();
$stmt = $pdo->query('SELECT * FROM Persons');
//$arrayPrepare = $stmt->fetch(PDO::FETCH_LAZY);
$count = 0;
?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Имя</th>
        <th scope="col">Фамилия</th>
        <th scope="col">Должность</th>
        <th scope="col">Подробнее</th>
        <th scope="col">Отчет НДФЛ</th>
    </tr>
    </thead>
    <tr class="container col-md">
        <h1>Сотрудники</h1>
        <a class = "btn btn-primary" href="/create.php">Добавить сотрудника</a>
    </tr>
    <?php while($obj = $stmt->fetch(PDO::FETCH_LAZY))
    {
//      var_dump($obj);
        ?>
        <tr>

            <td><?php echo $obj['Id']?></td>
            <td><?php echo $obj['FirstName']?></td>
            <td><?php echo $obj['LastName']?></td>
            <td><?php echo $obj['Job']?></td>
            <td>
                <form action="person.php" method="GET">
                    <input type="hidden" id="Id" name="Id" value="<?php echo($obj['Id']);?>">
                    <button type="submit" class="btn btn-primary">Подробнее</button>
                </form>
            </td>
            <td>
                <form action="NDFL_report.php" method="GET">
                    <input type="hidden" id="Id" name="Id" value="<?php echo($obj['Id']);?>">
                    <button type="submit" class="btn btn-primary">ОТЧЕТ НДФЛ</button>
                </form>
            </td>
        </tr>
        <?php

    }
    ?>
    </tbody>
</table>
</body>
</html>
</body>
</html>
</body>
</html>