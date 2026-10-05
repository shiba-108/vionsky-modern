<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
include 'config.php';
include 'head.php';
echo "<div class='shout'>DELETE SELECTED";
$vmi=$_GET['vmi'];
echo "<p align='left'><a href='tables.php?k=$k'>Tables</a><br/>- - -<br/>";
if (!$vmi) {
$rec=$_POST['tb'];
if($rec) {
$nrs=0;
foreach ($rec as $aga) {
$nrs++; }
echo "You selected $nrs tables:<br/><br/>";
foreach ($rec as $ag) {
echo "$ag <br/>";
}
echo "<br/>DO YOU WANT TO DELETE TABLES ?<br/><br/>
<form action='?vmi=ionutvmi&k=$k&tb=$tb' method='post' align='left'>";
foreach ($rec as $files) {
echo "<input type='hidden' name='i[]' id='i[]' value='$files'/>";
}
echo "<input type='submit' value='YES DELETE'></form><br/> <a href='tables.php?k=$k'>Back</a>";} else {
echo "Nothing selected";
}
} else {
$fl=$_POST['i'];
foreach ($fl as $clm) {
$d=$connect->query("DROP TABLE `$clm`");
if ($d) {
echo "<br/>Table ".htmlspecialchars($clm)." droped !"; } else {
echo "<br/>Error: ";
echo mysql_error(); }
}
}
echo "</div>";
include('foot.php');
?>
