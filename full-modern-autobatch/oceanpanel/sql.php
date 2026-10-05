<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
include 'config.php';
include 'head.php';
echo "<div class='shout'>SQL CODE <p align='left'><a href='tables.php?k=$k'>Tables</a>><a href='?k=$k'>sql code</a><br/>- - -<br/>";
$k=$_GET['k'];
$vmi=$_GET['vmi'];
if (!$vmi) {
echo "<form action='?k=$k&vmi=ionutvmi' method='post' align='left'>
(!) DO NOT USE THIS IF YOU DO NOT KNOW HOW !<br/>(!) DO NOT FORGET TO INCLUDE SEPARATOR IN SQL CODE<br/>
Code:<br/>
<textarea name='sql' rows='10'>;</textarea>
<br/>Separator: <input name='sep' value=';' size='2'><br><input type='submit' value='Execute'/>
</form>
";
} else {
$sql=stripslashes($_POST['sql']); $sep=trim($_POST['sep']);
$sql=preg_replace("~(--|##)[^\r]*\r~","\r",$sql);
$sq=explode($sep,$sql);
foreach ($sq as $sql) {
if(!empty($sql)){
$do= $connect->query($sql);
$wp=htmlspecialchars(substr($sql,0,40));
if ($do) {
echo "<i style='color:lime'>$wp...</i> done !<br/>"; } else {
echo "<i style='color:red'>$wp...</i> ERROR: ";
echo mysql_error()."<br/>";
} }
}
}
echo '</div>';
include('foot.php');
?>
