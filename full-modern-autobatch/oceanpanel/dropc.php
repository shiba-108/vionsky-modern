<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
include 'config.php';
include 'head.php';
$tb=trim($_GET['tb']);
$cl=trim($_GET['cl']);
$vmi=$_GET['vmi'];
echo "<div class='shout'>
DROP - $cl <p align='left'><a href='vmi.php?k=$k'>Tables</a>";
if (!$vmi)
{
echo "><a href='table.php?k=$k&tb=$tb'>$tb</a>><a href='col.php?k=$k&tb=$tb&cl=$cl'>$cl</a>><a href='?k=$k&tb=$tb&cl=$cl'>Drop</a><br/><br/>- - -<br/>DROP (DELETE) COLUMN $cl ? <br/><a href='?k=$k&tb=$tb&cl=$cl&vmi=ionutvmi'>Yes</a> | <a href='col.php?k=$k&tb=$tb&cl=$cl'>No</a>
"; } else {
$d=$connect->query("ALTER TABLE `$tb` DROP `$cl`");
if ($d) {
echo "><a href='table.php?k=$k&tb=$tb'>$tb</a><br/>- - -<br/>
Column $cl droped !"; } else {
echo "<br/>- - -<br/>Error: ";
echo mysql_error();
}
}
echo "</div>";
include('foot.php');
?>
