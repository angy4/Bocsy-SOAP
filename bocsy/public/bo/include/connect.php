<?php

$soap = new SoapClient("http://bocsy.komput.net/bocsy.wsdl", array('location' => "http://bocsy.komput.net/bocsy.php"));

try {
  $login = $user;
  $password = $pass;
  $ips = $ip;

  $session = $soap->Login($login, $password, $ip);
  } catch(SoapFault $fault) {
  echo "Error: " . $fault;
  include ('logout.php');
  }
?>
