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
echo "<p align='left'><a href='tables.php?k=$k'>Tables</a>><a href='table.php?k=$k&tb=$tb'>$tb</a><br/>- - -<br/>";
if (!$vmi) {
$rec=$_POST['i'];
$nrs=0;
foreach ($rec as $aga) {
$nrs++; }
echo "You selected $nrs records:<br/><br/>";
foreach ($rec as $ag) {
$rec2=explode("^",$ag);
$agg=$rec2[1];
echo "$agg <br/>";
}
echo "DO YOU WANT TO DELETE RECORDS ?<br/><br/><br/>
<form action='?vmi=ionutvmi&k=$k&tb=$tb' method='post' align='left'>";
foreach ($rec as $files) {
echo "<input type='hidden' name='i[]' id='i[]' value='$files'/>";
}
echo "<input type='submit' value='YES, DELETE'></form><a href='br.php?k=$k&tb=$tb'>Back</a>";
} else {
$fl=$_POST['i'];
foreach ($fl as $clm) {
$pri=base64_decode($clm);
$d=$connect->query("DELETE FROM `$tb` WHERE $pri");
if ($d) {
echo "<br/>Record droped !"; } else {
echo "<br/>Error: ";
echo mysql_error(); }
}
}
}

echo "</div>";
include('foot.php');
?>
