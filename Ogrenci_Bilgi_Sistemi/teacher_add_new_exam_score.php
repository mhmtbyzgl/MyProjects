<?php
require 'login_check.php';
require 'permission_check_teacher.php';
require 'top_nav_side_page.php';
require 'db.php';
@session_start();
$teacherUserId = $_SESSION['id'];

$SORGU = $DB->prepare("SELECT DISTINCT U.id, U.name, U.surname
FROM users U
INNER JOIN exams E ON U.id = E.student_id 
INNER JOIN classes C ON E.class_id = C.id
WHERE C.class_teacher_id = :teacher_user_id;
");
$SORGU->bindParam(':teacher_user_id', $teacherUserId, PDO::PARAM_INT);
$SORGU->execute();
$students = $SORGU->fetchAll(PDO::FETCH_ASSOC);



$SORGU_2 = $DB->prepare("SELECT id, lesson_name FROM lessons WHERE teacher_user_id = :teacher_user_id");
$SORGU_2->bindParam(':teacher_user_id', $teacherUserId, PDO::PARAM_INT);

$SORGU_2->execute();
$lessons = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);

?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row">
      <h1 class="h3 mb-0 text-gray-800">Not Ekleme</h1>
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
      <form method="POST" action="fonk_teacher_add_new_exam_score.php">



        <div class="col-md-12 mb-3 text-center">
          <span>Öğrenci:</span>
          <select class="form-select ml-2 mb-3" aria-label="Default select example" name="studentName">
            <option value="0">Seçiniz</option>
            <?php
            foreach ($students as $student) {
              echo "
            <option value='{$student['id']}'> {$student['name']} {$student['surname']}</option>
          ";
            }
            ?>
          </select>
        </div>

        <div class="col-md-12 mb-3 text-center">
          <span>Ders:</span>
          <select class="form-select ml-2 mb-3" aria-label="Default select example" name="lessonName">
            <option value="0">Seçiniz</option>
            <?php
            foreach ($lessons as $lesson) {
              echo "
            <option value='{$lesson['id']}'> {$lesson['lesson_name']}</option>
          ";
            }
            ?>
          </select>
        </div>
        <div class="col-md-12 mb-3">
          <input type="text" class="form-control" name="examScore" placeholder="Not Giriniz...">
        </div>

        <div class="col-md-12 mb-3 text-center">
          <button type="submit" class="btn btn-success">Ekle</button>
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