<?php
 function get_userid($crypt)
  {
    $wp = new mysqli('mysql.ibexdelta.net', 'inds', '37d0f4add3ade1bc1e24864447c969f6', 'tgg');
    $by = new mysqli('mysql.ibexdelta.net', 'inds', '37d0f4add3ade1bc1e24864447c969f6', 'donecvulputate');
    $xrefg = $by->query("SELECT * from forum_xref WHERE `crypt` = '".$crypt."'");
    $xref = $xrefg->fetch_row();

printf ("$xref[0] \n");

    $waiveg = $by->query("SELECT * from timeaccounting_waiver WHERE `xrefid` = '".$xref['0']."'");
    if (!$waiveg->fetch_row())
      return 0;
    else
      return $xref[1];
  }

$uid = get_userid('gdvbwcwebzc0');

echo $uid . '\n';

?>
