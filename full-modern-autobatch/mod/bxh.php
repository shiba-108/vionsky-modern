<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl='Bảng Xếp Hạng';
require('../incfiles/head.php');
echo'
<div class="phdr">TOP CAO THỦ LEVER</div>';
$vnviet= $connect->query("SELECT * FROM users WHERE `online`=`online` >= 0 AND `rights` < 9 ORDER BY `online` DESC LIMIT 5");
$i=1;
while
($res=$connect->fetch_array($vnviet)) {
echo'<div class="list1">-Nhân vật: <img src="/avatar/'.$res['id'].'.png">
<br/>-TOP: '.$i.' ';
if($i == 1)
echo'<font color="red"><b>St</b></font>';
else
if($i == 2)
echo'<font color="red"><b>Rd</b></font>';
else
if($i == 3)
echo'<font color="red"><b>Th</b></font>';
echo'<br/>
-Tên nick: <a href="/member/'.$res['id'].'.html">'.$res['name'].'</a><br/>
-Lever: '.lv($res['id']).'</div>';
++$i;
}



echo'
<div class="phdr">TOP QUẢNG CÁO</div>';
$vnviet= $connect->query("SELECT * FROM users WHERE `gt`=`gt` >= 0 AND `rights` < 9 ORDER BY `gt` DESC LIMIT 5");
$i=1;
while
($res=$connect->fetch_array($vnviet)) {
echo'<div class="list1">-Nhân vật: <img src="/avatar/'.$res['id'].'.png">
<br/>-TOP: '.$i.' ';
if($i == 1)
echo'<font color="red"><b>St</b></font>';
else
if($i == 2)
echo'<font color="red"><b>Rd</b></font>';
else
if($i == 3)
echo'<font color="red"><b>Th</b></font>';
echo'<br/>
-Tên nick: <a href="/member/'.$res['id'].'.html">'.$res['name'].'</a><br/>
-Điểm QC: '.$res['gt'].'</div>';
++$i;
}





echo'
<div class="phdr">TOP ĐẠI GIA</div>';
$vnviet= $connect->query("SELECT * FROM users WHERE `xu`=`xu` >= 0 AND `rights` < 9 ORDER BY `xu` DESC LIMIT 5");
$i=1;
while
($res=$connect->fetch_array($vnviet)) {
echo'<div class="list1">-Nhân vật: <img src="/avatar/'.$res['id'].'.png">
<br/>-TOP: '.$i.' ';
if($i == 1)
echo'<font color="red"><b>St</b></font>';
else
if($i == 2)
echo'<font color="red"><b>Rd</b></font>';
else
if($i == 3)
echo'<font color="red"><b>Th</b></font>';
echo'<br/>
-Tên nick: <a href="/member/'.$res['id'].'.html">'.$res['name'].'</a><br/>
-Xu: '.$res['xu'].'</div>';
++$i;
}
echo'
<div class="phdr">TOP ĐẠI GIA LƯỢNG</div>';
$vnviet= $connect->query("SELECT * FROM users WHERE `luong`=`luong` >= 0 AND `rights` < 9 ORDER BY `luong` DESC LIMIT 5");
$i=1;
while
($res=$connect->fetch_array($vnviet)) {
echo'<div class="list1">-Nhân vật: <img src="/avatar/'.$res['id'].'.png">
<br/>-TOP: '.$i.' ';
if($i == 1)
echo'<font color="red"><b>St</b></font>';
else
if($i == 2)
echo'<font color="red"><b>Rd</b></font>';
else
if($i == 3)
echo'<font color="red"><b>Th</b></font>';
echo'<br/>
-Tên nick: <a href="/member/'.$res['id'].'.html">'.$res['name'].'</a><br/>
-Lượng: '.$res['luong'].'</div>';
++$i;
}

require('../incfiles/end.php');
?>