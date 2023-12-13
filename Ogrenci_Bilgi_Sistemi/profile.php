<?php
require 'login_check.php';
require 'top_nav_side_page.php';
require 'db.php';
@session_start();



$id = $_GET['id'];

?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row">
      <h1 class="h3 mb-0 text-gray-800">Profil Sayfası</h1>
      <p id="autoHideP">
        <?php if (isset($_GET['error'])) { ?>
      <div class="alert alert-success d-flex justify-content-center align-items-center ml-5" role="alert">
        <?= $_GET['error'] ?>
      </div>
    <?php } ?>
    <?php if (isset($_GET['error2'])) { ?>
      <div class="alert alert-danger d-flex justify-content-center align-items-center ml-5" role="alert">
        <?= $_GET['error2'] ?>
      </div>
    <?php } ?>
    </div>
  </div>


  <div class="container">
    <div class="row justify-content-center">
      <form action="fonk_profile_update_password.php?id=<?= $_SESSION['id'] ?>" method="POST">



        <div class="col-md-12 mb-3 text-center">
          <label>İsim: <strong><?= $_SESSION['name'] ?></strong></label>
        </div>
        <div class="col-md-12 mb-3 text-center">
          <label>Soyisim: <strong><?= $_SESSION['surname'] ?></strong></label>
        </div>
        <div class="col-md-12 mb-3 text-center">
          <label>Kullanıcı Adı: <strong><?= $_SESSION['username'] ?></strong></label>
        </div>

        <hr>

        <div class="col-md-12 mb-3 text-center">

          <div class="col-md-12 mb-3">
            <label>Parola Güncelleme</label>
            <input type="password" class="form-control mb-3" name="inputPasswordOld" placeholder="Mevcut Parolanızı Giriniz.">
            <input type="password" class="form-control mb-3" name="inputPassword1" placeholder="Yeni Parolanızı Giriniz.">
            <input type="password" class="form-control mb-3" name="inputPassword2" placeholder="Yeni Parolanızı Tekrar Giriniz.">
          </div>

        </div>
        <div class="col-md-12 mb-3 text-center">
          <button name="profileUpdatePassword" type="submit" class="btn btn-warning">Güncelle</button>
        </div>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php require 'footer.php' ?>

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>



<?php
require 'logout_modal.php';
require 'bottom_page.php' ?>