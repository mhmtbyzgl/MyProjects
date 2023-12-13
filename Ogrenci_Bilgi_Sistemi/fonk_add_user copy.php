<?php
require 'login_check.php';
require 'permission_check_admin.php';

if (isset($_POST['addUser'])) {
  if (!empty($_POST['nameInput']) && !empty($_POST['surnameInput']) && !empty($_POST['usernameInput']) && !empty($_POST['inputPassword1']) && !empty($_POST['inputPassword2'])) {
    if ($_POST['inputPassword1'] === $_POST['inputPassword2']) {


      $userPassword = $_POST['inputPassword1'];
      $hashedUserPassword = password_hash($userPassword, PASSWORD_ARGON2ID);

      require_once('db.php');

      $name  = $_POST['nameInput'];
      $surname  = $_POST['surnameInput'];
      $username  = $_POST['usernameInput'];
      $password = $hashedUserPassword;
      $role  = $_POST['selectedRole'];

      $sql = "INSERT INTO users (name, surname, username, password, role, created_at) VALUES (:name, :surname, :username, :password, :role, :created_at)";
      $SORGU = $DB->prepare($sql);

      $SORGU->bindParam(':name',  $name, PDO::PARAM_STR);
      $SORGU->bindParam(':surname', $surname, PDO::PARAM_STR);
      $SORGU->bindParam(':username', $username, PDO::PARAM_STR);
      $SORGU->bindParam(':role', $role, PDO::PARAM_STR);
      $SORGU->bindParam(':password', $password, PDO::PARAM_STR);
      $SORGU->bindParam(':created_at',  date("Y-m-d H:i:s"), PDO::PARAM_STR);
      $SORGU->execute();

      $m = "Kullanıcı başarıyla eklendi.";

      header("Location: user_list.php?error=$m");
      die();
    } else {

      $m = "Parolalar eşleşmiyor. Lütfen tekrar deneyiniz.";

      header("Location: add_user.php?error2=$m");
      die();
    }
  } else {
    $m = "Form alanları boş bırakılamaz.";

    header("Location: add_user.php?error2=$m");
    die();
  }
}
