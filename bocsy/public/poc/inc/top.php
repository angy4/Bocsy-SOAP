<?php
include ('inc/session.php');
include ('inc/var.php');
?>

<html>
<head>
<title><?php echo $version; ?></title>
<link rel="stylesheed" type="text/css" href="style.css" title="default" media="screen" />
</head>
<body>
<div id="global">
<div id="header">
<h1><?php echo $version; ?></h1>
</div>
<?php
if ($HTTP_SCRIPT_NAME<>'login.php')
{
include ('menu.php');
}
else
{
include ('inc/login.php');
}
?>
<div id="content">
