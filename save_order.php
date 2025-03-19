<?php
session_start();
mb_internal_encoding("UTF-8");
include ("dbconnect.php");
include ("nav.php");

if (isset($_POST['Logins'])) {
    $Logins = $_POST['Logins'];
}
if (isset($_POST['Phones'])) {
    $Phones = $_POST['Phones'];
}
if (isset($_POST['Adress'])) {
    $Adress = $_POST['Adress'];
}
if (empty($Phones) or empty($Adress)) {
    echo ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
}

?>
<main class="menu-mains">

    <div class="dialog">
        <img class="kolas" src="img/buyio.png" alt="">
        <?php

        if (!empty($_POST['Phones']) && !empty($_POST['Adress'])) {
            $Logins = $_POST['Logins'];
            $Phones = $_POST['Phones'];
            $Adress = $_POST['Adress'];
            $totalQuantity = $_GET['totalQuantity'];
            $totalPrice = $_GET['totalPrice'];
            $products = htmlspecialchars(json_encode($_SESSION['products'], JSON_UNESCAPED_UNICODE));


            // Здесь можно обработать данные, например, сохранить в базу данных или отправить на почту
            foreach ($_SESSION['products'] as $product) {
                if (!empty($_SESSION['id'])) {
                    $kod = $_SESSION['id'];
                    $ment = $product['id'];
                    // echo "<h1>" . ($product['id']) . "</h1>";
                    $result2 = $mysqli->query("INSERT INTO orders (id_users, id_products, Logins, Phones, Adress, Products, totalPrice, totalQuantity) VALUES ('$kod','$ment','$Logins', '$Phones', '$Adress', '" . $product['name'] . "', '$totalPrice', '$totalQuantity')");
                }
            }
            if ($result2 === TRUE) {
                echo '<div class="boxih">';
                echo '<p class = "litter-s">ЗАКАЗ УСПЕШНО ОФОРМЛЕН! </p> </br>';
                echo '<p class = "litter">ДОСТАВКА ОСУЩЕСТВЛЯЕТСЯ ПО АДРЕСУ: </br>' . $Adress . '</p></br>';
                echo '<p class = "litter">КОЛИЧЕСТВО ВСЕХ ТОВАРОВ: ' . $totalQuantity . '</p></br>';
                echo '<p class = "litter">ВАШИ ПОЗИЦИИ: </p></br>';
                foreach ($_SESSION['products'] as $product) {
                    echo '<p class = "litter">' . $product['name'] . ' количество: ' . $product['quantity'] . '</p></br>';
                }
                echo ' <p class = "litter"> СУММА ЗАКАЗА: ' . $totalPrice . '</p></br>';
                echo '</div>';
            } else {
                
                if (empty($_SESSION['id'])) {
                    if (empty($_SESSION['Logins']) or empty($_SESSION['id'])) {
                        echo '<div class="boxih">';
                        echo '<p class = "litter-s">Ошибка при сохранении заказа: </p></br>';
                        echo '<p class = "litter">Войдите в учётную запись, или зарегестрируйтесь.</p><br>';
                        echo '<p class = "litter">Данное окно закроется автоматически </p> ';
                        header("Refresh:5; url=registr.php");
                        echo '</div>';
                     }}
            }
            $_SESSION['products'] = [];
        } else {
            echo 'Пожалуйста, заполните все поля формы.';
        }
        ?>
    </div>
</main>