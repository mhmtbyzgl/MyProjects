<?php
@session_start();
if (isset($_SESSION['girisyapti'])) {
} else {
  header("location: login.php");
  die();
}
