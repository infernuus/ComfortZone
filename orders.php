<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.scss">
    <title>Document</title>
</head>

<body>

</body>

</html>
<?php
// Запускаем сессию
session_start();
// Подключаем файлы для шапки и меню
include('nav_admin.php');
?>
<main class="orders">
    <div class="input-l">
        <div class="input-l-l">
            <p class="input-labell"><b>Город</b></p>
            <p class="input-labell"><b>Дата въезда</b></p>
            <p class="input-labell"><b>Дата отъезда</b></p>
            <p class="input-labell"><b>Тип номера</b></p>
            <p class="input-labell"><b>ID пользователя</b></p>
            <p class="input-labell"><b>номер</b></p>
            <p class="input-labell"><b>Вся сумма</b></p>
            <p class="input-labell"><b>Удалить</b></p>
        </div>
    </div>
    <?php
    include("dbconnect.php");
    $label = 'id';
    $id = false;
    if (!empty($_GET[$label])) {
        $id = $_GET[$label];
    }
    $result = $mysqli->query("SELECT * FROM recordroom WHERE id ='$id'");
    $result = mysqli_query($mysqli, "SELECT * FROM recordroom");
    $div = "<div class='cards'>";
    $k = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $div .= '<div class="input-l">';
        $div .= '<div class="input-l-l">';
        $id = $row['id'];
        $div .= '<p class="input-labell">' . $row['choiceCity'] . '</p>';
        $div .= '<p class="input-labell">' . $row['choiceDate1'] . '</p>';
        $div .= '<p class="input-labell">' . $row['choiceDate2'] . '</p>';
        $div .= '<p class="input-labell">' . $row['typeRoom'] . '</p>';
        $div .= '<p class="input-labell">' . $row['id_user'] . '</p>';
        $div .= '<p class="input-labell">' . $row['number'] . '</p>';
        $div .= '<p class="input-labell">' . $row['total'] . '</p>';
        $div .= ' <form class="delete_btn" action="orders.php" method="post">
        <p class="input-labell"><input type="hidden" name="delete_btn" value="1">
                <button type="submit">Удалить</button></p>
            </form>';
        $div .= '</div>';
        $div .= '</div>';
        $k++;
    }
    if (isset($_POST['delete_btn'])) {
        $sql = "DELETE FROM recordroom WHERE id = '$id'";
        $id = $_POST['id'];
        if ($mysqli->query($sql)) {
            echo "Запись успешно удалена";
        } else {
            echo "Ошибка при удаление заказа! ";
        }
    }
    $div .= '</div>';
    echo $div;

    ?>
    <div class="input-l">
        <div class="input-l-l">
            <p class="input-labell"><b>Тип номера</b></p>
            <p class="input-labell"><b>номер</b></p>
            <p class="input-labell"><b>ID записи</b></p>
            <p class="input-labell"><b>ID пользователя</b></p>
            <p class="input-labell"><b>Запись ли?</b></p>
            <p class="input-labell"><b>Удалить</b></p>
        </div>
    </div>
<?php
    $result2 = $mysqli->query("SELECT * FROM rooms WHERE id ='$id'");
    $result2 = mysqli_query($mysqli, "SELECT * FROM rooms");
    
    $div = "<div class='cards'>";
        $k = 1;
        while ($rows = mysqli_fetch_assoc($result2)) {
        $div .= '<div class="input-l">';
            $div .= '<div class="input-l-l">';
                $id = $rows['id'];
                $div .= '<p class="input-labell">' . $rows['type'] . '</p>';
                $div .= '<p class="input-labell">' . $rows['number'] . '</p>';
                $div .= '<p class="input-labell">' . $rows['id_record'] . '</p>';
                $div .= '<p class="input-labell">' . $rows['id_user'] . '</p>';
                $div .= '<p class="input-labell">' . $rows['record'] . '</p>';
                $div .= ' <form class="delete_btn" action="orders.php" method="post">
                    <p class="input-labell"><input type="hidden" name="delete_btn-r" value="1">
                        <button type="submit">Удалить</button>
                    </p>
                </form>';
                $div .= '</div>';
                $div .= '</div>';
                $k++;
        }
        if (isset($_POST['delete_btn'])) {
            $sql = "DELETE FROM rooms WHERE id = '$id'";
            $id = $_POST['id'];
            if ($mysqli->query($sql)) {
                echo "Запись успешно удалена";
            } else {
                echo "Ошибка при удаление заказа! ";
            }
        }
        $div .= '</div>';
        echo $div;
        ?>

</main>