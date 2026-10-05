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
$sql="SELECT * FROM `$tb`";
echo "<div class='shout'>INSERT<br/>Query: <i>".htmlspecialchars($sql)."</i><p align='left'><a href='tables.php?k=$k'>Tables</a>><a href='table.php?k=$k&tb=$tb'>$tb</a><br/>- - -<br/><a href='br.php?k=$k&tb=$tb'>Browse</a> |<a href='table.php?k=$k&tb=$tb'> Structure </a>| Insert | <a href='trun.php?k=$k&tb=$tb'>Clear</a> | <a href='dropt.php?k=$k&tb=$tb'>Drop</a><br/>- - -<br/>
";
$result = $connect->query($sql);
if (!$result) {
echo "Table $tb not exist";
} else {
if (!$vmi) {
echo "<form action='?k=$k&tb=$tb&vmi=ionutvmi' align='left' method='post'>
";
$i = 0;
while ($i < mysql_num_fields($result)) {
$meta = mysql_fetch_field($result, $i);
echo "<b>".htmlspecialchars($meta->name)."</b>";
echo ": <input name='$meta->name'><br/>
";
$i++;
}
echo "<input type='submit' value='insert'></form>";
mysql_free_result($result);
} else {
$i = 0; $wh=""; $val="";
$nrf= mysql_num_fields($result) - 1;
while ($i < mysql_num_fields($result)) {
$meta = mysql_fetch_field($result, $i);
$t=$_POST[$meta->name];
if($i == $nrf) {
$wh.=$meta->name;
$val.="'$t'"; } else {
$wh.=$meta->name.",";
$val.="'$t',"; }
$i++;
}
$do = $connect->query("INSERT INTO `$tb` ($wh) VALUES ($val)");
$sqll="INSERT INTO `$tb` ($wh) VALUES ($val)";
if($do)
echo "<center>Query: <i>".htmlspecialchars($sqll)."</i></center><p align='left'><br/><br/>DONE !";
else
echo "<center>Query: <i>".htmlspecialchars($sqll)."</i></center><p align='left'><br/>Error: ".mysql_error();
} }
echo "</div>";
include('foot.php');
?>
