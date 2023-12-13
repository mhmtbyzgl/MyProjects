<?php
require 'login_check.php';
require 'permission_check_admin.php';
require 'top_nav_side_page.php';
require 'db.php';


$SORGU_2 = $DB->prepare("SELECT id, class_name FROM classes");
$SORGU_2->execute();
$classes = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);

$selectedClass = isset($_POST['classFilter']) ? $_POST['classFilter'] : 0;

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
    <a href="add_new_exam_score.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Yeni Not Ekle</a>
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
              <th>
                <form class="text-center" method="post">
                  <label for="classFilter">Sınıf</label>
                  <select class="form-select ml-3" name="classFilter" id="classFilter" aria-label="Default select example" onchange="this.form.submit()">
                    <option value="0" <?php echo $selectedClass == 0 ? 'selected' : ''; ?>>Tümü</option>
                    <?php
                    foreach ($classes as $class) {
                      $classId = $class['id'];
                      $selected = $selectedClass == $classId ? 'selected' : '';
                      echo "<option value='$classId' $selected>{$class['class_name']}</option>";
                    }
                    ?>
                  </select>
                </form>
              </th>
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
            $SORGU = $DB->prepare("SELECT A.id, A.exam_score, A.exam_date, B.name, B.surname, C.lesson_name, D.id AS class_id, D.class_name
FROM exams A 
INNER JOIN users B ON A.student_id = B.id 
INNER JOIN lessons C ON A.lesson_id = C.id
INNER JOIN classes D ON A.class_id = D.id");
            $SORGU->execute();
            $exams = $SORGU->fetchAll(PDO::FETCH_ASSOC);
            foreach ($exams as $exam) {
              if ($selectedClass == 0 || $exam['class_id'] == $selectedClass) {
                echo "
                <tr>
                  <td>{$exam['exam_date']}</td>
                  <td>{$exam['class_name']}</td>
                  <td>{$exam['name']}</td>
                  <td>{$exam['surname']}</td>
                  <td>{$exam['lesson_name']}</td>
                  <td>{$exam['exam_score']}</td>
                  <td style='text-align: center;'>
                    <a href='edit_exam.php?id={$exam['id']}' target='_blank' class='btn btn-warning btn-sm' style='margin-bottom: 3px;'>Sınav Notu Düzenle</a><br>
                    <a href='fonk_delete_exam_score.php?id={$exam['id']}' target='_blank' class='btn btn-danger btn-sm'>Sınav Notu Sil</a>
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