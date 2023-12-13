<?php
@session_start()
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Siber Vatan - OBS</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <script>
    function toggleSidebar() {
      var yavuzlarPng = document.getElementById("yavuzlarPng");
      if (yavuzlarPng.style.display === "none") {
        yavuzlarPng.style.display = "block";
      } else {
        yavuzlarPng.style.display = "none";
      }
    }
  </script>



  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="fonk_login.php">

        <div class="sidebar-brand-text mx-3">
          <span id="brand-text">Siber Vatan</span>
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">



      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <!-- <div class="sidebar-heading">
        Interface
      </div> -->

      <!-- Admin Sidebar -->
      <?php
      if ($_SESSION['role'] == 'Admin') {
      ?>
        <!-- Nav Item - Kullanıcılar Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <span>Kullanıcılar</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Admin:</h6>
              <a class="collapse-item" href="user_list.php">Tüm Kullanıcılar</a>
              <a class="collapse-item" href="add_user.php">Kullanıcı Ekle</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item -  Sorumlular Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <span>Sınıf ve Ders İşlemleri</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Sınıf İşlemleri</h6>
              <a class="collapse-item" href="classes_info.php">Tüm Sınıflar</a>
              <a class="collapse-item" href="add_new_class.php">Sınıf Ekleme</a>
              <h6 class="collapse-header">Ders İşlemleri</h6>
              <a class="collapse-item" href="lessons_info.php">Tüm Dersler</a>
              <a class="collapse-item" href="add_new_lesson.php">Ders Ekleme</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <span>Öğrenci ve Sınav İşlemleri</span>
          </a>
          <div id="collapsePages" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Öğrenci İşlemleri</h6>
              <a class="collapse-item" href="students_info.php">Tüm Öğrenciler</a>
              <a class="collapse-item" href="add_student_to_class.php">Sınıfa Öğrenci Ekleme</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Sınav İşlemleri</h6>
              <a class="collapse-item" href="exams_info.php">Tüm Sınavlar</a>
              <a class="collapse-item" href="add_new_exam_score.php">Sınav Notu Ekleme</a>
            </div>
          </div>
        </li>
      <?php } ?>

      <!-- Teacher Sidebar -->
      <?php
      if ($_SESSION['role'] == 'Teacher') {
      ?>


        <!-- Nav Item -  Sorumlular Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <span>Sınıf ve Ders İşlemleri</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Sınıf İşlemleri</h6>
              <a class="collapse-item" href="teacher_classes_info.php">Sınıf ve Ders Ortalamaları</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <span>Öğrenci ve Sınav İşlemleri</span>
          </a>
          <div id="collapsePages" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Öğrenci İşlemleri</h6>
              <a class="collapse-item" href="teacher_students_info.php">Tüm Öğrenciler</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Sınav İşlemleri</h6>
              <a class="collapse-item" href="teacher_exams_info.php">Tüm Sınavlar</a>
              <a class="collapse-item" href="teacher_add_new_exam_score.php">Sınav Notu Ekleme</a>
            </div>
          </div>
        </li>
      <?php } ?>


      <?php
      if ($_SESSION['role'] == 'Student') {
      ?>


        <!-- Nav Item -  Sorumlular Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <span>Sınıf İşlemleri</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Sınıf İşlemleri</h6>
              <a class="collapse-item" href="student_classes_info.php">Sınıf</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <span>Sınav İşlemleri</span>
          </a>
          <div id="collapsePages" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Sınav İşlemleri</h6>
              <a class="collapse-item" href="student_exams_info.php">Sınavlar</a>
            </div>
          </div>
        </li>
      <?php } ?>
      <!-- Nav Item - Charts -->


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle" onclick="toggleSidebar()"></button>
      </div>
      <div>
        <img src="./img/yavuzlar.png" id="yavuzlarPng" style="width: 308px; height: 308px; margin-top: 50px;">
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar H1 -->
          <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <p>Öğrenci Bilgi Sistemi</p>
          </div>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">



            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['name'] . " " . $_SESSION['surname'] ?></span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Oturumu Sonlandır
                </a>
              </div>
            </li>

          </ul>

        </nav>