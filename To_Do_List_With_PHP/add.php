<?php
require 'sayfa_ust.php';
require 'login_kontrol.php';
?>

<?php
$user_id = $_SESSION['id'];
if (isset($_POST['note_form'])) {
  if ($_POST['note_form'] == "") {
    echo '<div class="alert text-center alert-success alert-dismissible fade show" >
        Boş not kaydedilemez. Lütfen bir not giriniz. Anasayfaya yönlendiriliyorsunuz...</div>';
    header("refresh:2;url=index.php");
    die();
  } else {

    require_once('db.php');

    $notlar  = $_POST['note_form'];

    $sql = "INSERT INTO nottab (notlar, nottarihi, user_id) VALUES (:note_form, :nottarihi, :user_id)";
    $SORGU = $DB->prepare($sql);

    $SORGU->bindParam(':note_form',  $notlar);
    $SORGU->bindParam(':nottarihi',  date("Y-m-d H:i:s"));
    $SORGU->bindParam(':user_id',  $user_id);

    $SORGU->execute();
    echo '
      <div class="alert text-center alert-success alert-dismissible fade show" >
        Not başarı ile eklendi. Anasayfaya yönlendiriliyorsunuz...</div>
    ';

    header("refresh:2;url=index.php");
    die();
  }
} else {
  echo '
        <div class="alert text-center alert-danger alert-dismissible fade show" style="margin-top: 50px;>
          Not eklenirken bir hata oluştu... Anasayfaya yönlendiriliyorsunuz...
        </div>
        ';
  header("refresh:2;url=index.php");
  die();
}
