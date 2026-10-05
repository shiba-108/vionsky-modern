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
echo "<div class='shout'>INFO<p align='left'><a href='tables.php?k=$k'>Tables</a>><a href='table.php?k=$k&tb=$tb'>$tb</a><br/>- - -<br/>";
$result = $connect->query("SELECT * FROM `$tb`");
if (!$result) {
echo "Table $tb not exist"; } else {
if (!$vmi) {
echo "<form action='?k=$k&tb=$tb&pri=$prim&vmi=ionutvmi' align='left' method='post'>";
$de = $connect->query("SHOW COLUMNS FROM `$tb`");
$nr=@$connect->query("SELECT * FROM ...")$de);
if ($nr >0) {
$i = 0;
while ($row = $connect->fetch_array($de)) {
$meta = mysql_fetch_field($result, $i);
$nm=$meta->name;
$ga = $connect->query("SELECT `$nm` FROM `$tb` WHERE $pri");
$r = $connect->fetch_array($ga);
$rr=$r["$nm"];
echo "&#187; $nm: <textarea rows='1' name='$nm'>".$rr."</textarea><br/>";
echo "<br/> ";
$i++;
}
echo "<input type='submit' value='Save'></form>";
} else {
echo "No values inserted";
}
} else {
$de = $connect->query("SHOW COLUMNS FROM `$tb`");
$updt="";
$i=0;
while ($row = $connect->fetch_array($de)) {
$meta = mysql_fetch_field($result, $i);
$nm=$meta->name; // column name
$ga = $connect->query("SELECT `$nm` FROM `$tb` WHERE $pri");
$r = $connect->fetch_array($ga);
$rr=$r["$nm"]; // original value
$nv =trim($_POST["$nm"]); // new value
// check if is anything to change 
$nvv=stripslashes($nv);
if($rr != $nvv){
$updt.= " `$nm`='$nv',";
}
$i++;
}
if($updt !="")	{
$updt=substr($updt,"0","-1");
$dosql = "UPDATE `$tb` SET $updt WHERE $pri  LIMIT 1";
echo "<i>".htmlspecialchars($dosql)."</i><br/>";
$do = $connect->query($dosql);
if (!$do) 
echo mysql_error(); 
else
echo "Saved !";
		} else {
				echo "Nothing to change";
				
				}
}
}
echo "</div>";
include('foot.php');
?>
