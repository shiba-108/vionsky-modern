<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
include 'config.php';
include 'head.php';


$tb=trim($_GET['tb']);
$vmi=$_GET['vmi'];
echo "<div class='shout'>
DROP - $tb <p align='left'><a href='tables.php?k=$k'>Tables</a>";
if (!$vmi)
{
echo "><a href='table.php?k=$k&tb=$tb'>$tb</a>><a href='?k=$k&tb=$tb'>Drop</a><br/><br/>- - -<br/>DROP (DELETE) TABLE $tb ? <br/><br/><a href='?k=$k&tb=$tb&vmi=ionutvmi'>Yes</a> | <a href='table.php?k=$k&tb=$tb'>No</a>
"; } else {
$sql="DROP TABLE `$tb`";
$d=$connect->query($sql);
if ($d) {
echo "<br/>- - -<br/><center>Query: <i>".htmlspecialchars($sql)."</i></center><p align='left'>
Table $tb droped !"; } else {
echo "<br/>- - -<br/><center>Query: <i>".htmlspecialchars($sql)."</i></center><p align='left'>Error: ";
echo mysql_error();
}
}
echo "</div>";
include('foot.php');
?>
