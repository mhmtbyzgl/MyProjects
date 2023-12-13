<?php
require 'login_check.php';
require 'permission_check_admin.php';
require 'top_nav_side_page.php';
require 'db.php';

$SORGU = $DB->prepare("SELECT id, name, surname FROM users WHERE role = 'Teacher'");
$SORGU->execute();
$teachers = $SORGU->fetchAll(PDO::FETCH_ASSOC);

?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row">
      <h1 class="h3 mb-0 text-gray-800">Sınıf Ekleme</h1>
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
      <form method="POST" action="fonk_add_class.php">


        <div class="col-md-12 mb-3">
          <input type="text" class="form-control" name="className" placeholder="Sınıf Adı">
        </div>
        <div class="col-md-12 mb-3 text-center">
          <span>Sınıfın Sorumlusu:</span>
          <select class="form-select ml-2 mb-3" aria-label="Default select example" name="selectedTeacher">
            <option value="0">Seçiniz</option>
            <?php
            foreach ($teachers as $teacher) {
              echo "
            <option value='{$teacher['id']}'> {$teacher['name']} {$teacher['surname']}</option>


          ";
            }
            ?>
          </select>
        </div>
        <div class="col-md-12 mb-3 text-center">
          <button type="submit" class="btn btn-success">Ekle</button> <a href="classes_info.php" type="button" class="btn btn-warning mr-1">Geri Dön</a>
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