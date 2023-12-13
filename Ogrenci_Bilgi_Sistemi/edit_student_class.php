<?php
require 'login_check.php';
require 'permission_check_admin.php';
require 'top_nav_side_page.php';
require 'db.php';



$id = $_GET['id'];

$SORGU = $DB->prepare("SELECT id, class_name FROM classes");
$SORGU->execute();
$classes = $SORGU->fetchAll(PDO::FETCH_ASSOC);

$SORGU_2 = $DB->prepare("SELECT class_name FROM classes WHERE id = :id");
$SORGU_2->bindParam(':id',  $id, PDO::PARAM_INT);
$SORGU_2->execute();
$selectedClass = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);

?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row">
      <h1 class="h3 mb-0 text-gray-800">Öğrencinin Sınıfını Düzenleme</h1>
      <p id="autoHideP">
        <?php if (isset($_GET['error'])) { ?>
      <div class="alert alert-danger d-flex justify-content-center align-items-center ml-5" role="alert">
        <?= $_GET['error'] ?>
      </div>
    <?php } ?>
    </div>
  </div>


  <div class="container">
    <div class="row justify-content-center">
      <form method="POST" action="fonk_edit_student_class.php?id=<?= $id ?>">


        <div class="col-md-12 mb-3 text-center">
          <span>Sınıf Seçiniz:</span>
          <select class="form-select ml-2 mb-3" aria-label="Default select example" name="selectedClass">
            <option value="0"><?= $selectedClass[0]['class_name'] ?></option>
            <?php
            foreach ($classes as $class) {
              echo "
            <option value='{$class['id']}'> {$class['class_name']}</option>


          ";
            }
            ?>
          </select>
        </div>
        <!-- <div class="col-md-12 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
        <div class="col-md-12 mb-3 text-center">
          <button type="submit" class="btn btn-success">Güncelle</button> <a href="students_info.php" type="button" class="btn btn-warning mr-1">Geri Dön</a>
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