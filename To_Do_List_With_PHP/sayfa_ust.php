<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Not Listem</title>
  <link rel="shortcut icon" href="assets/img/icon/favicon.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<?php
session_start();
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary rounded-pill">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php" style="color: purple;"><?php echo $_SESSION['kullaniciadi'] . " Kullanıcısının Notları"; ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php" style="color: purple;">Anasayfa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dosyalar.php" style="color: purple;">Dosyalar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dosya_yukleme.php" style="color: purple;">Dosya Yükleme</a>
        </li>
      </ul>
    </div>
    <ul class="nav justify-content-end">
      <li class="nav-item">
        <!-- <a class="nav-link disabled" aria-disabled="true">Kullanıcı: <?php session_start();
                                                                          echo $_SESSION['kullaniciadi']; ?></a> -->
      </li>
      <li class="nav-item">
        <a class="btn btn-outline-danger rounded-pill" href="logout.php">Oturumu Kapat</a>
      </li>
    </ul>
  </div>
</nav>