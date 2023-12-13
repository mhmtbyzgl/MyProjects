<?php
require 'login_check.php';
require 'permission_check_admin.php';
require_once('db.php');


if (isset($_POST['examScore'])) {

  $examScore  = $_POST['examScore'];
  $id    = $_GET['id'];

  if ($examScore > 100 || $examScore < 0) {
    $m = "Sınav Notu 0 ile 100 arasında olmalıdır.";
    header("Location: edit_exam.php?error=$m");
    die();
  }

  $sql = "UPDATE exams SET exam_score = :exam_score WHERE id = :id";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':exam_score', $examScore, PDO::PARAM_INT);
  $SORGU->bindParam(':id', $id, PDO::PARAM_INT);

  if ($SORGU->execute()) {
    $m = "Sınav Notu Güncellendi.";
    header("Location: exams_info.php?error=$m");
    die();
  }
}
