<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
include 'config.php';
include 'head.php';
$vmi=$_POST['vmi'];
print "<div class='shout'>IMPORT SQL<br/><p align='left'><a href='tables.php?k=$k'>Tables</a>><a href='?k=$k'>import sql</a><br/>- - -<br/>";
if(!$vmi) {
print "- only sql files.<br/><br/><form action='?k=$k' method='post' align='left'>Url:<br/><input name='vmi' value='http://'><br/>Separator: <input name='sep' size='2' value=';'><br/><select name='del'><option value='yes'>Delete after execute</option><option value='vmi'>Save after execute</option></select><br/><input type='submit' value='Execute'>";

} else {
if($vmi==''||$vmi=='http://') die("enter url");
$ext= end(explode('.', $vmi));
if($ext !="sql") die("file must be sql");
$sep=$_POST['sep'];
if(!$sep) die("enter separator");
$filename="import".rand(1,100).".sql";
$dir="data/".$filename;
if(!copy($vmi,$dir)) {
die("ERROR File NOT copyed !"); } else {
// IF FILE IS UPLOAD
$handle = fopen("data/$filename", "r");
$contents = fread($handle, filesize("data/$filename"));
fclose($handle);
echo "- $filename uploaded !<br/>";
$contents=preg_replace("~(--|##)[^\r]*\r~","\r",$contents);
$contents=explode($sep,$contents);
foreach($contents as $coo) {
if(!empty($coo)) {
$do=$connect->query($coo);
$cop=htmlspecialchars(substr($coo, 0, 40));
if ($do) {
echo "><i style='color:lime'>$cop...</i> executed !<br/>"; } else {
echo "><i style='color: red'>$cop...</i> NOT executed ! Error: ";
echo mysql_error()."<br/>"; } } }
if ($_POST['del'] == "yes") {
unlink("data/$filename");
echo "<br/>- Deleted !"; } else {
echo "<br/>- Saved !"; }


}}
echo "</div>";
include('foot.php');
?>
