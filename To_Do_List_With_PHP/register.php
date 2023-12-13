<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Not Listem</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<div class='row text-center offset-3 col-6'>
  <h1 class='alert alert-primary'>Yeni Kullanıcı Oluştur</h1>
</div>

<?php

if (isset($_POST['adsoyad_form'])) {

  require_once('db.php');

  $adsoyad  = $_POST['adsoyad_form'];
  $kullaniciadi = $_POST['kullaniciadi_form'];
  $eposta = $_POST['eposta_form'];
  $parola = $_POST['parola_form'];

  $sql = "INSERT INTO kullanicilar (adsoyad, kullaniciadi, eposta, parola) VALUES (:adsoyad_form, :kullaniciadi_form, :eposta_form, :parola_form)";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':adsoyad_form',  $adsoyad);
  $SORGU->bindParam(':kullaniciadi_form',  $kullaniciadi);
  $SORGU->bindParam(':eposta_form', $eposta);
  $SORGU->bindParam(':parola_form', $parola);

  $SORGU->execute();
  echo '
      <div class="alert text-center alert-success alert-dismissible fade show">
        Kullanıcı eklendi. Giriş ekranına yönlendiriliyorsunuz...
    ';
  header("refresh:2;url=index.php");
  die();
}
?>
<div class='container'>
  <div class="offset-3 col-6">

    <form class="text-center" method="POST">
      <div class="mb-3">
        <label for="adsoyad" class="form-label"></label>
        <input type="text" name='adsoyad_form' class="form-control" id="adsoyad" placeholder="Ad Soyad">
      </div>
      <div class="mb-3">
        <label for="kullaniciadi" class="form-label"></label>
        <input type="text" name='kullaniciadi_form' class="form-control" id="kullaniciadi" placeholder="Kullanıcı Adı">
      </div>
      <div class="mb-3">
        <label for="eposta" class="form-label"></label>
        <input type="email" name='eposta_form' class="form-control" id="eposta" aria-describedby="emailHelp" placeholder="E-Posta">
      </div>
      <div class="mb-3">
        <label for="parola" class="form-label"></label>
        <input type="password" name='parola_form' class="form-control" id="parola" placeholder="Parola">
      </div>
      <button type="submit" class="btn btn-primary">Kaydet</button>
    </form>


    <div class='text-center' style="margin-top: 10px;">
      <a href='login.php' class='btn btn-warning'>Giriş Ekranına Dön</a>
    </div>

  </div>

  <?php require 'sayfa_alt.php'; ?>