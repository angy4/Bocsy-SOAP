<?php
include ('inc/connect.php');
include ('inc/session.php');

$client->Logout($session);

session_unset();
session_destroy();


header ('location: index.php');
?>
