<?php
require 'login_check.php';
// require 'permission_check_admin.php';

if (isset($_POST['profileUpdatePassword'])) {
  if (!empty($_POST['inputPasswordOld']) && !empty($_POST['inputPassword1']) && !empty($_POST['inputPassword2'])) {
    require_once('db.php');

    $id = $_GET['id'];
    $inputPasswordOld = $_POST['inputPasswordOld'];

    $SORGU = $DB->prepare("SELECT password FROM users WHERE id= :id");
    $SORGU->bindParam(':id', $id, PDO::PARAM_INT);
    $SORGU->execute();

    $passwordOld = $SORGU->fetchAll(PDO::FETCH_ASSOC);

    if (count($passwordOld) > 0) {

      $storedPassword = $passwordOld[0]['password'];

      if (password_verify($inputPasswordOld, $storedPassword)) {

        if ($_POST['inputPassword1'] === $_POST['inputPassword2']) {

          $newPassword = $_POST['inputPassword1'];
          $hashedUserNewPassword = password_hash($newPassword, PASSWORD_ARGON2ID);



          $password = $hashedUserNewPassword;


          $sql = "UPDATE users SET password = :password WHERE id = :id";
          $SORGU_2 = $DB->prepare($sql);


          $SORGU_2->bindParam(':id', $id, PDO::PARAM_INT);
          $SORGU_2->bindParam(':password', $password, PDO::PARAM_STR);
          $SORGU_2->execute();

          $m = "Parola başarıyla güncellendi.";

          header("Location: profile.php?error=$m");
          die();
        } else {

          $m = "Yeni parolalarınız eşleşmiyor. Lütfen tekrar deneyiniz.";

          header("Location: profile.php?error2=$m");
          die();
        }
      } else {
        $m = "Mevcut parolanız doğru değil. Lütfen tekrar deneyin.";

        header("Location: profile.php?error2=$m");
        die();
      }
    } else {
      $m = "Eşleşen sonuç bulunamadı.";

      header("Location: profile.php?error2=$m");
      die();
    }
  } else {
    $m = "Form alanları boş bırakılamaz.";

    header("Location: profile.php?error2=$m");
    die();
  }
}
