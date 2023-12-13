<?php
require 'sayfa_ust.php';
require 'login_kontrol.php';
require_once('db.php');

if (isset($_POST['deleteSumbit'])) {
  if (isset($_POST['silmeOnayi']) && $_POST['silmeOnayi'] === 'Evet') {
    $id = $_GET['id'];

    $sql = "DELETE FROM nottab WHERE id = :id";
    $SORGU = $DB->prepare($sql);

    $SORGU->bindParam(':id', $id);

    if ($SORGU->execute()) {

      echo '<div class="alert text-center alert-success alert-dismissible fade show">
            Not silindi. Anasayfaya yönlendiriliyorsunuz...';
      header("refresh:2;url=index.php");
      die();
    }
  } else {
    echo '<div>
          <p class="alert text-center" style="background-color:yellow; color:red; margin-top: 10px; ">Silmek için onay kutusunu işaretlemeniz gerekmektedir.</p>';
  }
}
?>

<div class="container text-center">
  <div class="row">

    <div class="col-md-6 mx-auto text-center" style="background-color: #d2fafb;
    margin: 100px auto 20px;
    padding: 40px 30px 50px;
    border-radius: 20px;">


      <form method="POST">
        <label for="silmeKutucugu" style="background-color: red; font-size: 40px">Silmek istediğinize emin misiniz?</label><br /><br /><br />
        <label for="silmeKutucugu">Silme işlemine devam etmek için aşağıdaki kutucuğu işaretleyip silme işlemini onaylamanız ve ardından "Sil" butonuna basmanız gerekmektedir..</label><br /><br /><br />
        <label>Silme işlemini onaylıyorum.</label>
        <input type="checkbox" id="silmeKutucugu" name="silmeOnayi" value="Evet"><br />
        <input name="deleteSumbit" class="btn btn-danger" type="submit" value="Sil">
      </form>
    </div>
  </div>
</div>

<?php require 'sayfa_alt.php'; ?>