<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <meta charset="utf-8">
  
  <link rel="stylesheet" href="style.scss">

</head>

<body>
  <main class="menu-maine">
    <div class="ahah">
      <button class="reg-av-button2"
        onclick="(document.getElementById('cl2').style.display=='none') ? console.log('Определённый контент уже скрыт') : document.getElementById('cl2').style.display='none'; document.getElementById('cl1').style.display=''">Создать</button>
      <button class="reg-av-button"
        onclick="(document.getElementById('cl1').style.display=='none') ? console.log('Определённый контент уже скрыт') : document.getElementById('cl1').style.display='none'; document.getElementById('cl2').style.display=''">Войти</button>
    </div>
    <div id="cl1">

      <form class="form-label" action="registr.php" method="post">
        <p>
          <input class="input-label" name="Names" type="text" size="15" maxlength="15" placeholder="ИМЯ" required>
        </p>
        <p>
          <input class="input-label" name="Surname" type="text" size="15" maxlength="15" placeholder="ФАМИЛИЯ" required>
        </p>
        <p>
          <input class="input-label" name="Email" type="email"  placeholder="E-mail" required>
        </p>
        <p>
          <input class="input-label" name="Phone" type="phone" size="15" maxlength="15" placeholder="Телефон" required>
        </p>
        <p>
          <input class="input-label" name="Logins" type="text" size="15" maxlength="15" placeholder="ЛОГИН" required>
        </p>
        <p>
          <input class="input-label" name="Pass" type="password" size="15" maxlength="15" minlength="8"
            placeholder="ПАРОЛЬ" required>
        </p>
        <p>
          <input class="input-label" type="submit" name="submit-reg" value="Зарегистрироваться">
        </p>
      </form>
    </div>
    <!--  -->
    <div id="cl2" style="display:none">
      <form class="form-label" action="registr.php" method="post">
        <p>
          <input class="input-label" name="Logins" type="text" size="15" maxlength="15" placeholder="ЛОГИН">
        </p>
        <p>
          <input class="input-label" name="Pass" type="password" size="15" maxlength="15" placeholder="ПАРОЛЬ">
        </p>
        <p>
          <input class="input-label" type="submit" name="submit-auth" value="Войти">
        </p>
      </form>
    </div>
    <form class="form-label" action="registr.php" method="post">
      <br>
      <label>Вход в кабинет администратора</label>
      <br>
      <p>
        <input class="input-label" name="Emails" type="email" size="20" maxlength="20" placeholder="ПОЧТА">
      </p>
      <p>
        <input class="input-label" name="Pass" type="password" size="20" maxlength="20" placeholder="ПАРОЛЬ">
      </p>
      <p>
        <input class="input-label" type="submit" name="submit-admin" value="Войти">
      </p>
    </form>

  </main>
</body>
<?php
session_start();
include("dbconnect.php");

if (isset($_POST['submit-reg'])) {
  $Names = $_POST['Names'];
  $Surname = $_POST['Surname'];
  $Email = $_POST['Email'];
  $Phone = $_POST['Phone'];
  $Logins = $_POST['Logins'];
  $Pass = $_POST['Pass'];
  $id_record = 1;
  if (empty($Logins) || empty($Pass)) {
    exit("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
  }



  $result1 = $mysqli->query("INSERT INTO users (Names, Surname, Email, Phone, Logins, Pass, id_record) VALUES('$Names','$Surname','$Email','$Phone','$Logins','$Pass', '$id_record')");
  if ($result1 === TRUE) {
    echo "<script>alert('Вы успешно зарегистрированы! Теперь вы можете зайти на сайт под своим именем.')</script>";
    echo "<script> 
    (document.getElementById('cl1').style.display=='none') ? console.log('Определённый контент уже скрыт') : document.getElementById('cl1').style.display='none'; document.getElementById('cl2').style.display='' </script>";
  } else {
    echo "Ошибка! Вы не зарегистрированы.";
  }

} elseif (isset($_POST['submit-auth'])) {

  // Авторизация
  $Logins = $_POST['Logins'];
  $Pass = $_POST['Pass'];

  if (empty($Logins) || empty($Pass)) {
    exit("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
  }

  $result2 = $mysqli->query("SELECT ID, Logins, Pass FROM users WHERE Logins = '$Logins'");
  $myrow = $result2->fetch_assoc(); // Исправлено на $result2

  if (empty($myrow['Logins'])) {
    exit("Введенный вами login или пароль неверный.");
  } else {
    if ($myrow['Pass'] == $Pass) {
      $_SESSION['Logins'] = $myrow['Logins'];
      $_SESSION['id'] = $myrow['ID'];
      echo "<script>alert('Вы успешно вошли на сайт! Переход на главную страницу...');</script>";
      header("Refresh:1; url=index.php");
    } else {
      exit("Введенный вами login или пароль неверный.");
    }
  }

} elseif (isset($_POST['submit-admin'])) {
  if (isset($_POST['Emails'])) {
    $Emails = $_POST['Emails'];
  }
  if (isset($_POST['Pass'])) {
    $Pass = $_POST['Pass'];
  }

  if (empty($Emails) || empty($Pass)) {
    exit("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
  }

  include("dbconnect.php");

  $result = $mysqli->query("SELECT ID, Emails, Pass FROM admins WHERE Emails = '$Emails'");
  $myrow = $result->fetch_assoc();

  if (empty($myrow['Emails'])) {
    exit("Введенный вами имя или пароль неверный.");
  } else {
    if ($myrow['Pass'] == $Pass) {
      $_SESSION['Emails'] = $myrow['Emails'];
      $_SESSION['id'] = $myrow['ID'];
      echo 'Здравствуйте, администратор ' . $Emails . ', вы можете перейти к заказам! 
            <a href="orders.php">Если не произошёл автоматический перенос, нажмите здесь</a>';
      header("Refresh:1; url=orders.php");
      exit;
    } else {
      exit("Введенный вами имя или пароль неверный.");
    }
  }
}

?>

</html>
<?php include('footer.php') ?>