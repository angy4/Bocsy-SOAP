<?php

include('../classes/bocsy.php');

ini_set("soap.wsdl_cache_enabled", "0");
$server = new SopaServer("bocsy.wsdl");

$server->setClass("Bocsy");

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
$server->handle();
}
else
{
  $wsdl = @implode('', @file('bocsy.wsdl'));
  if (strlen($wsdl) > 1)
  {
    header("Content-Type: text/xml");
    echo $wsdl;
  }
}

?>
