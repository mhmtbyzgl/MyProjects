<?php
require 'login_check.php';
require 'permission_check_teacher.php';
require 'top_nav_side_page.php';
require 'db.php';
@session_start();
$teacherUserId = $_SESSION['id'];
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row">
      <h1 class="h3 mb-0 text-gray-800">Sınavlar</h1>
      <p id="autoHideP">
        <?php if (isset($_GET['error'])) { ?>
      <div class="alert alert-success d-flex justify-content-center align-items-center ml-5" role="alert">
        <?= $_GET['error'] ?>
      </div>
    <?php } ?>
    </p>
    </div>
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
              <th>Sınıf Adı</th>
              <th>Öğrenci İsmi</th>
              <th>Öğrenci Soyismi</th>
              <th>Ders Adı</th>
              <th>Ders Notu</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Sınav Tarihi</th>
              <th>Sınıf Adı</th>
              <th>Öğrenci İsmi</th>
              <th>Öğrenci Soyismi</th>
              <th>Ders Adı</th>
              <th>Ders Notu</th>
              <th>İşlemler</th>

            </tr>
          </tfoot>
          <tbody>
            <?php
            $SORGU = $DB->prepare("SELECT E.id, E.exam_score, E.exam_date, U.name, U.surname, L.lesson_name, C.class_name
FROM exams E
INNER JOIN users U ON E.student_id = U.id
INNER JOIN lessons L ON E.lesson_id = L.id
INNER JOIN classes C ON E.class_id = C.id
WHERE L.teacher_user_id = :teacher_user_id
ORDER BY U.surname, U.name, L.lesson_name;
");
            $SORGU->bindParam(':teacher_user_id', $teacherUserId, PDO::PARAM_INT);

            $SORGU->execute();
            $exams = $SORGU->fetchAll(PDO::FETCH_ASSOC);
            foreach ($exams as $exam) {
              echo "
                <tr>
                  <td>{$exam['exam_date']}</td>
                  <td>{$exam['class_name']}</td>
                  <td>{$exam['name']}</td>
                  <td>{$exam['surname']}</td>
                  <td>{$exam['lesson_name']}</td>
                  <td>{$exam['exam_score']}</td>
                  <td style='text-align: center;'>
                    <a href='teacher_edit_exam.php?id={$exam['id']}' target='_blank' class='btn btn-warning btn-sm' style='margin-bottom: 3px;'>Sınav Notu Düzenle</a><br>
                    <a href='fonk_teacher_delete_exam_score.php?id={$exam['id']}' target='_blank' class='btn btn-danger btn-sm'>Sınav Notu Sil</a>
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