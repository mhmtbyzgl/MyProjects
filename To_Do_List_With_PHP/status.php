<?php
require 'sayfa_ust.php';
require 'login_kontrol.php';
require_once('db.php');




if (isset($_GET['id'])) {

  $status  = 'true';
  $id    = $_GET['id'];

  $sql = "UPDATE nottab SET status = :status WHERE id = :id";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':status',  $status);
  $SORGU->bindParam(':id',    $id);


  if ($SORGU->execute()) {

    echo '<div class="alert text-center alert-success alert-dismissible fade show">
            Not yapıldı olarak işaretlendi. Anasayfaya yönlendiriliyorsunuz...';
    header("refresh:2;url=index.php");
    die();
  }
}
