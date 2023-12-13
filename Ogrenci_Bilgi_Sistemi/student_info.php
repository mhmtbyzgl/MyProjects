<?php
require 'login_check.php';
require 'permission_check_admin.php';
require 'top_nav_side_page.php';
require_once('db.php');


$id = $_GET['id'];

$SORGU = $DB->prepare("SELECT A.exam_score, A.exam_date, B.lesson_name 
                      FROM exams A 
                      INNER JOIN lessons B ON A.lesson_id = B.id 
                      WHERE A.student_id = :id;");
$SORGU->bindParam(':id', $id, PDO::PARAM_INT);
$SORGU->execute();
$exams = $SORGU->fetchAll(PDO::FETCH_ASSOC);

$SORGU_2 = $DB->prepare("SELECT name, surname FROM users WHERE id = :id");
$SORGU_2->bindParam(':id', $id, PDO::PARAM_INT);
$SORGU_2->execute();
$users = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);

$SORGU_3 = $DB->prepare("SELECT B.lesson_name, AVG(A.exam_score) AS lesson_average
                        FROM exams A
                        INNER JOIN lessons B ON A.lesson_id = B.id
                        WHERE A.student_id = :id
                        GROUP BY B.lesson_name;");
$SORGU_3->bindParam(':id', $id, PDO::PARAM_INT);
$SORGU_3->execute();
$averages = $SORGU_3->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?php echo "{$users[0]['name']} {$users[0]['surname']} " ?></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Sınav Zamanı</th>
              <th>Sınav Puanı</th>
              <th>Ders Adı</th>
              <th>Ders Ortalaması</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Sınav Zamanı</th>
              <th>Sınav Puanı</th>
              <th>Ders Adı</th>
              <th>Ders Ortalaması</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            foreach ($exams as $exam) {

              $average = findAverage($averages, $exam['lesson_name']);
              $average2 = number_format($average, 2);
              echo "
              <tr>
                <td>{$exam['exam_date']}</td>
                <td>{$exam['exam_score']}</td>
                <td>{$exam['lesson_name']}</td>
                <td>$average2</td>
              ";
            }

            function findAverage($averages, $lessonName)
            {
              foreach ($averages as $average) {
                if ($average['lesson_name'] == $lessonName) {
                  return $average['lesson_average'];
                }
              }
              return 0;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php require 'footer.php' ?>

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<?php require 'logout_modal.php'; ?>
<?php require 'bottom_page.php'; ?>