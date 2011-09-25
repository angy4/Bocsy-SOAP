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

  $q = ("SELECT name FROM timeaccounting_waiver WHERE xrefid='$s'");
  $r = Misc::db_query($q);
  $w = Misc::db_sel($r);

  if (!$w) throw new SoapFault('client', "No waiver");

  return Session::create($s, $ip);
  } else {
  return 0;  
#wp login
  }
}

public function Logout($session)
{
  return Session::destroy($session);
}

public function UserName($session)
{
  if (!Session::active($session)) 
  {
    throw new SoapFault('client', 'Session inactive');
    Session::destroy();
    // Move destroy part into Session class?
  }

  $q = ("SELECT name FROM timeaccounting_waiver WHERE xrefid=(SELECT uid FROM session WHERE session='$session')");
  $r = Misc::db_query($q);
  $s = Misc::db_sel($r);

  if (!$s) throw new SoapFault('client', 'Internal Error when fetching result from UserName');
  return $s;
}

public function GetUID($session)
{
  if (!Session::active($session))
  {
    throw new SoapFault('client', 'Session inactive');
    Session::destroy();
    // Move destroy part into Session class?
  }

  $q = ("SELECT uid FROM session WHERE session='$session'");
  $r = Misc::db_query($q);
  $s = Misc::db_sel($r);

  if (!$s) throw new SoapFault('client', 'Internal Error when fetching result from GetUID');
  return $s;
}

public function TLogin($session, $role, $room, $job)
{
}

public function TLogout($session)
{
}

public function TLastLog($session)
{
  $uid = Bocsy::GetUID($session);

  $q = ("SELECT timestart, timestop FROM TLogin WHERE uid='$uid' ORDER BY timestart DESC LIMIT 1");
  $r = Misc::db_query($q);
  $s = Misc::db_row($r);

  return $s[0] . $s[1];
}

public function TLastDo($session)
{
  $TLastDo = array(
    'LastRole' => '',
    'LastJob' => '',
    'LastRoom' => '',
    'Finish' => ''
  );

  $uid = Bocsy::GetUID($session);

  $q = ("SELECT role, job, room, timestop FROM TLogin WHERE uid='$uid' OREDER BY timestart DESC LIMIT 1");
  $r = Misc::db_query($q);
  $s = Misc::db_row($r);

  $response = array(
    'LastRole' => $s[0],
    'LastJob' => $s[1],
    'LastRoom' => $s[2],
    'Finish' => $s[3]
  );

  return new SoapParam($response, 'TLastDo');
}

public function GetJobList($session)
{
  $DLS = array(
    'id' => array(),
    'job' => array()
  );

  $q = ("SELECT id, name FROM timeaccounting_jobnames ORDER BY id ASC");
  $r = Misc::db_query($q);
  $i = 0;
  while ($s = mysqli_fetch_row($r)) {
    $DLS['id'][$i] = $s[0];
    $DLS['job'][$i] = $s[1];
    $i++;
  }
  $r->close();

  return new SoapParam($DLS, 'JobResponse');
}

}
?>
