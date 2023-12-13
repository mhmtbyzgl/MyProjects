<?php
require 'login_check.php';
require 'permission_check_admin.php';
require 'top_nav_side_page.php';
require 'db.php';



$id = $_GET['id'];

$SORGU = $DB->prepare("SELECT B.id, A.name, A.surname, B.lesson_name, B.teacher_user_id
                                FROM users A
                                INNER JOIN lessons B ON A.id = B.teacher_user_id WHERE  B.id = :id");
$SORGU->bindParam(':id', $id, PDO::PARAM_INT);
$SORGU->execute();
$lesson = $SORGU->fetchAll(PDO::FETCH_ASSOC);

$SORGU_2 = $DB->prepare("SELECT id, name, surname FROM users WHERE role = 'Teacher'");
$SORGU_2->execute();
$teachers = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);





?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ders Düzenleme</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>


  <div class="container">
    <div class="row justify-content-center">
      <form method="POST" action="fonk_update_lesson.php?id=<?= $id ?>">


        <div class="col-md-12 mb-3">
          <input type="text" class="form-control" name="lessonName" value="<?= $lesson[0]['lesson_name'] ?>" placeholder="Ders Adı">
        </div>
        <div class="col-md-12 mb-3 text-center">
          <span>Dersin Sorumlusu:</span>
          <select class="form-select ml-2 mb-3" aria-label="Default select example" name="selectedTeacher">
            <option value="<?= $lesson[0]['teacher_user_id'] ?>" selected><?= $lesson[0]['name'] . " " . $lesson[0]['surname'] ?></option>
            <?php
            foreach ($teachers as $teacher) {
              echo "
            <option value='{$teacher['id']}'> {$teacher['name']} {$teacher['surname']}</option>


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
          <button type="submit" class="btn btn-warning">Güncelle</button> <a href="lessons_info.php" type="button" class="btn btn-success mr-1">Geri Dön</a>
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