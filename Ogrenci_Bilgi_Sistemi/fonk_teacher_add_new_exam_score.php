<?php
require 'login_check.php';
require 'permission_check_teacher.php';
require_once('db.php');


if (!empty($_POST['studentName']) && !empty($_POST['lessonName']) && !empty($_POST['examScore'])) {

  $student_id  = $_POST['studentName'];
  $lesson_id  = $_POST['lessonName'];
  $examScore  = $_POST['examScore'];

  if ($examScore > 100 || $examScore < 0) {
    $m = "Sınav Notu 0 ile 100 arasında olmalıdır.";
    header("Location: teacher_add_new_exam_score.php?error2=$m");
    die();
  }

  $SORGU = $DB->prepare("SELECT class_id FROM classes_students WHERE student_id = :student_id");
  $SORGU->bindParam(':student_id', $student_id, PDO::PARAM_INT);
  $SORGU->execute();
  $class = $SORGU->fetchAll(PDO::FETCH_ASSOC);
  $class_id = $class[0]['class_id'];

  if ($class_id == NULL) {

    $m = "Sınıfı olmayan öğrenciye not ekleyemezsiniz.";
    header("Location: teacher_add_new_exam_score.php?error2=$m");
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
    header("Location: teacher_add_new_exam_score.php?error=$m");
    die();
  }
} else {
  $m = "Form alanları boş bırakılamaz.";

  header("Location: teacher_add_new_exam_score.php?error2=$m");
  die();
}
