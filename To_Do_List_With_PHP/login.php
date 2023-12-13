<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Not Listem</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<?php
@session_start();

if (isset($_SESSION['girisyapti'])) {

  header("location: index.php");
  die();
}


if (isset($_POST['kullaniciadi'])) {

  require_once('db.php');

  $sql = "SELECT * FROM kullanicilar WHERE kullaniciadi = :kullaniciadi AND parola = :parola_form";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':kullaniciadi', $_POST['kullaniciadi']);
  $SORGU->bindParam(':parola_form', $_POST['parola_form']);

  $SORGU->execute();

  $CEVAP = $SORGU->fetchAll(PDO::FETCH_ASSOC);

  if (count($CEVAP) == 1) {

    echo '
      <div class="alert text-center alert-success alert-dismissible fade show" style="margin-top: 50px;">
        Hoşgeldin ' . $CEVAP[0]['adsoyad'] . ' girişin başarı ile yapıldı. Anasayfaya yönlendiriliyorsun...
    ';

    @session_start();
    $_SESSION['girisyapti'] = 1;
    $_SESSION['adsoyad'] = $CEVAP[0]['adsoyad'];
    $_SESSION['id'] = $CEVAP[0]['id'];
    $_SESSION['kullaniciadi'] = $CEVAP[0]['kullaniciadi'];
    header("refresh:2;url=index.php");
    die();
  } else {
    echo '<h1 class="alert text-center alert-success alert-dismissible fade show" style="margin-top: 50px;" >Hatalı kullanıcı adı veya parola! <br/> Lütfen Tekrar Deneyin.</h1><div/>';
  }
}
?>





<body>

  <div class='container'>
    <div class="offset-3 col-6">

      <div class='row text-center' style="margin-top: 50px;">
        <h1 class='alert alert-primary'>GİRİŞ EKRANI</h1>
      </div>

      <form class="text-center" method="POST">
        <div class="mb-3">
          <label for="kullaniciadi" class="form-label"></label>
          <input type="text" name='kullaniciadi' class="form-control" id="kullaniciadi" aria-describedby="emailHelp" placeholder="Kullanıcı Adı">
        </div>
        <div class="mb-3">
          <label for="parola" class="form-label"></label>
          <input type="password" name='parola_form' class="form-control" id="parola" placeholder="Parola">
        </div>
        <button type="submit" class="btn btn-primary">GİRİŞ</button>
        <a href="register.php" type="submit" class="btn btn-primary">Kayıt Ol</a>
      </form>

    </div>

    <?php require 'sayfa_alt.php'; ?>