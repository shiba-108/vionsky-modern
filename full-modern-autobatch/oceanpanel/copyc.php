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
COPY - $cl <p align='left'><a href='.php?k=$k'>Tables</a>><a href='table.php?k=$k&tb=$tb'>$tb</a>><a href='col.php?k=$k&tb=$tb&cl=$cl'>$cl</a><br/>- - -<br/>";
if(!$vmi) {
echo "<form action='?vmi=ionutvmi&k=$k&tb=$tb&cl=$cl' method='post' align='left'>
Copy to:<input name='nm' value='name2'><br/>
<input type='submit' value='Copy'></form>";
} else {
$nm=trim($_POST['nm']);
$d=$connect->query("ALTER TABLE `$tb` ADD `$nm` TEXT NOT NULL;");
$d=$connect->query("UPDATE `$tb` SET `$nm` = `$cl`;");
if ($d) {
echo "<b>
$cl </b> copyed to <b> $nm </b> !"; } else {
echo "Error: ";
echo mysql_error();
}
}
echo "</div>";
include('foot.php');
?>
