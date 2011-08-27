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

$last = $client->TLastLog($ret);
echo "<br>Last login: " . date('r', substr($last, 0, 10));
echo " Last Logout: " . date('r', substr($last, 10, 22));


echo "<br>" .
$client->TLogin($ret, 2, 25, 12);

sleep(2);
echo "<br> TLogout: " ; 
try {
echo "jkl :" . $client->TLogout($ret);
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
