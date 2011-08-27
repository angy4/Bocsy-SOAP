<?php

$client = new SoapClient("http://bocsy.komput.net/bocsy.wsdl", array('location' => "http://bocsy.komput.net/bocsy.php"));

$ip = $_SERVER['REMOTE_ADDR'];

echo "$ip<p>";
try {
	$ret =  $client->Login("card", "4rvpu7vl3y19", $ip);
}
catch (SoapFault $fault)
{
trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}\n" .
"faultstring: {$fault->faultstring})", E_USER_ERROR);
}

if ($ret) {
echo("\n Testing login dummy: ")
. $ret;

echo("<p> Hi ") . $client->Username($ret);
echo "<br>" .
$client->TLogin($ret, 2, 25, 12, NULL);

sleep(20);
echo "<br> TLogout: " ; 
try {
echo $client->TLogout($ret, NULL);
}
catch (SoapFault $fault)
{
echo "SOAP Fault: (faultcode: {$fault->faultcode}\n" .
"faultstring: {$fault->faultstring})";
}

echo("<p> Logout: ")
. $client->Logout($ret);
//echo("\n Logout") . $client->Logout("se");
echo("\n");
}
?>
