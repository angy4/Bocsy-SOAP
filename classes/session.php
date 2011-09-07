<?php

require_once('misc.php');

class Session {

  public function create($user, $ip)
  {
    $time = time();
    $token = Misc::rand_token();
    $q = ("INSERT INTO session (session, uid, ip, timestart) VALUES ('$token', '$user', '$ip', '$time')");
    Misc::db_insert($q);
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
}
    
class Auth {

  public function Login($user, $pass, $ip)
  {
    if ($user == 'card') {
    $q = ("SELECT id FROM forum_xref WHERE crypt='$pass'");
    $r = Misc::db_query($q);
    $s = Misc::db_selt($r);

    if (!$s) throw new SoapFault('client', "Bad Login", 'global', 'details',  'FailureMessage'); 

    $q = ("SELECT name FROM timeaccounting_waiver WHERE id='$s'");
    $r = Misc::db_query($q);
    $s1 = Misc::db_selt($r);
 
    if (!$s1) throw new SoapFault('client', "No waiver"); 

    return Session::create($s, $ip);
    } else {
    throw new SoapFault('client', "Unimplemented");
    }
  }

  public function UserName($session)
  {
    $q = ("SELECT uid FROM session WHERE session='$session'");
    $r = Misc::db_query($q);
    $s = Misc::db_selt($r);

    $q = ("SELECT name FROM timeaccounting_waiver WHERE id='$s'");
    $r = Misc::db_query($q);
    $s = Misc::db_selt($r);  

    if (!$s) throw new SoapFault('client', 'No session!');
    return $s;

  } 
 
  public function GetUID($session)
  {
    $q = ("SELECT uid FROM session WHERE session='$session'");
    $r = Misc::db_query($q);
    $s = Misc::db_selt($r);

    if (!$s) throw new SoapFault('client', 'No session!');
    return $s;
  }
  
  public function TLogin($session, $role, $room, $job)
  {
    $timestamp = time();
    $uid = Auth::GetUID($session);
    if (!$uid) throw new SoapFault('client', 'No session!');

    $q = ("INSERT INTO TLogin (uid, role, room, job, timestart) VALUES ('$uid', '$role', '$room', '$job', '$timestamp')");
    $r = Misc::db_query($q);

    if (!$r) throw new SoapFault('client', 'SQL Fault');
    return 1;
  }

  public function TLogout($session)
  {
    $timestamp = time();
    $uid = Auth::GetUID($session);
    if (!$uid) throw new SoapFault('client', 'No session!');

    //Select id of entry for user where timestop = NULL
    //If more than one, close all sessions (tbd)
    $q = ("SELECT COUNT(id) FROM TLogin WHERE uid='$uid' AND timestop IS NULL");
    $r = Misc::db_query($q);
    $s = Misc::db_selt($r);

    if ($s == '0') throw new SoapFault('client', 'Not Logged int!');
    if ($s == '1')
    {
      $q = ("SELECT id FROM TLogin WHERE uid='$uid' AND timestop IS NULL");
      $r = Misc::db_query($q);
      $s = Misc::db_selt($r);

      $q = ("UPDATE TLogin SET timestop='$timestamp' WHERE id='$s'");
      $r = Misc::db_query($q);
      if (!$r) throw new SoapFault('client', 'SQL Fault');

      return 1;
    }

    throw new SoapFault('client', 'Ask for an admin, RIGHT NOW');
  }

  public function TLastLog($session)
  {
  $uid = Auth::GetUID($session);
  if (!$uid) throw new SoapFault('client', 'No session!');

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
    'LastRoom' => ''
  );
  $uid = Auth::GetUID($session);
  if (!$uid) throw new SoapFault('client', 'No session!');

  $q = ("SELECT role, room, job FROM TLogin WHERE uid='$uid' ORDER BY timestart DESC LIMIT 1");
  $r = Misc::db_query($q);
  $s = Misc::db_row($r);

  $response = array(
    'LastRole' => $s[0],
    'LastJob' => $s[2],
    'LastRoom' => $s[1]
  );

  return new SoapParam($response, 'TLastDo');
  }


  public function Logout($session)
  {
    return Session::destroy($session);
  }
}
