<?php
require 'login_check.php';
require 'permission_check_admin.php';
require_once('db.php');



if (isset($_POST['className']) && isset($_POST['selectedTeacher'])) {

  $className  = $_POST['className'];
  $selectedTeacher = $_POST['selectedTeacher'];
  $id    = $_GET['id'];

  $sql = "UPDATE classes SET class_name = :class_name, class_teacher_id = :class_teacher_id WHERE id = :id";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':class_name', $className, PDO::PARAM_STR);
  $SORGU->bindParam(':class_teacher_id', $selectedTeacher, PDO::PARAM_INT);
  $SORGU->bindParam(':id', $id, PDO::PARAM_INT);

  if ($SORGU->execute()) {
    $m = "Sınıf Güncellendi.";
    header("Location: classes_info.php?error=$m");
    die();
  }
}
