<?php
$url = $_SERVER['HTTP_REFERER'];
$url = 'home.php';
?>

<div style="font-size:12p;color:#0b4499;margin-bottom:0px;margin-left:30px;">
<form method="post" action="">
Username<br><input type="text" name="username" size="10" disabled=1 value="card"><br>
Password</font></b><br><input type="password" name="password" size="10"><br>
<input type="submit" name="Submit" value="Connexion" class="input"><br>
</form>
</div>

<?php
$user = 'card';
$password = $_POST['password'];
$ip = $_SERVER['REMOTE_ADDR'];

include ('inc/connect.php');
try {
$session = $client->Login($user, $password, $ip);
} catch(SoapFault $fault) {
echo "Error: ". $fault->faultstring;
}

@session_start();
$_SESSION['session'] = $session;
if ($session) echo '<meta http-equiv="refresh" content="0; url='.$url.'" />';
?>
