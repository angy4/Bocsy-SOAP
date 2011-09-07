<?php

require_once('misc.php');

class Bocsy {

public function Login($user, $pass, $ip)
{
  if ($user[0] == '%') {
  $post = strpos($user, 'É');
  $user_b = substr($user, 1, $post);
  $q = ("SELECT id FROM forum_xref WHERE crypt='$pass'");
  $r = Misc::db_query($q);
  $s = Misc::db_sel($r);

  if (!$s) throw new SoapFault('client', "Bad Login", 'global', 'details', 'FailureMessage');

  $q = ("SELECT name FROM timeaccounting_waiver WHERE id='%s'");
  $r = Misc::db_query($q);
  $s1 = Misc::db_sel($r);

