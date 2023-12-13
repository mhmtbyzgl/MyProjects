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
    <h1 class="h3 mb-0 text-gray-800">Sorumlu Paneli</h1>
  </div>

  <?php require 'teacher_cards.php' ?>

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