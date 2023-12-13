<?php
require 'login_check.php';
require 'permission_check_teacher.php';
require 'top_nav_side_page.php';
require_once('db.php');
@session_start();
$teacherUserId = $_SESSION['id'];


$SORGU = $DB->prepare("SELECT B.class_name, COUNT(C.student_id) FROM classes_students C INNER JOIN classes B WHERE C.class_id = B.id GROUP BY B.class_name");
$SORGU->execute();
$countStudentsClass = $SORGU->fetchAll(PDO::FETCH_ASSOC);

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
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Sınıf Adı</th>
              <th>Sınıf Başarı Ortalaması</th>
              <th>Öğrenci Sayısı</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $SORGU_2 = $DB->prepare("WITH ClassAverages AS (
SELECT A.class_id, B.class_name, AVG(A.exam_score) AS class_average
FROM exams A
INNER JOIN classes B ON A.class_id = B.id
WHERE A.class_id = B.id
GROUP BY B.class_name
)

SELECT A.id, B.id, B.class_teacher_id, A.name, A.surname, B.class_name, C.class_average
FROM users A 
INNER JOIN classes B ON A.id = B.class_teacher_id
LEFT JOIN ClassAverages C ON B.class_name = C.class_name
WHERE B.class_teacher_id = :teacher_user_id;
                                  ");
            $SORGU_2->bindParam(':teacher_user_id', $teacherUserId, PDO::PARAM_INT);

            $SORGU_2->execute();
            $classes = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);
            foreach ($classes as $class) {
              $count = "N/A";
              foreach ($countStudentsClass as $countStudentC) {
                if ($countStudentC["class_name"] == $class["class_name"]) {
                  $count = $countStudentC["COUNT(C.student_id)"];
                  break;
                }
              }
              echo "
              <tr>
                <td>{$class['class_name']}</td>
                <th>" . number_format($class['class_average'], 2) . "</th>
                <th>$count</th>
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
              <th>Ders Adı</th>
              <th>Ders Başarı Ortalaması</th>
              <th>Öğrenci Sayısı</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Ders Adı</th>
              <th>Ders Başarı Ortalaması</th>
              <th>Öğrenci Sayısı</th>

            </tr>
          </tfoot>
          <tbody>
            <?php
            $SORGU_3 = $DB->prepare("SELECT L.lesson_name,
      AVG(E.exam_score) AS lesson_average ,
      COUNT(E.student_id) AS count_student
FROM exams E
JOIN lessons L ON E.lesson_id = L.id
JOIN users U ON L.teacher_user_id = U.id
WHERE U.id = $teacherUserId 
GROUP BY L.id;");
            $SORGU_3->execute();
            $lessons = $SORGU_3->fetchAll(PDO::FETCH_ASSOC);
            foreach ($lessons as $lesson) {
              echo "
                <tr>
                  <td>{$lesson['lesson_name']}</td>
                  <th>" . number_format($lesson['lesson_average'], 2) . "</th>
                  <th>{$lesson['count_student']}</th>
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