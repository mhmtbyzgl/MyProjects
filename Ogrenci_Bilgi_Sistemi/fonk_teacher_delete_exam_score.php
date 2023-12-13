<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Siber Vatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<?php
require 'login_check.php';
require 'permission_check_teacher.php';
require_once('db.php');


if (isset($_POST['deleteSumbit'])) {
  if (isset($_POST['silmeOnayi']) && $_POST['silmeOnayi'] === 'Evet') {
    $id = $_GET['id'];


    $sql = "DELETE FROM exams WHERE id = :id";
    $SORGU = $DB->prepare($sql);
    $SORGU->bindParam(':id', $id, PDO::PARAM_INT);




    if ($SORGU->execute()) {

      echo '<div class="alert text-center alert-success alert-dismissible fade show">
            Sınav Notu Silindi..';
      header("refresh:2;url=teacher_exams_info.php");
      die();
    }
  } else {
    echo '<div>
          <p class="alert text-center" style="background-color:yellow; color:red; margin-top: 10px; ">Silmek için onay kutusunu işaretlemeniz gerekmektedir.</p>';
  }
}
?>

<div class="container text-center">
  <div class="row">

    <div class="col-md-6 mx-auto text-center" style="background-color: #d2fafb;
    margin: 100px auto 20px;
    padding: 40px 30px 50px;
    border-radius: 20px;">


      <form method="POST">
        <label for="silmeKutucugu" style="background-color: red; font-size: 40px">Silmek istediğinize emin misiniz?</label><br /><br /><br />
        <label for="silmeKutucugu">Silme işlemine devam etmek için aşağıdaki kutucuğu işaretleyip silme işlemini onaylamanız ve ardından "Sil" butonuna basmanız gerekmektedir..</label><br /><br /><br />
        <label>Silme işlemini onaylıyorum.</label>
        <input type="checkbox" id="silmeKutucugu" name="silmeOnayi" value="Evet"><br />
        <input name="deleteSumbit" class="btn btn-danger" type="submit" value="Sil">
        <a href="teacher_exams_info.php" class="btn btn-warning">Geri Dön</a>
      </form>
    </div>
  </div>
</div>

<?php require 'bottom_page.php'; ?>