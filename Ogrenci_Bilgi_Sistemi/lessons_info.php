<?php

require 'login_check.php';
require 'permission_check_admin.php';
require 'top_nav_side_page.php';
require_once('db.php');

$SORGU = $DB->prepare("SELECT id, name, surname FROM users WHERE role = 'Teacher' ");
$SORGU->execute();
$teachers = $SORGU->fetchAll(PDO::FETCH_ASSOC);

$selectedTeacher = isset($_POST['teacherFilter']) ? $_POST['teacherFilter'] : 0;
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row">
      <h1 class="h3 mb-0 text-gray-800">Dersler</h1>
      <p id="autoHideP">
        <?php if (isset($_GET['error'])) { ?>
      <div class="alert alert-success d-flex justify-content-center align-items-center ml-5" role="alert">
        <?= $_GET['error'] ?>
      </div>
    <?php } ?>
    </p>
    </div>
    <a href="add_new_lesson.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Yeni Ders Oluştur</a>
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
              <th>
                <form method="POST">
                  <label for="teacherFilter">Sorumlu:</label>
                  <select class="form-select ml-3" name="teacherFilter" id="teacherFilter" aria-label="Default select example" onchange="this.form.submit()">
                    <option value="0" <?php echo $selectedTeacher == 0 ? 'selected' : ''; ?>>Tümü</option>
                    <?php
                    foreach ($teachers as $teacher) {
                      $teacherId = $teacher['id'];
                      $selected = $selectedTeacher == $teacherId ? 'selected' : '';
                      echo "<option value='$teacherId' $selected>{$teacher['name']} {$teacher['surname']}</option>";
                    }
                    ?>
                  </select>
                </form>
              </th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>İsim</th>
              <th>Sorumlu Adı</th>
              <th>İşlemler</th>

            </tr>
          </tfoot>
          <tbody>
            <?php
            $SORGU_2 = $DB->prepare("SELECT B.id, B.teacher_user_id, A.name, A.surname, B.lesson_name
                                FROM users A
                                INNER JOIN lessons B ON A.id = B.teacher_user_id");
            $SORGU_2->execute();
            $lessons = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);
            foreach ($lessons as $lesson) {
              if ($selectedTeacher == 0 || $lesson['teacher_user_id'] == $selectedTeacher) {
                echo "
                <tr>
                  <td>{$lesson['lesson_name']}</td>
                  <td>{$lesson['name']} {$lesson['surname']}</td>
                  <td style='text-align: center;'>
                    <a href='lesson_add_update.php?id={$lesson['id']}' target='_blank' class='btn btn-warning btn-sm' style='margin-bottom: 3px;'>Ders Düzenle</a><br>
                    <a href='fonk_delete_lesson.php?id={$lesson['id']}' target='_blank' class='btn btn-danger btn-sm'>Ders Sil</a>
                  </td>
                </tr>
                ";
              }
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