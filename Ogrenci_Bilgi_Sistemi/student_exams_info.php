<?php
require 'login_check.php';
require 'permission_check_student.php';
require 'top_nav_side_page.php';
require 'db.php';
@session_start();
$studentUserId = $_SESSION['id'];
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sınavlar</h1>

  </div>


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="row">
        <h6 class="m-0 font-weight-bold text-primary mr-3"></h6>
        <input type="text" class="form-control-sm" id="searchBox" placeholder="Aramanızı Giriniz...">
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Sınav Tarihi</th>
              <th>Ders Adı</th>
              <th>Ders Notu</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Sınav Tarihi</th>
              <th>Ders Adı</th>
              <th>Ders Notu</th>

            </tr>
          </tfoot>
          <tbody>
            <?php
            $SORGU = $DB->prepare("SELECT E.exam_date, E.exam_score, L.lesson_name FROM exams E INNER JOIN lessons L ON E.lesson_id = L.id WHERE E.student_id = :student_id");
            $SORGU->bindParam(':student_id', $studentUserId, PDO::PARAM_INT);

            $SORGU->execute();
            $exams = $SORGU->fetchAll(PDO::FETCH_ASSOC);
            foreach ($exams as $exam) {
              echo "
                <tr>
                  <td>{$exam['exam_date']}</td>
                  <td>{$exam['lesson_name']}</td>
                  <td>{$exam['exam_score']}</td>
                  </td>
                </tr>
                ";
            }
            // }
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