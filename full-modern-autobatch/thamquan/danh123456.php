<?php
define('_IN_JOHNCMS', 1);
$noionline = 'khuvuichoi';
require('../incfiles/core.php');
$textl = 'Khu Luyện tập';
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
 Echo '<div class="menu"><div class="nen_congvien"></div><div class="cola" style="min-height: 100px;margin:0">';
$req = $connect->query("SELECT * FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'khuvuichoi'");
while ($res = $connect->fetch_array($req)) {
$rand = rand(1,20);
If($rand <10){$c = '';} else {$c = 'class="xavt"';}
echo '<a href="/account/'.$res['id'].'/'.functions::khongdau($res['name']).'"><small></small><img src="'.$home.'/avatar/nen/'.$res['id'].'.png" '.$c.' alt="'. $res['name'] . '"/></a>';
}
echo '<form method="post"><input type="submit" name="submit" value="Tiềm tiếp"></form>';
if(isset($_POST['submit'])){
$times = date("H");
if ($times%2 <> 0 OR $datauser['thamquan'] <= 0) {
echo'bây giờ đang là giờ lẻ hoặc bạn đã hết lượt đánh';
} else {
$trangbi = rand(1,30);
$do = rand(1,250);
$sm = rand(1,500);
$rand = rand(1,20);
$tien = rand(100,1200);
if($rand == 15 AND $trangbi =30) {
$connect->query("INSERT INTO `kho` SET 
               `user_id`='".$user_id."',
               `id_loai`='".$arr['id_loai']."',
               `loai`='".$arr['loai']."',
               `type`='".$type."',
               `tenvatpham`='".$arr['tenvatpham']."',
               `tangsucmanh`='".$sm."'
               ");
echo' Bạn nhận được '.$arr['tenvatpham'].'';
$connect->query("UPDATE users SET tienxu = tienxu + '" . $tien . "' WHERE id = $user_id");
echo '<form method="post"><font color=red><img src="http://thitranxiteen.net/npc/images.jpg"></a>  nó đây rồi Bạn đập cho nó một trận, nó lại chạy mất và để lại được '.$tien.' xu </font></form>';
$connect->query("INSERT INTO `guest` SET
`adm` = '0',
`time` = '$time',
`user_id` = '2',
`name` = 'BOT',
`text` = '@".$datauser['name']." Vừa tiềm được tham quan nhận được ".$tien." xu và ".$arr['tenvatpham']." ',
`ip` = '0000',
`browser` = 'IPHONE'
");
}
if($rand == 1) {
$connect->query("UPDATE users SET tienxu = tienxu + '" . $tien . "' WHERE id = $user_id");
echo '<form method="post"><font color=red><img src="http://thitranxiteen.net/npc/images.jpg"></a>  nó đây rồi Bạn đập cho nó một trận, nó lại chạy mất và để lại được '.$tien.' xu </font></form>';
$connect->query("INSERT INTO `guest` SET
`adm` = '0',
`time` = '$time',
`user_id` = '2',
`name` = 'BOT',
`text` = '@".$datauser['name']." Vừa tiềm được tham quan nhận được ".$tien." xu  ',
`ip` = '0000',
`browser` = 'IPHONE'
");
}
if($rand == 16 AND $trangbi ==19) {
$connect->query("INSERT INTO `vatpham` SET 
`id_user`='".$user_id."',
`item`='".$ard['id_loai']."', 
`text`='".$ard['tenvatpham']."',
`chisoch1`='".$sm."',
`chisoch2`='".$sm."',
`hp1`='".$do."',
`hp2`='".$do."',
`soluong`='1'
");
echo' Bạn nhận được '.$ard['tenvatpham'].'';
$connect->query("UPDATE users SET tienxu = tienxu + '" . $tien . "' WHERE id = $user_id");
echo '<form method="post"><font color=red><img src="http://thitranxiteen.net/npc/images.jpg"></a> nó đây rồi Bạn đập cho nó một trận, nó lại chạy mất và để lại được '.$tien.' xu </font></form>';
$connect->query("INSERT INTO `guest` SET
`adm` = '0',
`time` = '$time',
`user_id` = '2',
`name` = 'BOT',
`text` = '@".$datauser['name']." Vừa tiềm được tham quan nhận được ".$tien." xu và ".$ard['tenvatpham']." ',
`ip` = '0000',
`browser` = 'IPHONE'
");
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
}
}
echo'</div>';
require('../incfiles/end.php');
echo '</div></div>';
}
?>
