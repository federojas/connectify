<?php
  session_start();
  session_destroy();
  setcookie("RECORDAR", null, -1);
  header("location:index.php");
?>
