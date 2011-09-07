<?php

require_once('misc.php');
require_once('session.php');

class Bocsy {

public function Login($user, $pass, $ip)
{
  if ($user[0] == '%') {
  $post = strpos($user, 'É');
  $user_b = substr($user, 1, $post - 1);
  $q = ("SELECT id FROM forum_xref WHERE crypt='$user_b'");
  $r = Misc::db_query($q);
  $s = Misc::db_sel($r);
  
  if (!$s) throw new SoapFault('client', "Bad Login", 'global', 'details', 'FailureMessage');

  $q = ("SELECT name FROM timeaccounting_waiver WHERE id='$s'");
  $r = Misc::db_query($q);
  $w = Misc::db_sel($r);

  if (!$w) throw new SoapFault('client', "No waiver");

  return Session::create($s, $ip);
  } else {
  return 0;  
#wp login
  }
}

}
?>
