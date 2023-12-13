<?php
@session_start();
@session_destroy();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Siber Vatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<h1 class="alert text-center alert-success alert-dismissible fade show" style="margin-top: 50px;">Oturum sonlandı. Giriş ekranına yönlendiriliyorsunuz...</h1>
<?php
header("refresh:2;url=login.php");
die(); ?>


<?php require 'bottom_page.php'; ?>