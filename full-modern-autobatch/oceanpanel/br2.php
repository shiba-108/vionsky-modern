<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
include 'config.php';
include 'head.php';

 
$tb=trim($_GET['tb']);
$prim=$_GET['pri'];
$pri=base64_decode($prim);
$vmi=$_GET['vmi'];
echo "<div class='shout'>INFO<p align='left'><a href='tables.php?k=$k'>Tables</a>><a href='table.php?k=$k&tb=$tb'>$tb</a>><a href='br.php?k=$k&tb=$tb'>Browse</a>><a href='?k=$k&tb=$tb&pri=$prim'>Info</a><br/>- - -<br/><a href='edit_rec.php?k=$k&tb=$tb&pri=$prim'>EDIT</a> | <a href='drop_rec.php?k=$k&tb=$tb&pri=$prim'>Drop</a> (delete)<br/>- - -
";
$result = $connect->query("SELECT * FROM `$tb`");
if (!$result) {
echo "Table $tb not exist"; } else {

$de = $connect->query("SHOW COLUMNS FROM `$tb`");
$nr=@$connect->query("SELECT * FROM ...")$de);
if ($nr >0) {
$i = 0;
echo "<table border='1' width='100%' cellpadding='0' cellspacing='0'><tr><td>COLUMN</td><td>VALUE</td></tr>";
while ($row = $connect->fetch_array($de)) {
$meta = mysql_fetch_field($result, $i);
$nm=$meta->name;
$ga = $connect->query("SELECT `$nm` FROM `$tb` WHERE $pri");
$r = $connect->fetch_array($ga);
$rr=$r["$nm"];
echo "<tr><td>".htmlspecialchars($nm)."</td> <td>".htmlspecialchars($rr)."</td></tr>";
echo "<!-- ionutvmi -->";
$i++;
}
echo "</table>";
} else {
echo "No values inserted";
}

}
echo "</div>";
include('foot.php');
?>
