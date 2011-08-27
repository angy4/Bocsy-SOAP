<?php

class Misc {

  public function rand_token($len = 22)
  {
    $len = max(2, $len);
    $len = min(50, $len);
    $fp = fopen('/dev/urandom', 'r');
    $token = fread($fp, $len * 4);
    fclose($fp);
    $token = base64_encode($token);
    $token = preg_replace("![Il10O+/]!", "", $token);
    $token = substr($token, 0, $len);
    return $token;
  }

  private function db_connect()
  {
    $db = new mysqli('mysql.ibexdelta.net', 'inds', '37d0f4add3ade1bc1e24864447c969f6', 'donecvulputate');
    return $db;
  }

  public function db_query($q)
  {
    $db = Misc::db_connect();
    $xq = $db->query($q);
    return $xq;
  }

  public function db_insert($s)
  {
    $db = Misc::db_connect();
    $xq = $db->query($s);
    return 0;
  }

  public function db_row($q)
  {
    return $q->fetch_row();
  }

  public function db_selt($q)
  {
    $t = $q->fetch_row();
    return $t[0];
  }
}
