<?php
include ('inc/session.php');
include ('inc/top.php');
include ('inc/connect.php');

echo '<h2 style="font-size:12px;color:#0b4499;margin-bottom:0px;text-align:center;">Hi</h2>';
echo '<br><br>';

try {
  $user = $client->UserName($session);
  echo '<b>Logged in as: ' . $user . '.<br>';
}catch(SoapFault $fault) {
 echo $fault;
}

?>

<a href="logout.php">Logout</a>
</body>
</html>
