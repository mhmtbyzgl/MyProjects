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

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Siber Vatan</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="./css/style.css">



  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>


<body class="bg-gradient-primary">

  <div class="container">
    <div class="SiberVatanImg">
      <img class="w3-animate-top" id="SiberVatanImg" src="./img/SiberVatan.png" style="  width: 500px; border-radius: 30px;">
    </div>

    <!-- Outer Row -->
    <div class="row justify-content-center ">
      <div class="row text-center">
        <?php if (isset($_GET['error2'])) { ?>
          <div class="alert alert-danger d-flex justify-content-center align-items-center text-center ml-5 mt-2" role="alert">
            <?= $_GET['error2'] ?>
          </div>
        <?php } ?>
      </div>
      <div class="col-xl-10 col-lg-12 col-md-9" style="display: flex; justify-content: center; align-items: center; height: 72vh;">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image">
                </div> -->
              <div class="col-lg-6 d-none d-lg-block ">
                <img src="./img/yavuzlar.png" style=" width: 100%; height: 100%; object-fit: cover; object-position: center;" alt="">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h1 text-gray-900 mb-4">Hoşgeldiniz</h1>

                  </div>
                  <form class="user" action="fonk_login.php" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="inputUsername" placeholder="Kullanıcı Adı... ">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="inputPassword" placeholder="Parola...">
                    </div>

                    <button class="btn btn-primary btn-user btn-block" type="submit">
                      Giriş Yap
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php
  require 'footer.php';
  require 'bottom_page.php';
  ?>