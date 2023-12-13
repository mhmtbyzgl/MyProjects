<?php
require 'login_check.php';
require 'permission_check_admin.php';
require_once('db.php');



if (isset($_POST['lessonName']) && isset($_POST['selectedTeacher'])) {

  $lessonName  = $_POST['lessonName'];
  $selectedTeacher = $_POST['selectedTeacher'];
  $id    = $_GET['id'];

  $sql = "UPDATE lessons SET lesson_name = :lesson_name, teacher_user_id = :teacher_user_id WHERE id = :id";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':lesson_name', $lessonName, PDO::PARAM_STR);
  $SORGU->bindParam(':teacher_user_id', $selectedTeacher, PDO::PARAM_INT);
  $SORGU->bindParam(':id', $id, PDO::PARAM_INT);

  if ($SORGU->execute()) {
    $m = "Ders Güncellendi.";
    header("Location: lessons_info.php?error=$m");
    die();
  }
}
