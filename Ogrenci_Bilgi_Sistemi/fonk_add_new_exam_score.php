<?php
require 'login_check.php';
require 'permission_check_admin.php';
require_once('db.php');


if (!empty($_POST['examScore'])) {

  $examScore  = $_POST['examScore'];
  $lesson_id  = $_POST['lessonName'];
  $student_id  = $_POST['studentName'];

  if ($examScore > 100 || $examScore < 0) {
    $m = "Sınav Notu 0 ile 100 arasında olmalıdır.";
    header("Location: add_new_exam_score.php?error2=$m");
    die();
  }

  $SORGU = $DB->prepare("SELECT class_id FROM classes_students WHERE student_id = :student_id");
  $SORGU->bindParam(':student_id', $student_id, PDO::PARAM_INT);
  $SORGU->execute();
  $class = $SORGU->fetchAll(PDO::FETCH_ASSOC);
  $class_id = $class[0]['class_id'];

  if ($class_id == NULL) {

    $m = "Sınıfı olmayan öğrenciye not ekleyemezsiniz.";
    header("Location: add_new_exam_score.php?error2=$m");
    die();
  }

  $sql = "INSERT INTO exams (exam_score, student_id, lesson_id, class_id) VALUES (:exam_score, :student_id, :lesson_id, :class_id)";
  $SORGU_2 = $DB->prepare($sql);
  $SORGU_2->bindParam(':exam_score', $examScore, PDO::PARAM_INT);
  $SORGU_2->bindParam(':lesson_id', $lesson_id, PDO::PARAM_INT);
  $SORGU_2->bindParam(':student_id', $student_id, PDO::PARAM_INT);
  $SORGU_2->bindParam(':class_id', $class_id, PDO::PARAM_INT);

  if ($SORGU_2->execute()) {
    $m = "Sınav Notu Eklendi.";
    header("Location: add_new_exam_score.php?error=$m");
    die();
  }
} else {
  $m = "Formlar boş bırakılamaz.";
  header("Location: add_new_exam_score.php?error2=$m");
  die();
}
