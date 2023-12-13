<?php
require 'login_check.php';
require 'permission_check_admin.php';
require 'top_nav_side_page.php';
require 'db.php';



$id = $_GET['id'];

$SORGU = $DB->prepare("SELECT name, surname, username, role FROM users WHERE id = :id");
$SORGU->bindParam(':id', $id, PDO::PARAM_INT);
$SORGU->execute();
$user = $SORGU->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row">
      <h1 class="h3 mb-0 text-gray-800">Öğrenci Düzenleme</h1>
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
      <form action="fonk_update_user.php?id=<?= $id ?>" method="POST">


        <div class="col-md-12 mb-3">
          <input type="text" class="form-control" name="nameInput" value="<?= $user[0]['name'] ?>">
        </div>
        <div class="col-md-12 mb-3">
          <input type="text" class="form-control" name="surnameInput" value="<?= $user[0]['surname'] ?>">
        </div>
        <div class="col-md-12 mb-3">
          <input type="text" class="form-control" name="usernameInput" value="<?= $user[0]['username'] ?>">
        </div>

        <div class="col-md-12 mb-3 text-center">
          <span>Rol:</span>
          <select class="form-select ml-2 mb-3" aria-label="Default select example" name="selectedRole">
            <option value="Admin" <?= $user[0]['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
            <option value="Teacher" <?= $user[0]['role'] == 'Teacher' ? 'selected' : '' ?>>Teacher</option>
            <option value="Student" <?= $user[0]['role'] == 'Student' ? 'selected' : '' ?>>Student</option>
          </select>
          <div class="col-md-12 mb-3">
            <label>Change Password</label>
            <input type="password" class="form-control mb-3" name="inputPassword1" placeholder="Parola">
            <input type="password" class="form-control mb-3" name="inputPassword2" placeholder="Parolayı Tekrar Girin...">
          </div>

        </div>
        <div class="col-md-12 mb-3 text-center">
          <button name="updateUser" type="submit" class="btn btn-warning">Güncelle</button> <a href="user_list.php" type="button" class="btn btn-success mr-1">Geri Dön</a>
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