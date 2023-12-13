<?php
require 'login_check.php';
require 'permission_check_student.php';
require 'top_nav_side_page.php';
require_once('db.php');
@session_start();
$studentUserId = $_SESSION['id'];


?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row">
      <!-- <h1 class="h3 mb-0 text-gray-800">Sınıf</h1> -->
      <p id="autoHideP">
        <?php if (isset($_GET['error'])) { ?>
      <div class="alert alert-success d-flex justify-content-center align-items-center ml-5" role="alert">
        <?= $_GET['error'] ?>
      </div>
    <?php } ?>
    </p>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Sınıf Adı</th>
              <th>Başarı Ortalaması</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $SORGU = $DB->prepare("SELECT
    C.class_name, (SELECT AVG(exam_score) FROM exams WHERE student_id = :student_id AND class_id = C.id) AS class_average FROM classes_students CS JOIN classes C ON CS.class_id = C.id WHERE CS.student_id =  :student_id;");
            $SORGU->bindParam(':student_id', $studentUserId, PDO::PARAM_INT);
            $SORGU->execute();
            $classes = $SORGU->fetchAll(PDO::FETCH_ASSOC);
            foreach ($classes as $class) {
            }
            echo "
              <tr>
                <td>{$class['class_name']}</td>
                <th>" . number_format($class['class_average'], 2) . "</th>
          </tr>
              ";
            ?>
          </tbody>
        </table>
      </div>
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
<script src="./js/script.js"></script>

<?php
require 'logout_modal.php';
require 'bottom_page.php' ?>