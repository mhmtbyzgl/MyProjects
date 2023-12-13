<?php
require 'sayfa_ust.php';
require 'login_kontrol.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $hedefKlasor = "./Dosyalar/";
  $desteklenenTipler = ["pdf", "doc", "docx", "xls", "xlsx", "txt"];

  $dosya = $_FILES["dosya"];

  $dosyaIsmi = $dosya["name"];
  $dosyaTipi = strtolower(pathinfo($dosyaIsmi, PATHINFO_EXTENSION));

  if (!in_array($dosyaTipi, $desteklenenTipler)) {
    echo "Sadece PDF, DOC, XLS ve TXT dosyaları yüklenebilir.";
  } else {
    $hedefYol = $hedefKlasor . $dosyaIsmi;
    if (move_uploaded_file($dosya["tmp_name"], $hedefYol)) {
      echo '<div class="alert text-center alert-success alert-dismissible fade show" >
      Dosya başarıyla yüklendi.</div>"';
    } else {
      echo '<div class="alert text-center alert-success alert-dismissible fade show" >
      Dosya yüklenirken bir hata oluştu!!!</div>"';
    }
    header("refresh:1;url=dosya_yukleme.php");
    die();
  }
}
?>
<div class="container">
  <div class="row">

    <div class="col-md-6 mx-auto text-center" style="background-color: #d2fafb;
    margin: 100px auto 20px;
    padding: 40px 30px 50px;
    border-radius: 20px;">

      <p>
        Sık kullanılan formlar sayfasına buradan dosya yüklemesi yapabilirsiniz.
      </p>
      <form method="POST" action="" enctype="multipart/form-data">
        Dosya Seçin:
        <input class="btn btn-warning" type="file" name="dosya"><br><br>
        <input type="submit" class="btn btn-primary" value="Yükle">
      </form>
    </div>
  </div>
</div>


<?php require 'sayfa_alt.php'; ?>