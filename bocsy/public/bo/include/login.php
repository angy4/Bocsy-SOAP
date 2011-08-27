<?php
$url = $_SERVER['HTTP_REFERER'];
$url = 'home.php';
?>

<div style="font-size:12px;color:#0b4499;margin-bottom:0px;margin-left:30px;">
 <form method="post" action="">
 Username<br><input type="text" name="nic" size="10"><br>
 Password</font></b><br><input type="password" name="passe" size="10"><br>
 <input type="submit" name="Submit" value="Connexion" class="input"><br>
 </form>
			 </div>

<?php
$nic = $_POST['nic'];
$nic = strtolower($nic);

if (!empty($nic))
{
@session_start();
$_SESSION['user'] = $nic;
$_SESSION['pass'] = $_POST['pass'];
$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];

echo '<meta http-equiv="refresh" content="0; url='.$url.'" />';
}
?>
