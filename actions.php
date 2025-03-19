<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Запускаем сессию
    session_start();
    // Подключаем файлы для шапки и меню
    include ('nav.php');
    ?>
    <main class="menu--main">
        <img class="image-vkus" src="img/vkus (2).png" alt="">
        <p class="vkus">Скажите название блюда при подтверждении заказа по номеру и наш оператор добавит его в корзину</p>
        <img class="image-vkus2" src="img/vkus (1).png" alt="">
        <p class="vkus">Скажите название блюда при подтверждении заказа по номеру и наш оператор добавит его в корзину</p>
    </main>

</body>
<?php

include ('footer.php');
?>

</html>