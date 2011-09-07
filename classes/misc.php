<?php

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

function db_connect()
{
  $db = new mysqli('#host#', '#login#', '#pass#', '#db#');
  return $db;
}

function db_query($a)
{
  $db = Misc::db_connect();
  $xq = $db->query($q);
  return $xq;
}



