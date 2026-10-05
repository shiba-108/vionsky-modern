<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
include 'config.php';
include 'head.php';
$tb=trim($_GET['tb']);

echo "<div class='shout'>DELETE SELECTED";
$result = $connect->query("SELECT * FROM `$tb`");
if (!$result) {
echo "Table not exist !"; } else {
$vmi=$_GET['vmi'];
echo "<p align='left'><a href='vmi.php?k=$k'>Tables</a>><a href='table.php?k=$k&tb=$tb'>$tb</a><br/>- - -<br/>";
if (!$vmi) {
$rec=$_POST['i'];
$nrs=0;
foreach ($rec as $aga) {
$nrs++; }
echo "You selected $nrs columns:<br/><br/>";
foreach ($rec as $ag) {
echo "$ag <br/>";
}
echo "DO YOU WANT TO DELETE COLUMNS ?<br/><br/><br/>
<form action='?vmi=ionutvmi&k=$k&tb=$tb' method='post' align='left'>";
foreach ($rec as $files) {
echo "<input type='hidden' name='i[]' id='i[]' value='$files'/>";
}
echo "<input type='submit' value='YES, DELETE'></form> <a href='table.php?k=$k&tb=$tb'>Back</a>";
} else {
$fl=$_POST['i'];
foreach ($fl as $clm) {
$d=$connect->query("ALTER TABLE `$tb` DROP `$clm`");
if ($d) {
echo "<br/>Column $clm droped !"; } else {
echo "<br/>Error: ";
echo mysql_error(); }
}
}
}

echo "</div>";
include('foot.php');
?>