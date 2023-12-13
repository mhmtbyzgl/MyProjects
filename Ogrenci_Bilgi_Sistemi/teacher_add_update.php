<?php

require 'login_check.php';
require 'permission_check_teacher.php';
require 'top_nav_side_page.php';
require 'db.php';

?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sorumlu Düzenleme</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>


  <div class="container">
    <div class="row justify-content-center">
      <form>


        <div class="col-md-12 mb-3">
          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="İsim">
        </div>
        <div class="col-md-12 mb-3">
          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Soyisim">
        </div>
        <div class="col-md-12 mb-3">
          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Kullanıcı Adı">
        </div>
        <div class="col-md-12 mb-3">
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-Mail">
        </div>
        <div class="col-md-12 mb-3 text-center">
          <span>Rol:</span>
          <select class="form-select ml-2 mb-3" aria-label="Default select example">
            <option selected></option>
            <option value="1">Admin</option>
            <option value="2">Teacher</option>
            <option value="3">Student</option>
          </select>
          <div class="col-md-12 mb-3">
            <label>Change Password</label>
            <input type="password" class="form-control mb-3" id="exampleInputPassword1" placeholder="Parola">
            <input type="password" class="form-control mb-3" id="exampleInputPassword1" placeholder="Parolayı Tekrar Girin...">
          </div>

        </div>
        <!-- <div class="col-md-12 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
        <div class="col-md-12 mb-3 text-center">
          <a href="add_student.php" type="button" class="btn btn-success mr-1">Ekle</a><a href="update_student.php" type="button" class="btn btn-warning">Güncelle</a>
        </div>
      </form>
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



<?php
require 'logout_modal.php';
require 'bottom_page.php' ?>