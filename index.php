<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.scss">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Lemon&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Martian+Mono:wdth,wght@75..112.5,100..800&display=swap"
    rel="stylesheet">
  <title>Document</title>
</head>

<body>
  <div class="mains">
    <div class="presentation">
      <?php
      session_start();
      include('nav.php');
      include("dbconnect.php");
      ?>
      <div class="slides">
        <div class="slides__text-section">
          <h class="slides__headline1">
            comfort zone
          </h>
          <p class="slides__paragraph">
            сеть современных гостиниц
          </p>
          <h class="slides__headline2">
            comfort zone
          </h>
        </div>

        <div class="slides__hotel-kurort">
          <div class="slides__hotel-kurort-but">
            <button class="button-hotel">
              Отели и курорты
            </button>
          </div>
          <form action="menu.php" method="post">
            <div class="slides__hotel-kurort-inner">
              <div class="slides__hotel-section">
                <div class="hotel__section-button">
                  <!--  -->
                  <select name="city" id="" required>
                    <option value="">
                      Выберете город
                    </option>
                    <option value="Москва">
                      г.Москва
                    </option>
                    <option value="Казань">
                      г.Казань
                    </option>
                    <option value="Санкт-Петербург">
                      г.Санкт-Петербург
                    </option>
                  </select>
                </div>
              </div>
              <div class="slides__hotel-section">
                <div class="hotel__section-selection">
                  <div class="selection-income">
                    <input name="date1" type="date" placeholder="date" required>
                  </div>
                </div>
                <div class="selection-outcome">
                  <input name="date2" type="date" placeholder="date" required>
                </div>
              </div>
              <div class="slides__select-room">
                <div class="selection-room">
                  <select class="slides__select" name="selection" id="" required>
                    <option id="1" value="">Тип номера</option>
                    <option id="2" value="1">Стандарт</option>
                    <option id="3" value="2">Люкс</option>
                    <option id="3" value="3">Премиум</option>
                    <option id="3" value="4">Эконом</option>
                  </select>
                </div>
              </div>
              <div class="slides__input">
                <div class="slides__input-button">
                  <?php
                  if (!empty($_SESSION['id'])) {
                    echo '<input class="submit-but" type="submit" value="Найти!">';
                  }
                  echo '</form>';
                  if (empty($_SESSION['id'])) {
                    echo '<form action="registr.php"><input class="submit-but" type="submit" value="Отправить"></form>';
                  }
                  ?>
                </div>
              </div>

            </div>
          </form>
          <?php

          ?>

        </div>

      </div>


    </div>
    <div class="pres">


      <div class="text">
        <h class="headline">
          гостиницы
        </h>
        <h class="headline-2">
          наши гостинцы расположены в 3 культурных столицах страны, а именно, в таких городах, как:
        </h>
      </div>
      <div class="cards">
        <div class="cards__inner">
          <div class="card">
            <img src="img/city1.svg" alt="">
            <h class="headline1">москва</h>
            <p class="paragraph1">
              Современные номера с панорамными окнами предлагают комфорт и стиль. Гостям доступны ресторан с
              разнообразным
              меню и фитнес-центр
            </p>
          </div>
          <div class="card">
            <img src="img/city (3).svg" alt="">
            <h class="headline1">казань</h>
            <p class="paragraph1">
              Номера оформлены в традиционном татарском стиле. Гостям предлагаются услуги ресторана с национальной
              кухней.
            </p>
          </div>
          <div class="card">
            <img src="img/city (2).svg" alt="">
            <h class="headline1">санкт-петербург</h>
            <p class="paragraph1">
              Уютные номера с современным дизайном обеспечивают гостям комфортный отдых. В гостинице есть кафе, где
              подают
              завтраки и легкие закуски.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="main">
      <div class="text">
        <h class="headline1">гостиничные номера</h>
      </div>
      <div class="main__numbers-cards">
        <div class="main__numbers-card">
          <img src="img/room (1).svg" alt="">
          <h class="headline">премиум</h>
        </div>
        <div class="main__numbers-card">
          <img src="img/room (2).svg" alt="">
          <h class="headline">люкс</h>
        </div>
        <div class="main__numbers-card">
          <img src="img/room (3).svg" alt="">
          <h class="headline">стандарт</h>
        </div>
        <div class="main__numbers-card">
          <img src="img/room (4).svg" alt="">
          <h class="headline">эконом</h>
        </div>
      </div>
    </div>
  </div>
  <div class="main">

    <?php
    //подключаем файл для подвала
    include('footer.php');
    ?>
  </div>
</body>

</html>