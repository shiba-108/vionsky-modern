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
COPY - $tb <p align='left'><a href='tables.php?k=$k'>Tables</a>";
if(!$vmi) {
echo "><a href='table.php?k=$k&tb=$tb'>$tb</a><br/>- - -<br/><form action='?vmi=ionutvmi&k=$k&tb=$tb' method='post' align='left'>
Copy to:<input name='nm' value='table2'><br/>
<select name='tp'><option value='1'>Copy structure + data</option><option value='2'>Copy structure</option></select><br/><input type='submit' value='Copy'></form>";
} else {
$tp=trim($_POST['tp']); $nm=trim($_POST['nm']);
if ($tp=='1') {
$d=$connect->query("CREATE TABLE `$nm` SELECT * FROM `$tb`");
if ($d) {
echo "<br/>- - -<br/><b>
$tb </b> copyed to <b> $nm </b> !"; } else {
echo "<br/>- - -<br/>Error: ";
echo mysql_error();
}
} elseif ($tp=='2') {
$d=$connect->query("CREATE TABLE `$nm` LIKE `$tb`");
if ($d) {
echo "<br/>- - -<br/><b>
$tb structure</b> copyed to <b> $nm </b> !"; } else {
echo "<br/>- - -<br/>Error: ";
echo mysql_error();
}
}

}
echo "</div>";
include('foot.php');
?>
