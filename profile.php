<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.scss">
    <title>Document</title>
</head>

<body>
    <div class="mains">
        <?php

        session_start();
        include('nav.php');
        include('dbconnects.php');
        $Logins = $_SESSION["Logins"];


        // Получаем информацию о пользователе
        $stmt = $conn->prepare("SELECT Names, Surname, Logins FROM users WHERE Logins = ?");
        $stmt->execute([$_SESSION['Logins']]);
        $user = $stmt->fetch();


        // Получаем отзывы пользователя
        $stmt = $conn->prepare("SELECT `choiceCity`, `choiceDate1`, `choiceDate2`, `typeRoom`, `number`, `total` FROM recordroom WHERE id_user = ?");
        $stmt->execute([$_SESSION['id']]);
        $record = $stmt->fetchAll();
         

        foreach ($record as $records) { // Проходим по каждой записи
            $choiceDate1 = new DateTime($records['choiceDate1']);
            $choiceDate2 = new DateTime($records['choiceDate2']);
        }

        $array_of_month = [
            'Января ',
            'Февраля ',
            'Марта ',
            'Апреля ',
            'Мая ',
            'Июня ',
            'Июля ',
            'Августа ',
            'Сентября ',
            'Октября ',
            'Ноября ',
            'Декабря '
        ];

        $month = date('n') - 1;
        $day_we = date('n') - 1;
        $formattedDate1 = $choiceDate1->format('d ' . $array_of_month[$month] . ' Y г.');
        $formattedDate2 = $choiceDate2->format('d ' . $array_of_month[$month] . ' Y г.');
        ?>


        <main class="profile-page">
            <div class="profile-container">
                <h2>Профиль пользователя</h2>
                <p><strong>Имя пользователя:</strong> <?php echo htmlspecialchars($user['Names']); ?></p>
                <p><strong>Дата регистрации:</strong> <?php echo htmlspecialchars($user['Surname']); ?></p>

                <!-- Кнопка выхода -->
                <form action="exit.php" method="post">
                    <button type="submit" class="btn logout-button">Выйти из аккаунта</button>
                </form>
                <h3>Моя бронь</h3>
                <?php

                if (!empty($record)): ?>

                    <?php foreach ($record as $records): 
                        $choiceDate1 = new DateTime($records['choiceDate1']);
                        $choiceDate2 = new DateTime($records['choiceDate2']);
                        $diff = date_diff($choiceDate1, $choiceDate2);
                        $difference = $diff->format("%a");
                        
                        ?>

                        <div class="menu__cards">
                            <div class="menu__cards-card">
                                <div class="menu__card-img">
                                    <?php
                                    if ($records['choiceCity'] === "Москва") {
                                        echo '<img src="img/city1.svg" alt="">';
                                    } elseif ($records['choiceCity'] === "Казань") {
                                        echo '<img src="img/city (3).svg" alt="">';
                                    } elseif ($records['choiceCity'] === "Санкт-Петербург") {
                                        echo '<img src="img/city (2).svg" alt="">';
                                    }

                                    ?>
                                </div>
                                <div class="menu__card-text">
                                    <div class="menu__card-text-paragraph">
                                        <p>гостиница “Comfort zone”</p> <br>
                                        <?php

                                        if ($records['choiceCity'] === "Москва") {
                                            echo "<span>Москва, ул. Спирина, д. 198, стр. 4  </span> <br>";
                                        }
                                        if ($records['choiceCity'] === "Казань") {
                                            echo "<span>Казань, ул. Октябрьская, д. 26, стр. 1 </span> <br>";
                                        }
                                        if ($records['choiceCity'] === "Санкт-Петербург") {
                                            echo "<span>санкт-петербург, ул. Кожевническая, д. 8, стр. 3 </span> <br>";
                                        }
                                        if ($records['typeRoom'] === "1") {
                                            echo "<span>Двухместный номер Standard</span> <br>";
                                        }
                                        if ($records['typeRoom'] === "2") {
                                            echo "<span>Двухкомнатный номер Luxe с двумя ванными</span> <br>";
                                        }
                                        if ($records['typeRoom'] === "3") {
                                            echo "<span>Двухкомнатный номер Premium</span> <br>";
                                        }
                                        if ($records['typeRoom'] === "4") {
                                            echo "<span>Одноместный номер Economy</span> <br>";
                                        }
                                        ?>
                                    </div>

                                </div>
                                <div class="menu__card-text-right">
                                    <span class="span1">заезд с 12:00</span>
                                    <?php
                                    echo '<span class="span2">' . $formattedDate1 . "</span> <br>";
                                    ?>
                                    <span class="span1">выезд до 12:00</span>
                                    <?php
                                    echo '<span class="span2">' . $formattedDate2 . "</span> <br>";
                                    ?>

                                    <span class="span2">стоимость номера: </span>
                                    <span class="span1"> <?php
                                    if ($type === "1") {
                                        echo "<span>Двухместный номер Standard</span> <br>";
                                    }
                                    if ($type === "2") {
                                        echo "<span>Двухкомнатный номер Luxe с двумя ванными</span> <br>";
                                    }
                                    if ($type === "3") {
                                        echo "<span>Двухкомнатный номер Premium</span> <br>";
                                    }
                                    if ($type === "4") {
                                        echo "<span>Одноместный номер Economy</span> <br>";
                                    }

                                    ?></span>
                                    <?php


                                    echo '<span class="span1"> на '  . $difference . ' дней </span> <br>';
                                    ?>


                                    <span class="cost">
                                        <?php
                                        echo $records['total'];
                                        ?>₽
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php else: ?>
                    <p>У вас пока нет опубликованных отзывов.</p>
                <?php endif; ?>
            </div>
        </main>



    </div>

</body>

</html>