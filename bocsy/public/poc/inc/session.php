<?php

@session_start();
$session = $_SESSION['session'];
if (empty($session))
  {
  echo '<meta http-equiv="refresh" content="0; url=login.php" />';
  exit;
  }

?>
