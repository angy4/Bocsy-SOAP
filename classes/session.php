<?php

require_once('misc.php');

class Session {

public function create($user, $ip)
{
  $time = time();
  $token = Misc::rand_token();
  $q = ("INSERT INTO session (session, uid, ip, timestart) VALUES ('$token', '$user', '$ip', '$time')");
  Misc::db_query($q);
  return $token;
}

public function destroy($session)
{
  $q = ("SELECT session FROM session WHERE session='$session'");
  $r = Misc::db_query($q);
  $s = Misc::db_row($r);
  if (!$s) return 0;

  $q = ("DELETE FROM session WHERE session='$session'");
  $r = Misc::db_query($q);
  return 1;
}

public function active($session)
{
  $q = ("SELECT timestart FROM session WHERE session='$session'");
  $r = Misc::db_query($q);
  $s = Misc::db_sel($r);

// destroy session here?
  if ($s - 200 > time()){
   return 0;
  } else {
    // regen session
    $time = time();
    $q = ("UPDATE session SET timestart='$time' WHERE timestart='$s'");
    $r = Misc::db_query($q);
    if ($r) return 1;
    return -1;
  }
}

}

?>
