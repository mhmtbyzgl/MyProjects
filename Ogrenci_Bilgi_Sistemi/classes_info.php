<?php
require 'login_check.php';
require 'permission_check_admin.php';
require 'top_nav_side_page.php';
require_once('db.php');

$SORGU = $DB->prepare("SELECT B.class_name, COUNT(C.student_id) FROM classes_students C INNER JOIN classes B WHERE C.class_id = B.id GROUP BY B.class_name");
$SORGU->execute();
$countStudents = $SORGU->fetchAll(PDO::FETCH_ASSOC);

$SORGU_3 = $DB->prepare("SELECT id, class_name FROM classes");
$SORGU_3->execute();
$classesFilter = $SORGU_3->fetchAll(PDO::FETCH_ASSOC);

$selectedClass = isset($_POST['classFilter']) ? $_POST['classFilter'] : 0;
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row">
      <h1 class="h3 mb-0 text-gray-800">Sınıflar</h1>
      <p id="autoHideP">
        <?php if (isset($_GET['error'])) { ?>
      <div class="alert alert-success d-flex justify-content-center align-items-center ml-5" role="alert">
        <?= $_GET['error'] ?>
      </div>
    <?php } ?>
    </p>
    </div>
    <a href="add_new_class.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Yeni Sınıf Oluştur</a>
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
              <th>
                <form method="post">
                  <label for="classFilter">Sınıf:</label>
                  <select class="form-select ml-3" name="classFilter" id="classFilter" aria-label="Default select example" onchange="this.form.submit()">
                    <option value="0" <?php echo $selectedClass == 0 ? 'selected' : ''; ?>>Tümü</option>
                    <?php
                    foreach ($classesFilter as $classesF) {
                      $classId = $classesF['id'];
                      $selected = $selectedClass == $classId ? 'selected' : '';
                      echo "<option value='$classId' $selected>{$classesF['class_name']}</option>";
                    }
                    ?>
                  </select>
                </form>
              </th>
              <th>Sınıf Sorumlusu</th>
              <th>Sınıf Başarı Ortalaması</th>
              <th>Öğrenci Sayısı</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Sınıf Adı</th>
              <th>Sınıf Sorumlusu</th>
              <th>Sınıf Başarı Ortalaması</th>
              <th>Öğrenci Sayısı</th>
              <th>İşlemler</th>

            </tr>
          </tfoot>
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
                                    LEFT JOIN ClassAverages C ON B.class_name = C.class_name;
                                    ");
            $SORGU_2->execute();
            $classes = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);
            foreach ($classes as $class) {
              if ($selectedClass == 0 || $class['id'] == $selectedClass) {
                $count = "N/A";
                foreach ($countStudents as $countStudent) {
                  if ($countStudent["class_name"] == $class["class_name"]) {
                    $count = $countStudent["COUNT(C.student_id)"];
                    break;
                  }
                }

                echo "
                <tr>
                  <td>{$class['class_name']}</td>
                  <td>{$class['name']} {$class['surname']}</td>
                  <th>" . number_format($class['class_average'], 2) . "</th>
                  <th>$count</th>
                  <td style='text-align: center;'>
                    <a href='class_add_update.php?id={$class['id']}' target='_blank' class='btn btn-warning btn-sm' style='margin-bottom: 3px;'>Sınıf Düzenle</a><br>
                    <a href='fonk_delete_class.php?id={$class['id']}' target='_blank' class='btn btn-danger btn-sm'>Sınıf Sil</a>
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