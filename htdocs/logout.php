<?php
session_start();

$ret= $_SESSION['sid'];
$client = new SoapClient("http://dv.komput.net/test/bocsy.wsdl", array('location' => "http://dv.komput.net/test/bocsy.php"));

try {
  $retl = $client->Logout($ret);
}
catch (SoapFault $fault)
{
trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}\n" .
  "faultstring: {$fault->faultstring})", E_USER_ERROR);
}
session_unset();
session_destroy();
echo $retl
?>
