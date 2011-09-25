<?php

include_once('db.php');

class Misc {

public function rand_token($len = 22)
{
  $len = max(2, $len);
  $len = min(50, $len);
  $fp = fopen('/dev/urandom', 'r');
  $token = fread($fp, $len * 3);
  fclose($fp);
  $token = base64_encode($token);
  $token = preg_replace("![Il10O+/]!", "", $token);
  $token = substr($token, 0, $len);
  return $token;
}

function db_query($q)
{
  $db = DB::db_connect();
  $xq = $db->query($q);
  return $xq;
}

function wp_query($q)
{
  $db = DB::wp_connect();
  $xq = $db->query($q);
  return $xq;
}

function db_row($q)
{
  return $q->fetch_row();
  $q->close();
}

function db_wrow($q)
{
  return $q->fetch_row();
}

function db_sel($q, $pos = 0)
{
  $t = $q->fetch_row();
  $q->close();
  return $t[$pos];
}

}

?>
