<?php
require 'login_check.php';
require 'permission_check_admin.php';
require_once('db.php');


if (isset($_POST['selectedClass'])) {

  $selectedClass  = $_POST['selectedClass'];
  $id    = $_GET['id'];

  $sql = "UPDATE classes_students SET class_id = :class_id WHERE class_id = :id";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':class_id', $selectedClass, PDO::PARAM_INT);
  $SORGU->bindParam(':id', $id, PDO::PARAM_INT);

  if ($SORGU->execute()) {
    $m = "Sınıf Güncellendi.";
    header("Location: students_info.php?error=$m");
    die();
  }
}
