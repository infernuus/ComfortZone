
  <div class="h-header">
    <div class="header-content">
      <div id="menu">
        <ul class="nav">
          <li>
            <a class="button" href="payment.php">
              оплата
            </a>
          </li>
          <li>
            <a class="button" href="question.php">
              задать вопрос
            </a>
          </li>
          <li>
            <a class="button" href="#contact-window">
              контакты
            </a>
          </li>
          <li>
            <a href="#contact-window">
              8 977 987 92 90
            </a>
          </li>
          <?php
          // Проверяем, пусты ли переменные логина и id пользователя
          if (empty($_SESSION['id'])) {
            if (empty($_SESSION['Logins']) or empty($_SESSION['id'])) {
              ?>
              <li class="SignUp">
                <a class="button" href="registr.php">войти</a>
              </li>
              <?php
            } elseif (empty($_SESSION['Emails'])) { ?>
              <li class="SignUp">
                <a class="button" href="registr.php">войти</a>
              </li>
            <?php } ?>
            <?php
          } else {
            ?>
            <li>
              <?php
              if (!empty($_SESSION['Emails'])) {
                echo '<p class="nama"> <a href="orders.php">' . $_SESSION["Emails"] . '</a></p>';
              } elseif (!empty($_SESSION['Logins'])) {
                echo '<p class="nama"> <a href="profile.php">' . $_SESSION["Logins"] . '</a></p>';
              }
              ?>

              <a href="exit.php">Выход</a>
            </li>
            <?php
          }
          ?>
        </ul>
      </div>
      <div id="contact-window" class="animate__animated animate__slideInDown">
        <div class="contact-titles">
          <h2 class="contact-title">Контактная информация</h2> <a href="#" class="close">&times;</a>
        </div>
        <div class="contact-general-info">
          <h4 class="general-title">Основные телефоны</h4>
          <p class="contact-info">Автоответчик справочной +7(945)333-31-13</p>
          <p class="contact-info-hint"> Наш бот подскажет вам по любому вопросу, используя номер базы данной, <br>
            который вы указали при регистрации.</p>
          <p class="contact-info">Единая справочная +7 (987) 94 90 </p>
          <p class="contact-info-hint">Наши консультанты помогут вам, круглосуточно.</p>
          <p class="contact-info">Служба контроля качества 8(800)222-33-44</p>
          <p class="contact-info-hint">Если у вас возникли вопросы или притензии по поводу обслуживания.</p>
        </div>
        <div class="contact-other-info">
          <h4 class="other-title">Адрес и обратная связь</h4>
          <p class="other-info">Обращения по email: sladkiymir@mail.ru</p>
          <p class="other-info">Юридический адрес: 140480, Россия, г.Коломна, ул.Советская, 12а</p>
        </div>
      </div>
    </div>
  </div>
