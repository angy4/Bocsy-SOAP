<?php
$photo1 = $_POST['photo1'];
$photo2 = $_POST['photo2'];
$harm1 = $_POST['harm1'];
$harm2 = $_POST['harm2'];
$harm3 = $_POST['harm3'];
$harm4 = $_POST['harm4'];
$nda1 = $_POST['nda1'];
$nda2 = $_POST['nda2'];
$lia1 = $_POST['lia1'];
$lia2 = $_POST['lia2'];
$lia3 = $_POST['lia3'];

$t = $photo1 + $photo2 + $harm1 + $harm2
   + $harm3 + $harm4 + $nda1 + $nda2
   + $lia1 + $lia2 + $lia3;

if ($t != 11) { $t = 0; } else { $t = 1; }
$name = $_POST['name'];
$street = $_POST['street'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];
$sign = $_POST['sign'];
?>
<html>
<head>
<title>Return from waiver: <?php if ($t) { echo "Ok"; } else { echo "Fail"; }?></title>
</head>
<body>
<?php 
if (!$t) {
echo 'You did not accept all the required boxes, please <a href="waiver.html">go back</a>';
}
else {
echo '<h3>Thank you ' . $name . '</h3>';
}
?>
</body>
</html>
