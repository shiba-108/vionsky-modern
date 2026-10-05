<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
include 'config.php';
include 'head.php';
$sql = "SHOW TABLES FROM `$dbn`";
echo "<div class='shout'><b>TABLES</b><br/>Query: <i>".htmlspecialchars($sql)."</i><p align='left'>";
$result = $connect->query($sql);
$nr=$connect->query("SELECT * FROM ...")$result);
if ($nr=='0') {
echo "No tables !";
} else {
echo "<form action='mdeltb.php?k=$k' method='post' align='left'>";
while ($row = $connect->fetch_row($result)) {
echo "&#187;<input type='checkbox' name='tb[]' value='$row[0]'> <a href='table.php?k=$k&tb=$row[0]'>".htmlspecialchars($row[0])."</a><br/>";
}
echo "<br/><input type='submit' value='DELETE SELECTED'></form>";
mysql_free_result($result);
}
echo "<p align='left'>- - -<br/>- <a href='addtable.php?k=$k'>add table</a> <br/>- <a href='sql.php?k=$k'>sql code</a><br/>- <a href='export.php?k=$k'>export</a><br/>- <a href='upl.php?k=$k'>upload sql</a><br/>- <a href='import.php?k=$k'>import sql</a><br/> - <a href='data/index.php?k=$k'>files</a>";
echo '</div>';
include('foot.php');
?>