<?php

require 'login_check.php';
require 'permission_check_admin.php';
require_once('db.php');
if (isset($_POST['className']) && isset($_POST['selectedTeacher'])) {

  if (empty($_POST['className']) || empty($_POST['selectedTeacher'])) {
    $m = "Formlar boş bırakılamaz.";
    header("Location: add_new_class.php?error2=$m");
    die();
  }

  $className  = $_POST['className'];
  $selectedTeacher = $_POST['selectedTeacher'];

  $sql = "INSERT INTO classes (class_name, class_teacher_id) VALUES (:class_name, :class_teacher_id)";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':class_name', $className, PDO::PARAM_STR);
  $SORGU->bindParam(':class_teacher_id', $selectedTeacher, PDO::PARAM_INT);

  if ($SORGU->execute()) {
    $m = "Sınıf Eklendi.";
    header("Location: classes_info.php?error=$m");
    die();
  }
}
