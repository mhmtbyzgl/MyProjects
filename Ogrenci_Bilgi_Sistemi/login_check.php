<?php
@session_start();
if (isset($_SESSION['loggedIn'])) {
} else {
  header("location: login.php");
  die();
}
