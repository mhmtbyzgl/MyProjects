<?php
require 'login_check.php';
require 'permission_check_teacher.php';
require 'top_nav_side_page.php';
require 'db.php';

$id = $_GET['id'];

$SORGU = $DB->prepare("SELECT exam_score FROM exams WHERE id = :id");
$SORGU->bindParam(':id', $id, PDO::PARAM_INT);
$SORGU->execute();

$examScore = $SORGU->fetchAll(PDO::FETCH_ASSOC);

?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row">
      <h1 class="h3 mb-0 text-gray-800">Sınav Düzenleme</h1>
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
      <form method="POST" action="fonk_teacher_update_exam_score.php?id=<?= $id ?>">


        <div class="col-md-12 mb-3">
          <input type="text" class="form-control" name="examScore" value="<?= $examScore[0]['exam_score'] ?>">
        </div>
        <div class="col-md-12 mb-3 text-center">
          <button type="submit" class="btn btn-success">Güncelle</button> <a href="teacher_exams_info.php" type="button" class="btn btn-warning mr-1">Geri Dön</a>
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