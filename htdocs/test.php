<?php

$client = new SoapClient("http://dv.komput.net/test/bocsy.wsdl", array('location' => "http://dv.komput.net/test/bocsy.php"));


try {
  $ret = $client->Login("%4rvpu7vl3y19Éadjk", $ip);
}
catch (SoapFault $fault)
{
trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}\n" .
  "faultstring: {$fault->faultstring})", E_USER_ERROR);
}

echo $ret;
echo '<p>';
try {
  $retl = $client->Logout($ret);
}
catch (SoapFault $fault)
{
trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}\n" .
  "faultstring: {$fault->faultstring})", E_USER_ERROR);
}

echo $retl
?>
