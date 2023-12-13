<?php
require 'login_check.php';
require 'permission_check_admin.php';
require_once('db.php');


if (isset($_POST['lessonName']) && isset($_POST['selectedTeacher'])) {

  if (empty($_POST['lessonName']) || empty($_POST['selectedTeacher'])) {
    $m = "Formlar boş bırakılamaz.";
    header("Location: add_new_lesson.php?error2=$m");
    die();
  }

  $lessonName  = $_POST['lessonName'];
  $selectedTeacher = $_POST['selectedTeacher'];

  $sql = "INSERT INTO lessons (lesson_name, teacher_user_id) VALUES (:lesson_name, :teacher_user_id)";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':lesson_name', $lessonName, PDO::PARAM_STR);
  $SORGU->bindParam(':teacher_user_id', $selectedTeacher, PDO::PARAM_INT);

  if ($SORGU->execute()) {
    $m = "Ders Eklendi.";
    header("Location: lessons_info.php?error=$m");
    die();
  }
}
