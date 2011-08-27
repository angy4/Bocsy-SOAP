<?php

@session_start();
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
if (empty($user)) {
  echo '<meta http-equiv="refresh" content="0; url=login.php" />';
  exit; }
?>
