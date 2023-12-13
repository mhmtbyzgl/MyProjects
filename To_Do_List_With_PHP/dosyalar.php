<?php
require 'sayfa_ust.php';
require 'login_kontrol.php';

$hedefKlasor = "./Dosyalar/";

// Klasördeki dosyaları al
$dosyalar = scandir($hedefKlasor);

// "." ve ".." girdilerini kaldır
$dosyalar = array_diff($dosyalar, array(".", ".."));

// Dosya listesini alfabetik sıraya göre sırala
sort($dosyalar);

if (count($dosyalar) === 0) {
  echo "Henüz herhangi bir dosya yüklenmemiş.";
} else {
}
?>


<div class="container">
  <div class="row">
    <div class="col-md-6 mx-auto text-center" style="background-color: #d2fafb;
    margin: 100px auto 20px;
    padding: 40px 30px 50px;
    border-radius: 20px;
    align-items: center;">
      <ul style='list-style-type: none; padding-left: 0rem;'>
        <?php
        echo "<div style='background-color:white; border-radius: 20px; padding-top: 10px;'><h1>Yüklenen Dosyalar</h1><br>
        <h6>İndirmek istediğiniz dosyanın üzerine tıklayınız.</h6><br></div><br>";
        foreach ($dosyalar as $dosya) {
          echo "<li><a style='text-decoration: none; color: black; font-size: 30px;' href=\"$hedefKlasor$dosya\" download>$dosya</a></li>";
        }
        ?>
      </ul>
    </div>

  </div>
</div>

<?php require 'sayfa_alt.php'; ?>