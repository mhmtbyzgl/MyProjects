<?php
require 'login_check.php';
require 'permission_check_admin.php';
require_once('db.php');


if (isset($_POST['selectedStudent']) && isset($_POST['selectedClass'])) {

  if (empty($_POST['selectedStudent']) || empty($_POST['selectedClass'])) {
    $m = "Formlar boş bırakılamaz.";
    header("Location: add_student_to_class.php?error2=$m");
    die();
  }

  $selectedStudent  = $_POST['selectedStudent'];
  $selectedClass = $_POST['selectedClass'];

  $sql = "INSERT INTO classes_students (student_id, class_id) VALUES (:student_id, :class_id)";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':student_id', $selectedStudent, PDO::PARAM_INT);
  $SORGU->bindParam(':class_id', $selectedClass, PDO::PARAM_INT);

  if ($SORGU->execute()) {
    $m = "Öğrenci Eklendi.";
    header("Location: students_info.php?error=$m");
    die();
  }
}
