<?php
include ('include/var.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
         <title><?php echo $version; ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
         <link rel="shortcut icon" href="favicon.gif" type="image/ico" />
        <link rel="stylesheet" type="text/css" href="style.css" title="default" media="screen" />
</head>
<body>

        <div id="global">


                <div id="header">
                        <h1> <?php echo $version; ?></h1> <!-- Pour l'accessibilit√© :) -->
                        <p><?php echo $titre2; ?></p>
                </div>

                <!-- D√©but du menu -->

                <?php

		include ('include/login.php');
                ?>

                <div id="contenu">
