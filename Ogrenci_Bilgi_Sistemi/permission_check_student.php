<?php
if ($_SESSION['role'] != 'Student') {

  echo "<h1 class='alert text-center alert-success alert-dismissible fade show' style='  background-color: #f00; 
  color: #fff; 
  padding: 10px; 
  margin-top: 50px; 
  text-align: center; '>Bu sayfaya erişim yetkiniz bulunmamaktadır.</h1>
";

  if ($_SESSION['role'] === 'Admin') {

    header("refresh:2;url=admin_page.php");
  } elseif ($_SESSION['role'] === 'Teacher') {

    header("refresh:2;url=teacher_page.php");
  }
  die();
}
