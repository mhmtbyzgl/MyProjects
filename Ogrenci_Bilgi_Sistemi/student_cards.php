      <?php
      require 'login_check.php';
      require 'permission_check_student.php';
      @session_start();
      $studentUserId = $_SESSION['id'];


      $SORGU = $DB->prepare("SELECT COUNT(*) AS total_exams FROM exams WHERE student_id = :student_id;");

      $SORGU->bindParam(':student_id', $studentUserId, PDO::PARAM_INT);
      $SORGU->execute();
      $exams = $SORGU->fetchAll(PDO::FETCH_ASSOC);


      $SORGU_2 = $DB->prepare("SELECT SUM(exam_score) / COUNT(DISTINCT lesson_id) AS general_average FROM exams WHERE student_id = $studentUserId GROUP BY student_id;)
");
      $SORGU_2->execute();
      $generalAverage = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);



      // $SORGU_3 = $DB->prepare("SELECT class_name FROM classes WHERE class_teacher_id = $teacherUserId");
      // $SORGU_3->execute();
      // $className = $SORGU_3->fetchAll(PDO::FETCH_ASSOC);


      ?>

      <!-- Content Row -->
      <div class="row">

        <!-- Toplam Öğrenci Sayısı Card -->
        <div class="col-xl-6 col-md-6 mb-4">
          <a href="student_exams_info.php" style="text-decoration: none;">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase text-center mb-1">
                      Toplam Sınav Sayısı</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?= $exams[0]['total_exams'] ?></div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Toplam Sorumlu Sayısı Card -->
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-ite
                ms-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase text-center mb-1">
                    Genel Başarı Ortalaması</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?= number_format($generalAverage[0]['general_average'], 2) ?></div>
                </div>
              </div>
            </div>
          </div>
          </a>
        </div>
      </div>