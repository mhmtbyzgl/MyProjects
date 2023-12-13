<?php
require 'login_check.php';
require 'permission_check_admin.php';
require_once('db.php');


if (isset($_POST['updateUser'])) {

  if (!empty($_POST['nameInput']) && !empty($_POST['surnameInput']) && !empty($_POST['usernameInput'])) {

    if (!empty($_POST['inputPassword1']) && !empty($_POST['inputPassword2'])) {

      if ($_POST['inputPassword1'] === $_POST['inputPassword2']) {


        $name  = $_POST['nameInput'];
        $surname  = $_POST['surnameInput'];
        $username  = $_POST['usernameInput'];
        $userPassword = $_POST['inputPassword1'];
        $role  = $_POST['selectedRole'];
        $id = $_GET['id'];

        $hashedUserPassword = password_hash($userPassword, PASSWORD_ARGON2ID);
        $password = $hashedUserPassword;

        $sql = "UPDATE users SET name = :name, surname = :surname, username = :username, password = :password, role = :role, created_at = :created_at WHERE id = :id";
        $SORGU = $DB->prepare($sql);

        $SORGU->bindParam(':name',  $name, PDO::PARAM_STR);
        $SORGU->bindParam(':surname', $surname, PDO::PARAM_STR);
        $SORGU->bindParam(':username', $username, PDO::PARAM_STR);
        $SORGU->bindParam(':role', $role, PDO::PARAM_STR);
        $SORGU->bindParam(':password', $password, PDO::PARAM_STR);
        $SORGU->bindParam(':created_at',  date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $SORGU->bindParam(':id',  $id, PDO::PARAM_INT);
        $SORGU->execute();
      } else {
        $m = "Parolalar eşleşmiyor. Lütfen tekrar deneyiniz.";
        header("Location: user_list.php?error2=$m");
        die();
      }
    } else {
      $name  = $_POST['nameInput'];
      $surname  = $_POST['surnameInput'];
      $username  = $_POST['usernameInput'];
      $role  = $_POST['selectedRole'];
      $id = $_GET['id'];

      $sql = "UPDATE users SET name = :name, surname = :surname, username = :username, role = :role, created_at = :created_at WHERE id = :id";
      $SORGU = $DB->prepare($sql);

      $SORGU->bindParam(':name',  $name, PDO::PARAM_STR);
      $SORGU->bindParam(':surname', $surname, PDO::PARAM_STR);
      $SORGU->bindParam(':username', $username, PDO::PARAM_STR);
      $SORGU->bindParam(':role', $role, PDO::PARAM_STR);
      $SORGU->bindParam(':created_at',  date("Y-m-d H:i:s"), PDO::PARAM_STR);
      $SORGU->bindParam(':id',  $id, PDO::PARAM_INT);
      $SORGU->execute();
    }








    $m = "Öğrenci başarıyla güncellendi.";
    header("Location: user_list.php?error=$m");
    die();
  } else {
    $m = "Form alanları boş bırakılamaz.";
    header("Location: user_list.php?error2=$m");
    die();
  }
}
