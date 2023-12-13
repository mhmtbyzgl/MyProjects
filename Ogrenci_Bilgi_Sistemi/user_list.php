<?php
require 'login_check.php';
require 'permission_check_admin.php';
require 'top_nav_side_page.php';
require_once('db.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row">
      <h1 class="h3 mb-0 text-gray-800">Kullanıcılar</h1>
      <p id="autoHideP">
        <?php if (isset($_GET['error'])) { ?>
      <div class="alert alert-success d-flex justify-content-center align-items-center ml-5" role="alert">
        <?= $_GET['error'] ?>
      </div>
    <?php } ?>
    <?php if (isset($_GET['error2'])) { ?>
      <div class="alert alert-danger d-flex justify-content-center align-items-center ml-5" role="alert">
        <?= $_GET['error2'] ?>
      </div>
    <?php } ?>
    </div>
    <a href="add_user.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa-regular fa-user" style="color: #ffffff;"></i> Yeni Kullanıcı Oluştur</a>
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
              <th>Kullanıcı Adı</th>
              <th>Rol</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>İsim</th>
              <th>Soyisim</th>
              <th>Kullanıcı Adı</th>
              <th>Rol</th>
              <th>İşlemler</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $SORGU = $DB->prepare("SELECT id, name, surname, username, role FROM users");
            $SORGU->execute();
            $students = $SORGU->fetchAll(PDO::FETCH_ASSOC);

            foreach ($students as $student) {
              echo "
                <tr>
                  <td>{$student['name']}</td>
                  <td>{$student['surname']}</td>
                  <td>{$student['username']}</td>
                  <td>{$student['role']}</td>
                  <td style='text-align: center;'>
                    <a href='user_update.php?id={$student['id']}' target='_blank' class='btn btn-warning btn-sm' style='margin-bottom: 3px;'>Kullanıcı Düzenle</a><br>
                    <a href='fonk_delete_user.php?id={$student['id']}' target='_blank' class='btn btn-danger btn-sm'>Kullanıcı Sil</a>
                  </td>
                </tr>
                ";
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