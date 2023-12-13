      <?php
      require 'login_check.php';
      require 'permission_check_teacher.php';
      @session_start();
      $teacherUserId = $_SESSION['id'];


      $SORGU = $DB->prepare("SELECT COUNT(*) AS count_students FROM users U INNER JOIN classes_students CS ON U.id = CS.student_id INNER JOIN classes C ON CS.class_id = C.id WHERE U.role = 'Student' AND C.class_teacher_id = :class_teacher_id;");
      $SORGU->bindParam(':class_teacher_id', $teacherUserId, PDO::PARAM_INT);

      $SORGU->execute();
      $students = $SORGU->fetchAll(PDO::FETCH_ASSOC);


      $SORGU_2 = $DB->prepare("SELECT AVG(exam_score) AS average_score FROM exams WHERE class_id IN (SELECT id FROM classes WHERE class_teacher_id = :class_teacher_id);
");
      $SORGU_2->bindParam(':class_teacher_id', $teacherUserId, PDO::PARAM_INT);

      $SORGU_2->execute();
      $average = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);



      $SORGU_3 = $DB->prepare("SELECT class_name FROM classes WHERE class_teacher_id = :class_teacher_id");
      $SORGU_3->bindParam(':class_teacher_id', $teacherUserId, PDO::PARAM_INT);

      $SORGU_3->execute();
      $className = $SORGU_3->fetchAll(PDO::FETCH_ASSOC);


      ?>

      <!-- Content Row -->
      <div class="row">

        <!-- Toplam Öğrenci Sayısı Card -->
        <div class="col-xl-6 col-md-6 mb-4">
          <a href="teacher_students_info.php" style="text-decoration: none;">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase text-center mb-1">
                      Toplam Öğrenci Sayısı</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?= $students[0]['count_students'] ?></div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Toplam Sorumlu Sayısı Card -->
        <div class="col-xl-6 col-md-6 mb-4">
          <a href="teacher_classes_info.php" style="text-decoration: none;">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-ite
                ms-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase text-center mb-1">
                      <?= $className[0]['class_name'] ?> Sınıfının Genel Başarı Ortalaması</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?= number_format($average[0]['average_score'], 2) ?></div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>