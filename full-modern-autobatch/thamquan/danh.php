<?php
define('_IN_JOHNCMS', 1);
$noionline = 'khuvuichoi';
require('../incfiles/core.php');
$textl = 'Đức Nghĩa';
require('../incfiles/head.php');






echo'<div class="main-xmenu">';
date_default_timezone_set('Asia/Ho_Chi_Minh');
$item = rand(1,3); 
if ($item ==1) {
$arr = $connect->fetch_array($connect->query("SELECT * FROM `shop` WHERE `loai` = 'ao' ORDER BY RAND() LIMIT 1"));}
if ($item ==2) {
$arr = $connect->fetch_array($connect->query("SELECT * FROM `shop` WHERE `loai` = 'toc' ORDER BY RAND() LIMIT 1"));}
if ($item ==3) {
$arr = $connect->fetch_array($connect->query("SELECT * FROM `shop` WHERE `loai` = 'quan' ORDER BY RAND() LIMIT 1"));}
$ard = $connect->fetch_array($connect->query("SELECT * FROM `shop` WHERE `loai` = 'vatpham' ORDER BY RAND() LIMIT 1"));
If ($user_id){
echo '<div class="mainblok"><div class="danhmuc"><b>Sự kiện tiềm tham quan</b></div><div class="menu">';
echo'<div class="thanhpho"></div>';
 Echo '<div class="nen_congvien"></div><div class="cola" style="min-height: 100px;margin:0">';
$req = $connect->query("SELECT * FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'khuvuichoi'");
while ($res = $connect->fetch_array($req)) {
$rand = rand(1,20);
If($rand <10){$c = '';} else {$c = 'class="xavt"';}
echo '<a href="/member/'.$res['id'].'.html"><small></small><img src="'.$home.'/avatar/'.$res['id'].'.png" '.$c.' alt="'. $res['name'] . '"/></a>';
}
echo ' <center> <form method="post"><input type="submit" name="submit" value="Tiềm tiếp"></form>';
if(isset($_POST['submit'])){
$times = date("H");
if ($times%2 <> 0 ) {
echo'tham quan chỉ xuất hiện ở khung giờ 6-8-10-12-14-16-18-20-22-24-2-4 vui lòng bạn đến đúng giờ';
} else {
$trangbi = rand(1,30);
$sm = rand(1,150);


$hp = rand(1,250);
$rand = rand(2,15);
$luong = rand(5,15);
$tien = rand(1000,20000);



if($rand == 1) {

$connect->query("UPDATE `users` SET `sucmanh`=`sucmanh`+'".$sm."' WHERE `id`='{$user_id}'");
$connect->query("UPDATE `users` SET `hpfull`=`hpfull`+'".$hp."' WHERE `id`='{$user_id}'");
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`+'".$tienxu."' WHERE `id`='{$user_id}'");







echo '<form method="post"><font color=red><img src="'.$home.'/avatar/3.png"></a>  nó đây rồi Bạn đập cho nó một trận, nó lại chạy mất và để lại được '.$tienxu.' vina, '.$sm.' SM và '.$hp.' HP . </font></form>';
 
}



if($rand == 11) {
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`+'".$tien."' WHERE `id`='{$user_id}'");
$connect->query("UPDATE `users` SET `sucmanh`=`sucmanh`+'".$sm."' WHERE `id`='{$user_id}'");
$connect->query("UPDATE `users` SET `hpfull`=`hpfull`+'".$hp."' WHERE `id`='{$user_id}'");


echo '<form method="post"><font color=red><img src="'.$home.'/avatar/3.png"></a> nó đây rồi Bạn đập cho nó một trận, nó lại chạy mất và để lại được '.$tienxu.' xu </font></form>';


}


if($rand == 2) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 3) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 4) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 5) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 6) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 7) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 8) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 9) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 10) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 12) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 13) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 14) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 15) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 16) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 17) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 18) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 19) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}
if($rand == 20) {
echo '<form method="post"><font color=red> nó không có ở đây </font></form>';
}


}
}
echo' </center> </div></div>';

echo '</div></div>';
}
require('../incfiles/end.php');
?>
