<?php
@session_start();

if (isset($_SESSION['loggedIn'])) {

  if ($_SESSION['role'] === 'Admin') {

    header("location: admin_page.php");
  } elseif ($_SESSION['role'] === 'Teacher') {

    header("location: teacher_page.php");
  } elseif ($_SESSION['role'] === 'Student') {

    header("location: student_page.php");
  }
  die();
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Siber Vatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<?php

if (!empty($_POST['inputUsername']) && !empty($_POST['inputPassword'])) {
  require_once('db.php');

  $username = $_POST['inputUsername'];
  $password = $_POST['inputPassword'];


  $SORGU = $DB->prepare("SELECT username, password FROM users WHERE username = :username");
  $SORGU->bindParam(':username', $username, PDO::PARAM_STR);
  $SORGU->execute();

  $login = $SORGU->fetchAll(PDO::FETCH_ASSOC);

  if (count($login) > 0) {
    $storedPassword = $login[0]['password'];

    if (password_verify($password, $storedPassword)) {

      $SORGU_2 = $DB->prepare("SELECT name, surname FROM users WHERE username = :username");
      $SORGU_2->bindParam(':username', $username, PDO::PARAM_STR);
      $SORGU_2->execute();
      $loginUser = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);

      echo '
<div class="alert text-center alert-success alert-dismissible fade show" style="margin-top: 50px;">
  Hoşgeldin ' . $loginUser[0]['name'] . " " . $loginUser[0]['surname'] . ' girişin başarı ile yapıldı. Anasayfaya yönlendiriliyorsun...
  ';

      $SORGU_2 = $DB->prepare("SELECT id, name, surname, username, role FROM users WHERE username = :username");
      $SORGU_2->bindParam(':username', $username, PDO::PARAM_STR);
      $SORGU_2->execute();
      $sessionUser = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);

      @session_start();
      $_SESSION['loggedIn'] = 1;
      $_SESSION['id'] = $sessionUser[0]['id'];
      $_SESSION['name'] = $sessionUser[0]['name'];
      $_SESSION['surname'] = $sessionUser[0]['surname'];
      $_SESSION['username'] = $sessionUser[0]['username'];
      $_SESSION['role'] = $sessionUser[0]['role'];

      if ($_SESSION['role'] === 'Admin') {

        header("refresh:2;url=admin_page.php");
      } elseif ($_SESSION['role'] === 'Teacher') {

        header("refresh:2;url=teacher_page.php");
      } elseif ($_SESSION['role'] === 'Student') {

        header("refresh:2;url=student_page.php");
      }
      die();
    } else {
      $m = "Hatalı kullanıcı adı veya parola! <br /> Lütfen Tekrar Deneyin.";
      header("Location: login.php?error2=$m");
      die();
    }
  } else {
    $m = "Hatalı kullanıcı adı veya parola! <br /> Lütfen Tekrar Deneyin.";
    header("Location: login.php?error2=$m");
    die();
  }
} else {
  $m = "Formlar boş bırakılamaz. Lütfen formları doldurunuz.";
  header("Location: login.php?error2=$m");
  die();
}
