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
$stmt = $pdo->prepare('SELECT * FROM log WHERE row_id = :Id ORDER BY time');
$stmt->execute(array('Id' => $_GET['Id']));

$person = $pdo->prepare('SELECT * FROM Persons WHERE id = :Id ');
$person->execute(array('Id' => $_GET['Id']));

$count = 0;
$num = '';
$arrayPrepare = $stmt->fetchAll(PDO::FETCH_UNIQUE);
$previousValue = null;

?>

<div class="container">
    <div class="row">
        <div class="col-2">
            <?php foreach($person as $obj)
            {
            ?>
            <form action="/action_update.php" method="POST">
                <input type="hidden" class="form-control" id="Id" name="Id" value="<?php echo($obj['Id'])?>" placeholder="name@example.com">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Имя</label>
                    <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo($obj['FirstName'])?>" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Фамилия</label>
                    <input type="text" class="form-control" id="LastName" name="LastName"value="<?php echo($obj['LastName'])?>" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Должность</label>
                    <input type="text" class="form-control" id="Job" name="Job" value="<?php echo($obj['Job'])?>" placeholder="name@example.com">
                </div>
                <label for="exampleFormControlInput1">Зарплата</label>
                <input type="text" class="form-control" id="Salary" name="Salary" value="<?php echo($obj['Salary'])?>" placeholder="name@example.com">
        </div>

        <div style="display:none">
            <div class="form-group" >
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group" >
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect2">Example multiple select</label>
                <select multiple class="form-control" id="exampleFormControlSelect2">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-success" style="display: block">Начислить зарплату</button>
        </form>
        <?php
        }
        ?>
        </div>
        <div class="col-8">
            One of three columns
        </div>
    </div>
</div>


<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Год-Месяц</th>
        <th scope="col">Имя</th>
        <th scope="col">Фамилия</th>
        <th scope="col">Должность</th>
        <th scope="col">Оклад</th>
    </tr>
    </thead>
    <tr class="container col-md">
        <h1 style="">История карьеры сотрудника</h1>
    </tr>

    <?php foreach($arrayPrepare as $obj)
    {
        $timestamp = strtotime($obj['time']);
        $month = date('Y-m', strtotime($obj['time']));
        ?>
        <tr>
            <td><?php echo ++$count?></td>
            <td><?php echo $month?></td>
            <td><?php echo $obj['FirstName']?></td>
            <td><?php echo $obj['LastName']?></td>
            <td><?php echo $obj['Job']?></td>
            <td><?php echo $obj['Salary']?> руб.</td>
            <td><?php echo $_SESSION['test'];?></td>
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