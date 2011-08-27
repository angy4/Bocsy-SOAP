<?php

$client = new SoapClient("http://bocsy.komput.net/bocsy.wsdl", array('location' => "http://bocsy.komput.net/bocsy.php"));

$ip = $_SERVER['REMOTE_ADDR'];

echo "$ip<p>";
try {
	$ret =  $client->Login("rvpu7vl3y19", "crap", $ip);
}
catch (SoapFault $fault)
{
//trigger_error("SOAP Fault: (faultCode: {$fault->faultcode}\n" .
//"faultstring: {$fault->faultstring})", E_USER_ERROR);
echo "SOAP Fault: faultcode: {$fault->faultcode} <p> faultstring: {$fault->faultstring}";

}

if ($ret) {
echo("\n Testing login dummy: ")
. $ret;

echo("<p> Hi ") . $client->Username($ret);
echo("<p> Logout: ")
. $client->Logout($ret);
//echo("\n Logout") . $client->Logout("se");
echo("\n");
}
?>
