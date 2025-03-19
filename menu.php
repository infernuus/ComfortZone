<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.scss">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <main class="menu-main">
        <?php
        mb_internal_encoding("UTF-8");

        // Запускаем сессию
        session_start();
        // Подключаем файлы для шапки и меню
        include('nav.php');
        include('dbconnect.php');

        if (isset($_POST['city'])) {
            $choiceCity = $_POST['city'];
        }
        if (isset($_POST['selection'])) {
            $type = $_POST['selection'];
        }
        if (isset($_POST['date1'])) {
            $choiceDate1 = $_POST['date1'];
        }
        if (isset($_POST['date2'])) {
            $choiceDate2 = $_POST['date2'];
        }
        if (isset($_SESSION['id'])) {
            $id_user = $_SESSION['id'];
        }

        $id = intval($id_user);
        $choiceDatedate1 = new DateTime($choiceDate1);
        $choiceDatedate2 = new DateTime($choiceDate2);
        $diff = date_diff($choiceDatedate1, $choiceDatedate2);
        $diffirence = $diff->format("%a");
        $record = "yes";


        // Генерируем уникальное число для number_1 (100-120)
        $number_1 = rand(100, 105);
        $number_2 = rand(200, 205);
        $number_3 = rand(300, 305);
        $number_4 = rand(400, 405);

        // Выводим результаты
        if ($type === "4") {
            $number = $number_1;
        }
        if ($type === "1") {
            $number = $number_2;
        }
        if ($type === "3") {
            $number = $number_3;
        }
        if ($type === "2") {
            $number = $number_4;
        }

        $coasts = $mysqli->query("SELECT * FROM typeRoom");

        while ($row = mysqli_fetch_assoc($coasts)) {
            // Проверяем значение id и type
            if ($row['id'] == "$type") {
                $coast = $row['roomCost'];
                $total = $coast * $diffirence;
            }

        }
        $id_record = null;
        if ($choiceDate1 < $choiceDate2) {

            // Инициализация переменных
            $number = null;
            $unique = false;

            // Проверка состояния номеров в зависимости от типа
            if ($type == "4") {
                // Проверяем, есть ли свободные номера от 100 до 105
                $checkQuery = $mysqli->query("SELECT COUNT(*) FROM `rooms` WHERE `number` IN (100, 101, 102, 103, 104, 105)");

                $checkCount = $checkQuery->fetch_row()[0];

                if ($checkCount == 6) {
                    echo "Извините, к сожалению все номера заняты, вернитесь на прошлую страницу, и выберите другой тип номера.";
                    exit;
                }
            } elseif ($type == "1") {
                // Проверяем, есть ли свободные номера от 200 до 205
                $checkQuery = $mysqli->query("SELECT COUNT(*) FROM `rooms` WHERE `number` IN (200, 201, 202, 203, 204, 205)");
                $checkCount2 = $checkQuery->fetch_row()[0];

                if ($checkCount2 == 6) {
                    echo "Извините, к сожалению все номера заняты, вернитесь на прошлую страницу, и выберите другой тип номера.";
                    exit;
                }
            } elseif ($type == "2") {
                // Проверяем, есть ли свободные номера от 200 до 205
                $checkQuery = $mysqli->query("SELECT COUNT(*) FROM `rooms` WHERE `number` IN (400, 401, 402, 403, 404, 405)");
                $checkCount4 = $checkQuery->fetch_row()[0];

                if ($checkCount4 == 6) {
                    echo "Извините, к сожалению все номера заняты, вернитесь на прошлую страницу, и выберите другой тип номера.";
                    exit;
                }
            } elseif ($type == "3") {
                // Проверяем, есть ли свободные номера от 200 до 205
                $checkQuery = $mysqli->query("SELECT COUNT(*) FROM `rooms` WHERE `number` IN (300, 301, 302, 303, 304, 305)");
                $checkCount3 = $checkQuery->fetch_row()[0];


                if ($checkCount3 == 6) {
                    echo "Извините, к сожалению все номера заняты, вернитесь на прошлую страницу, и выберите другой тип номера.";
                    exit;
                }
            }

            // Генерация номера пока не найдем уникальный
            while (!$unique) {
                if ($type == "4") {
                    $number = rand(100, 105);
                } elseif ($type == "1") {
                    $number = rand(200, 205);
                } elseif ($type == "3") {
                    $number = rand(300, 305);
                } elseif ($type == "2") {
                    $number = rand(400, 405);
                }

                // Проверяем существование номера в обеих таблицах
                $resultRooms = $mysqli->query("SELECT COUNT(*) FROM `rooms` WHERE `number` = '$number'");
                $resultRecordRoom = $mysqli->query("SELECT COUNT(*) FROM `recordroom` WHERE `number` = '$number'");

                $countRooms = $resultRooms->fetch_row()[0];
                $countRecordRoom = $resultRecordRoom->fetch_row()[0];

                // Если номер не существует в обеих таблицах, выходим из цикла
                if ($countRooms == 0 && $countRecordRoom == 0) {
                    $unique = true;
                }
            }

            // Вставляем уникальный номер в таблицу recordroom
            $result2 = $mysqli->query("INSERT INTO `recordroom`(`choiceCity`,`choiceDate1`, `choiceDate2`, `typeRoom`, `id_user`, `number`, `total`) VALUES ('$choiceCity', '$choiceDate1', '$choiceDate2', '$type', '$id_user', '$number', '$total')");
            if ($result2 === TRUE) {
                $id_record = $mysqli->insert_id;
                echo "<script>console.log('Запись сделана')</script>";

                // Вставляем уникальный номер в таблицу rooms
                $result3 = $mysqli->query("INSERT INTO `rooms` (`type`, `number`, `id_user`, `id_record`, `record`) VALUES ('$type', '$number', '$id', '$id_record', '$record')");
                if ($result3 === TRUE) {
                    echo "<script>console.log('Запись сделана сэр')</script>";
                    $updateQuery = "UPDATE `users` SET `id_record` = '$id_record' WHERE `id` = '$id_user'";
                    if ($mysqli->query($updateQuery) === TRUE) {
                        echo "<script>console.log('id_record обновлен в users')</script>";
                    } else {
                        echo "<script>console.log('Ошибка обновления id_record в users: " . $mysqli->error . "')</script>";
                    }
                } else {
                    echo "<script>console.log('Ошибка записи в rooms: " . $mysqli->error . "')</script>";
                }
            } else {
                echo "Ошибка записи данных: " . $mysqli->error;
            }
        } else {
            echo "Выберите корректную дату!!!!!!!!";
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
        $formattedDate1 = $choiceDatedate1->format('d ' . $array_of_month[$month] . ' Y г.');
        $formattedDate2 = $choiceDatedate2->format('d ' . $array_of_month[$month] . ' Y г.');
        ?>
        <div class="menu__cards">
            <div class="menu__cards-card">
                <div class="menu__card-img">
                    <?php
                    if ($choiceCity === "Москва") {
                        echo '<img src="img/city1.svg" alt="">';
                    } elseif ($choiceCity === "Казань") {
                        echo '<img src="img/city (3).svg" alt="">';
                    } elseif ($choiceCity === "Санкт-Петербург") {
                        echo '<img src="img/city (2).svg" alt="">';
                    }

                    ?>
                </div>
                <div class="menu__card-text">
                    <div class="menu__card-text-paragraph">
                        <p>гостиница “Comfort zone”</p> <br>
                        <?php

                        if ($choiceCity === "Москва") {
                            echo "<span>Москва, ул. Спирина, д. 198, стр. 4  </span> <br>";
                        }
                        if ($choiceCity === "Казань") {
                            echo "<span>Казань, ул. Октябрьская, д. 26, стр. 1 </span> <br>";
                        }
                        if ($choiceCity === "Санкт-Петербург") {
                            echo "<span>санкт-петербург, ул. Кожевническая, д. 8, стр. 3 </span> <br>";
                        }
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
                    echo '<span class="span1"> на ' . $diffirence . ' дней </span> <br>';
                    ?>


                    <span class="cost">
                        <?php

                        $coasts = $mysqli->query("SELECT * FROM typeRoom");

                        while ($row = mysqli_fetch_assoc($coasts)) {
                            // Проверяем значение id и type
                            if ($row['id'] == "$type") {
                                $coast = $row['roomCost'];
                                $total = $coast * $diffirence;
                                echo $total;
                            }

                        }
                        ?>₽
                    </span>
                </div>
            </div>
        </div>
    </main>
    <?php include("footer.php"); ?>
</body>

</html>