<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();

    // Проверяем, существует ли массив корзины в сессии, если нет - создаем его 
    if (!isset($_SESSION['products'])) {
        $_SESSION['products'] = [];
    }

    // Проверяем, был ли передан ID товара для добавления в корзину 
    if (isset($_GET['id'])) {
        $productId = $_GET['id'];
        $productName = $_GET['name'];
        $productPrice = $_GET['price'];

        // Добавляем ID товара в массив корзины 
        $_SESSION['products'][] = ['id' => $productId, 'name' => $productName ,'price' => $productPrice];

        echo 'Товар ' . $productName . ' успешно добавлен в корзину!';
        
    } else {
        echo 'Товар не найден';
    }

    // Выводим содержимое корзины 
    echo 'Товары в корзине: ';
    echo '<pre>';
    print_r(end($_SESSION['products'])['name']); // Исправлено на 'name'
    echo '</pre>';
    header("Refresh:0; url=cart.php?id=' . $productId . '&name=' . $productName .'&price=' . $productPrice.'");
    ?>
</body>

</html>