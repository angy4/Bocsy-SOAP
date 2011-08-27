<?php
$client = new SoapClient("http://bocsy.komput.net/bocsy.wsdl", array('location' => "http://bocsy.komput.net/bocsy.php"));

$ip = $_SERVER['REMOTE_ADDR'];
try {
$session = $client->Login('card', '4rvpu7vl3y19', $ip, time());
} catch (SoapFault $fault) {
echo $fault->faultstring;
}

if (!$session) exit;
$last = $client->TLastLog($session);
?>
<html>
<head>
<title>This is BÖCSy alpha 1</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<h1>Welcome to BÖCSy</h1>
This is a test page, the paramaters are currently hardcoded.<p>

<h2>Welcome <?php echo $client->Username($session); ?></h2>
Your last login was:<br>
Login: <?php echo date('r', substr($last, 0, 10)); ?><br>
Logout: <?php echo date('r', substr($last, 10, 22)); ?><br>
And you were doing
<?php
$did = $client->TLastDo($session);
echo "Role: " . $did->LastRole . "<br>";
echo "Job: " . $did->LastJob . "<br>";
echo "Room: " . $did->LastRoom . "<br>";
?>

You are now going to do some things.<br>
<?php $client->TLogin($session, 2, 25, 12);
sleep(2);
?>
You were doing things for 2 seconds, now we logout.<br>
<?php $client->TLogout($session);
$client->Logout($session);
?>
<p>
Thanks! Refresh this page now.
</body>
</html>
