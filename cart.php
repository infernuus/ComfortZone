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
    include ('dbconnect.php');
    ?>
    <main class="menu-mains">
        <div class="cart-wow">
            <?php
            if (!isset($_SESSION['products'])) {
                $_SESSION['products'] = [];
                echo 'Корзина пуста';
            }
            echo 'Товары в корзине: ';
                echo '<ul>';
                foreach ($_SESSION['products'] as $key => $product) {
                    echo '<li>' . $product['name'] . ' Цена: ' . $product['price'] . ' Количество: <a href="cart.php?id=' . $product['id'] . '&name=' . $product['name'] . '&price=' . $product['price'] . '&quantity=' . ($product['quantity'] + 1) . '">+</a> ' . $product['quantity'] . 
                    '
                    <a href="cart.php?id=' . $product['id'] . '&name=' . $product['name'] . '&price=' . $product['price'] . '&quantity=' . ($product['quantity'] - 1) . '">-</a>
                    <a onClick="refreshPage()" href="cart.php?id=' . $product['id'] . '&name=' . $product['name'] . '&price=' . $product['price'] . '&action=delete"><img style="top: 6px;width:27px;height:27px;position: relative;"
                    src="img/clear.png" alt="cart"></a>
                    </li>';
                }
                echo '</ul>';
                $totalPrice = 0;
                foreach ($_SESSION['products'] as $product) {
                    $totalPrice += $product['price'] * $product['quantity'];
                }
                $totalQuantity = 0;
                foreach ($_SESSION['products'] as $product) {
                    $totalQuantity += $product['quantity'];
                }
                echo 'Общая сумма покупок: ' . $totalPrice;

                // Форма для оформления заказа
                echo ' 
                <form class="forms" method="post" action="save_order.php?name=' . $productName . ' &totalPrice=' . $totalPrice . '&totalQuantity=' . $totalQuantity . '"> 
                <input type="hidden" name="Logins" value=" ' . $_SESSION["Logins"] . '" required> 
                <label for="Phones">Телефон:</label> 
                <input class="input-labelll" type="phone" name="Phones" required><br> 
                <label for="Adress">Адрес:</label> 
                <input class="input-labelll" type="address" name="Adress" required><br> 
                <input type="hidden" name="products" value="' . htmlspecialchars(json_encode($_SESSION['products'], JSON_UNESCAPED_UNICODE)) . '"> 
                <input class="input-labellll" type="submit" value="Оформить заказ"> 
                </form>';
            if (isset($_GET['id'])) {
                $productId = $_GET['id'];
                $productName = $_GET['name'];
                $productPrice = $_GET['price'];
                $productQuantity = $_GET['quantity'];

                // Проверяем, есть ли уже такой товар в корзине 
                $productExists = false;
                foreach ($_SESSION['products'] as $key => $product) {
                    if ($product['id'] == $productId) {
                        // Товар с таким id уже есть в корзине, обновляем количество 
                        $_SESSION['products'][$key]['quantity'] = $productQuantity;
                        $productExists = true;
                        break;
                    }
                }
            }

            if (isset($_POST['clear_cart'])) {
                $_SESSION['products'] = [];
                echo 'Корзина успешно очищена.';
            }
            if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
                $deleteProductId = $_GET['id'];
                foreach ($_SESSION['products'] as $key => $product) {
                    if ($product['id'] == $deleteProductId) {
                        unset($_SESSION['products'][$key]);
                        break;
                    }
                }
            }
            
            ?>
            <form class="clear" action="cart.php" method="post">
                <input type="hidden" name="clear_cart" value="1">
                <button type="submit">Очистить корзину <img style="top: 6px;width:27px;height:27px;position: relative;"
                        src="img/clearc.png" alt="cart"></button>
            </form>
        </div>
    </main>
</body>

</html>
<script> 
function refreshPage(){
    window.location.reload();
} 
</script>