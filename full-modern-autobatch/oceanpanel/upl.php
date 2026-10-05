<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
include 'config.php';
include 'head.php';
$vmi=$_GET['vmi'];
$size_bytes = 12288000; // max file size in bytes
$kb = $size_bytes / 1024;
$mb = $size_bytes / 1024000;
echo "<div class='shout'>UPLOAD SQL <p align='left'><a href='tables.php?k=$k'>Tables</a>><a href='?k=$k'>Upload</a><br/>- - -<br/>";
if (!$vmi) {
echo "- Max: <b>$mb</b> MB<br/> - only .sql files";
echo '<form method="post" enctype="multipart/form-data" action="?k='.$k.'&vmi=add" align="left">';
echo '<input type="file" name="filetoupload"><br>';
echo '<select name="del"><option value="yes">Delete after execution !</option><option value="no">Save after execution !</option></select><br>Separator: <input name="sep" value=";" size="2"><br><input type="Submit" name="uploadform" value="Upload">';
echo '</form></div>';
include('foot.php');
}
if($vmi=="add"){
$upload_dir='data/';
$filename = $_FILES['filetoupload']['name'];
$size = $_FILES['filetoupload']['size'];
$extlimit = "yes"; //yes/no
$ext = strrchr($_FILES['filetoupload'][name],'.');
if (!is_uploaded_file($_FILES['filetoupload']['tmp_name']))
{
echo "ERROR! NO FILE SELECTED!<br />";
echo "</div>";
include("foot.php");
exit();
}
//IF EXT IS ALLOWED
if (($extlimit == "yes") && ($ext !=".sql")) {
echo("EXT NOT ALLOWED.<br />");
echo "</div>";
include('foot.php');
exit(); }
// check file size
if ($size > $size_bytes) {
$kb = $size_bytes / 1024;
echo "FILE IS TO BIG ! Maxim <b>$kb</b> KB.<br />";
echo "</div>";
include("foot.php");
exit();
}
//IF FILE EXIST
if (file_exists("$upload_dir/$filename"))
{
echo("File name already exists. Rename it!");
echo "</div>";
include("foot.php");
exit();
}
if (move_uploaded_file($_FILES['filetoupload']['tmp_name'],$upload_dir.$filename))
{
// IF FILE IS UPLOAD
$handle = fopen("data/$filename", "r");
$contents = fread($handle, filesize("data/$filename"));
fclose($handle);
echo "- $filename uploaded !<br/>";
$sep=$_POST['sep'];
$contents=preg_replace("~(--|##)[^\r]*\r~","\r",$contents);
$contents=explode($sep,$contents);
foreach($contents as $coo) {
if(!empty($coo)) {
$do=$connect->query($coo);
$cop=htmlspecialchars(substr($coo, 0, 40));
if ($do) {
echo "><i style='color:lime'>$cop...</i> executed !<br/>"; } else {
echo "><i style='color: red'>$cop...</i> NOT executed ! Error: ";
echo mysql_error()."<br/>"; } }
}
if ($_POST['del'] == "yes") {
unlink("data/$filename");
echo "<br/>- Deleted !"; } else {
echo "<br/>- Saved !"; }
echo "</div>";
include("foot.php");
exit();
}
else
{
//IF IS ERROR
echo "ERROR! Try again!<br />";
echo "</div>";
include("foot.php");
exit();
}
}
?>
