<?php
require 'login_check.php';
require 'permission_check_teacher.php';
require 'top_nav_side_page.php';
require_once('db.php');
@session_start();
$teacherUserId = $_SESSION['id'];

?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Öğrenciler</h1>

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
              <th>İsim</th>
              <th>Soyisim</th>
              <th> Ders Adı</th>
              <th>Ders Başarı Ortalaması</th>
              <th>Sınıf Başarı Ortalaması</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>İsim</th>
              <th>Soyisim</th>
              <th>Ders Adı</th>
              <th>Ders Başarı Ortalaması</th>
              <th>Sınıf Başarı Ortalaması</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $SORGU_2 = $DB->prepare("SELECT U.name, U.surname, L.lesson_name, AVG(E.exam_score) AS lesson_average, (SELECT AVG(E2.exam_score) FROM exams E2 WHERE E2.class_id = E.class_id) AS class_average FROM users U JOIN classes_students CS ON U.id = CS.student_id JOIN exams E ON U.id = E.student_id JOIN lessons L ON E.lesson_id = L.id WHERE U.role = 'Student' AND CS.class_id IN (SELECT id FROM classes WHERE class_teacher_id = :class_teacher_id) AND L.teacher_user_id = :teacher_user_id GROUP BY U.id, L.lesson_name");
            $SORGU_2->bindParam(':teacher_user_id', $teacherUserId, PDO::PARAM_INT);
            $SORGU_2->bindParam(':class_teacher_id', $teacherUserId, PDO::PARAM_INT);

            $SORGU_2->execute();
            $students = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);
            foreach ($students as $student) {
              echo "
                <tr>
                  <td>{$student['name']}</td>
                  <td>{$student['surname']}</td>
                  <td>{$student['lesson_name']}</td>
                  <td>" . number_format($student['lesson_average'], 2) . "</td>
                  <td>" . number_format($student['class_average'], 2) . "</td>
                </tr>
                ";
            }

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