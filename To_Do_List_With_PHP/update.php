<?php
require 'sayfa_ust.php';
require 'login_kontrol.php';

require_once('db.php');

if (isset($_POST['note_form'])) {

  $notlar  = $_POST['note_form'];
  $id    = $_GET['id'];

  $sql = "UPDATE nottab SET notlar = :note_form, nottarihi = :nottarihi WHERE id = :id";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':note_form',  $notlar);
  $SORGU->bindParam(':nottarihi', date("Y-m-d H:i:s"));
  $SORGU->bindParam(':id',    $id);

  $SORGU->execute();
  echo '<div class="alert text-center alert-success alert-dismissible fade show" ;>
        Notunuz güncellendi. Anasayfaya yönlendiriliyorsunuz.';
  header("refresh:2;url=index.php");
  die();
}

$id    = $_GET['id'];

$sql = "SELECT * FROM nottab WHERE id = :id";
$SORGU = $DB->prepare($sql);

$SORGU->bindParam(':id', $id);

$SORGU->execute();

$nottab = $SORGU->fetchAll(PDO::FETCH_ASSOC);

?>


<div class='container'>
  <div class="offset-3 col-6">

    <div class='row text-center'>
      <h1 class='alert alert-info' style="margin-top: 10px;">Not Güncelleme</h1>
    </div>

    <form method="POST">
      <div class="mb-3">
        <label for="notlar" class="form-label">Yeni Notunuzu Giriniz.</label>
        <input type="text" name='note_form' class="form-control" id="notlar" aria-describedby="emailHelp">
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Güncelle</button>
        <a href='index.php' class='btn btn-warning'>Geri Dön</a>
      </div>
    </form>

  </div>

  <?php require 'sayfa_alt.php'; ?>