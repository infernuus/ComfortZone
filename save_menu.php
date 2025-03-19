<?php
session_start();
if (isset($_POST['name'])) {
$name = $_POST['name'];
}

if (isset($_POST['discription'])) {
$discription = $_POST['discription'];
}

if (isset($_POST['photo'])) {
    $photo = $_POST['photo'];
}

if (isset($_POST['price'])) {
    $price = $_POST['price'];
}

if (isset($_POST['mass'])) {
    $mass = $_POST['mass'];
}

    if (empty($name) or empty($discription)) {
        exit("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    else {
        include("dbconnect.php");

        if (!empty($_SESSION['id'])) {
            $kod = $_SESSION['id'];
            $result = $mysqli->query("INSERT INTO products (name, discription, photo, price, mass) VALUES('$name','$discription', '$photo', '$price', '$mass')");
            if ($result == 'TRUE') {
                echo "Товар в меню успешно добавлен!";
                header("Refresh:0.1; url=orders.php");
        } else {
             echo "Ошибка! Товар не сохранен";
        }
        }
    }

?>