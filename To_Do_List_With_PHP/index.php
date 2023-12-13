<?php
require 'sayfa_ust.php';
require 'login_kontrol.php';
?>

<body class="p-3 mb-2 bg-info text-dark">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mx-auto text-center" style="margin-top: 20px;">
        <h1 style="color: purple;">Not Listem</h1>

        <form method="POST" class="mb-3">
          <div class="input-group">
            <input class="form-control" type="text" name="note_search_form" placeholder="Not Arayın...">
            <button type="submit" class="btn btn-success">ARA</button>
          </div>
        </form>

        <form action="add.php" method="POST">
          <div class="input-group">
            <input class="form-control" name="note_form" type="text" placeholder="Not Ekleyin...">
            <button type="submit" class="btn btn-success">EKLE</button>
          </div>
        </form>
      </div>
      <div>
        <h2 style="color: purple;">Not Listesi</h2>
        <table class="table table-bordered table-striped text-center">
          <thead>
            <tr>
              <th style="color: purple;">Yapıldı</th>
              <th style="color: purple;">Notlar</th>
              <th style="color: purple;">Not Tarihi</th>
              <th style="color: purple;">Güncelle/Sil</th>
            </tr>
          </thead>
          <tbody>
            <?php

            require_once('db.php');

            $user_id = $_SESSION['id'];

            if (isset($_POST['note_search_form'])) {

              $inputSearch = $_POST['note_search_form'];
              $inputSearch = "%{$inputSearch}%";


              $sql = "SELECT * FROM nottab
              WHERE 
                (notlar LIKE :note_search_form OR
                nottarihi LIKE :note_search_form) AND user_id = :user_id AND status = 'false'
                LIMIT 100";
              $SORGU = $DB->prepare($sql);
              $SORGU->bindParam(':note_search_form', $inputSearch);
              $SORGU->bindParam(':user_id', $user_id);
              $SORGU->execute();
              $noteSearch = $SORGU->fetchAll(PDO::FETCH_ASSOC);

              if (count($noteSearch) == 0) {
                echo '<p class="alert text-center alert-success alert-dismissible fade show">Aramanızı içeren bir notunuz bulunmamaktadır.</p>';
              } else {
                foreach ($noteSearch as $search) {
                  echo "
                    <tr>
                      <td><input type='button' name='status_change' value='{$search['status']}'></td>
                      <td>{$search['notlar']}</td>    
                      <td>{$search['nottarihi']}</td>    
                      <td><a href='update.php?id={$search['id']}' class='btn btn-success btn-sm'>Güncelle</a>  <a href='delete.php?id={$search['id']}' class='btn btn-danger btn-sm'>Sil</a></td>
                    </tr> 
                ";
                }
              }
            } else {

              $sql = "SELECT * FROM nottab WHERE user_id = :user_id AND status = 'false' LIMIT 100";
              $SORGU = $DB->prepare($sql);
              $SORGU->bindParam(':user_id', $user_id);
              $SORGU->execute();
              $nottab = $SORGU->fetchAll(PDO::FETCH_ASSOC);

              if (count($nottab) == 0) {
                echo '<p class="alert text-center alert-success alert-dismissible fade show">Hiç notunuz bulunmamaktadır.</p>';
              } else {

                foreach ($nottab as $not) {
                  echo "
                    <tr>
                      <td><a href='status.php?id={$not['id']}' name='status_change' class='btn btn-success btn-sm'>Yapıldı</td>
                      <td>{$not['notlar']}</td>    
                      <td>{$not['nottarihi']}</td>    
                      <td><a href='update.php?id={$not['id']}' class='btn btn-success btn-sm'>Güncelle</a>  <a href='delete.php?id={$not['id']}' class='btn btn-danger btn-sm'>Sil</a></td>
                    </tr> 
                ";
                }
              }
            }

            ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php require 'sayfa_alt.php'; ?>