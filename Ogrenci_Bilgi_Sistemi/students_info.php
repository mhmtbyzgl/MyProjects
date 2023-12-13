<?php
require 'login_check.php';
require 'permission_check_admin.php';
require 'top_nav_side_page.php';
require_once('db.php');


$SORGU = $DB->prepare("SELECT id, class_name FROM classes");
$SORGU->execute();
$classes = $SORGU->fetchAll(PDO::FETCH_ASSOC);

$selectedClass = isset($_POST['classFilter']) ? $_POST['classFilter'] : 0;
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row">
      <h1 class="h3 mb-0 text-gray-800">Öğrenciler</h1>
      <p id="autoHideP">
        <?php if (isset($_GET['error'])) { ?>
      <div class="alert alert-success d-flex justify-content-center align-items-center ml-5" role="alert">
        <?= $_GET['error'] ?>
      </div>
    <?php } ?>
    </div>
    <a href="add_student_to_class.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa-regular fa-user" style="color: #ffffff;"></i> Sınıfa Yeni Öğrenci Ekle</a>
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
              <th>
                <form method="post">
                  <label for="classFilter">Sınıf:</label>
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
              <th>Genel Başarı Ortalaması</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>İsim</th>
              <th>Soyisim</th>
              <th>Sınıf</th>
              <th>Genel Başarı Ortalaması</th>
              <th>İşlemler</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $SORGU = $DB->prepare("SELECT A.id, A.name, A.surname, B.class_id, C.class_name,(SELECT AVG(exam_score) FROM exams WHERE student_id = A.id GROUP BY student_id) AS general_average FROM users A INNER JOIN classes_students B ON A.id = B.student_id INNER JOIN classes C ON B.class_id = C.id;
");
            $SORGU->execute();
            $students = $SORGU->fetchAll(PDO::FETCH_ASSOC);
            foreach ($students as $student) {
              if ($selectedClass == 0 || $student['class_id'] == $selectedClass) {
                echo "
                <tr>
                  <td>{$student['name']}</td>
                  <td>{$student['surname']}</td>
                  <td>{$student['class_name']}</td>
                  <td>" . number_format($student['general_average'], 2) . "</td>
                  <td style='text-align: center;'>
                    <a href='student_info.php?id={$student['id']}' target='_blank' name='detail' class='btn btn-primary btn-sm' style='margin-bottom: 3px;'>Ayrıntılı Görüntüle</a><br>
                    <a href='edit_student_class.php?id={$student['class_id']}' target='_blank' class='btn btn-warning btn-sm' style='margin-bottom: 3px;'>Öğrenci Düzenle</a><br>
                    <a href='fonk_delete_student.php?id={$student['id']}' target='_blank' class='btn btn-danger btn-sm'>Öğrenci Sil</a>
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