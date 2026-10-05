<?php
/*
* wap phpmyadmin 2.0.1  REBUILD
* ionutvmi
* pimp-wap.tk
*/
include '../config.php';
include '../head.php';
echo "<div class='shout'>FILES SAVED <p align='left'><a href='../tables.php?k=$k'>Tables </a><br/>- - -<br/>";
$ac=$_GET['ac'];
if (!$ac) {
if ($handle = opendir('.')) {
$q=0;
while (false !=($file=readdir($handle))) {
if ($file !='.' && $file !='..' && $file !='index.php' && $file !='default.css') {
echo "&#187; <a href='$file'>$file </a> - <a href='?k=$k&ac=d&f=$file'>(del)</a><br/>";
$q++; } }
if ($q==0) {
echo "No files !"; }
closedir($handle);
} else {
echo "some error camed up"; }
} else {
$f=$_GET['f'];
unlink($f);
echo "$f DELETED ! <br><br><a href='?k=$k'>Back to files</a>";
}
echo "</div>";
include('../foot.php');
?>
