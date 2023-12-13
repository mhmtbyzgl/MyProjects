      <?php
      require 'login_check.php';
      require 'permission_check_admin.php';



      $SORGU = $DB->prepare("SELECT COUNT(*) AS count_students FROM users WHERE role = 'Student'");
      $SORGU->execute();
      $students = $SORGU->fetchAll(PDO::FETCH_ASSOC);


      $SORGU_2 = $DB->prepare("SELECT COUNT(*) AS count_teachers FROM users WHERE role = 'Teacher'");
      $SORGU_2->execute();
      $teachers = $SORGU_2->fetchAll(PDO::FETCH_ASSOC);

      $SORGU_3 = $DB->prepare("SELECT COUNT(*) AS count_classes FROM classes");
      $SORGU_3->execute();
      $classes = $SORGU_3->fetchAll(PDO::FETCH_ASSOC);

      ?>

      <!-- Content Row -->
      <div class="row">

        <!-- Toplam Öğrenci Sayısı Card -->
        <div class="col-xl-4 col-md-6 mb-4">
          <a href="students_info.php" style="text-decoration: none;">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase text-center mb-1">
                      Toplam Öğrenci Sayısı</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?= $students[0]['count_students'] ?></div>
                  </div>
                  <div class="col-auto">
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Toplam Sorumlu Sayısı Card -->
        <div class="col-xl-4 col-md-6 mb-4">
          <a href="teachers_info.php" style="text-decoration: none;">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-ite
                ms-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase text-center mb-1">
                      Toplam Sorumlu Sayısı</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?= $teachers[0]['count_teachers'] ?></div>
                  </div>
                  <div class="col-auto">
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Toplam Sınıf Sayısı Card -->
        <div class="col-xl-4 col-md-6 mb-4">
          <a href="classes_info.php" style="text-decoration: none;">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase text-center mb-1">
                      Toplam Sınıf Sayısı</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?= $classes[0]['count_classes'] ?></div>
                  </div>
                  <div class="col-auto">
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!-- Content Row -->
      <div class="row mt-2">




      </div>