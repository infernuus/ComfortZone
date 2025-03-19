<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width = device-width,
initial-scale = 1, shrink-to-fit = no">
  <!-- Стиль bootstrap -->

  <!-- Собственный стиль -->
  <link rel="stylesheet" href="style.css">
  <title>Сладкий мир</title>
</head>

<body>
  <div class="h-header">
    <div class="header-content">
      <div id="menu">
        <a class="button icon" href="index.php"><img class="icon" src="img/icon.png" alt="">
        </a>
        <ul class="nav">
          <li>
            <a class="button"  href="menu_edit.php">
              ИЗМЕНЕНИЕ СОСТАВА МЕНЮ
            </a>
          </li>
          <li>
            <a class="button"  href="orders.php">
              ЗАКАЗЫ
            </a>
          </li>
          <?php
          session_start();
          // Проверяем, пусты ли переменные логина и id пользователя
          if (empty($_SESSION["Emails"])) {
            
            ?>
            <li class="SignUp">
              <a class="button" href="registr.php">SIGN UP</a>
            </li>
            <?php
          } else {
            ?>
            <li>
              <?php
            echo '<p class="nama"> Администратор '.$_SESSION['Emails']. ', здравствуйте!</p>';
              ?>

              <a href="exit.php">Выход</a>
            </li>
            <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </div>

</body>

</html>