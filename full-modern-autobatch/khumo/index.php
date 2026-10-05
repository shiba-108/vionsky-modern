<?php
define('_IN_JOHNCMS', 1);
$noionline = 'khumo';
require ('../incfiles/core.php');
$textl = 'Khu Mỏ Online';
require ('../incfiles/head.php');
if (!$user_id){
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Khu Mỏ</div>';
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
?>
<div class="main-xmenu">
<div class="danhmuc">Khu Mỏ</div>
<div class="menu">Hãy tìm ra các thỏi vàng, kim cương để làm giàu cho bạn nhé ! Càng đông người xu càng nhiều</div>
</div>
<div class="main-xmenu">
<div class="danhmuc">Thông tin của bạn</div>
<?php $thongtin = $connect->fetch_array($connect->query("SELECT * FROM `khumo` WHERE `user_id`='{$user_id}'")); ?>
<div class="menu">Sức đào còn <?php echo ($thongtin[suckhoe] < 8 ? '<span style="color:red">Kiệt sức</span>':''.$thongtin['suckhoe'].'%'); ?></div>
<div class="menu">Số vàng đã đào hôm nay <?php echo $thongtin['vang']; ?> cục</div>
<div class="menu">Kim cương đã đào hôm nay <?php echo $thongtin['kimcuong']; ?> viên</div>
<div class="menu">Tổng thu nhập <?php echo $thongtin['xu']; ?> xu</div>
</div>
<?php
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../../incfiles/end.php');
exit;
}
if(isset($_POST['submit'])) {
if(!$thongtin['suckhoe'] < 8) { 
$tien = rand(20, 50);
$kimcuong = rand(50, 100);
$da = rand(10, 20);
$ben = rand(5, 10);
$rand = rand(1, 4);
echo '<div class="main-xmenu"><div class="omenu"><div class="menu">';
if($rand == 1) {
$connect->query("UPDATE `khumo` SET `vang`=`vang`+'1', `xu`=`xu`+'{$tien}' WHERE `user_id`='{$user_id}'");
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`+'{$tien}' WHERE `id`='{$user_id}'");
echo '<img src="img/daovang/vang1.png" alt="Vang" /> Bạn vừa đào được một cục vàng trị giá '.$tien.' Xu';
}
if($rand == 2) {
$connect->query("UPDATE `khumo` SET `kimcuong`=`kimcuong`+'1', `xu`=`xu`+'{$kimcuong}' WHERE `user_id`='{$user_id}'");
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`+'{$kimcuong}' WHERE `id`='{$user_id}'");
echo '<img src="img/daovang/kcuong.png" alt="Kim cương" /> Bạn vừa đào được một viên kim cương trị giá '.$kimcuong.' Xu!';
}
if($rand == 3) {
$connect->query("UPDATE `khumo` SET `xu`=`xu`+'{$da}' WHERE `user_id`='{$user_id}'");
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`+'{$da}' WHERE `id`='{$user_id}'");
echo '<img src="img/daovang/da.png" alt="Đá" /> Bạn vừa đào được một viên đá trị giá '.$da.' Xu!';
}
if($rand == 4) {
$connect->query("UPDATE `khumo` SET `xu`=`xu`+'{$tien}' WHERE `user_id`='{$user_id}'");
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`+'{$tien}' WHERE `id`='{$user_id}'");
echo '<img src="img/daovang/tuitien.png" alt="Túi tiền" /> Bạn vừa đào được một túi tiền trị giá '.$tien.' Xu!';
}
echo'</div></div></div>';
$connect->query("UPDATE `khumo` SET `suckhoe`=`suckhoe`-'$ben' WHERE `user_id`='{$user_id}'");
}
}
if($thongtin['suckhoe'] < 8) {
$hoiphuc = $thongtin['time'] + 600 - time();
$timehoiphuc = date('i', $hoiphuc);
echo '<div class="main-xmenu"><div class="omenu"><div class="menu">Bạn đã không còn sức để đào nữa hãy nghỉ '.$timehoiphuc.' phút nữa rồi đào tiếp nha nhé !</div></div></div>';
if($thongtin['reset'] == 0) { $connect->query("UPDATE `khumo` SET `suckhoe`= '0', `reset`= '1', `time`= '".$time."' WHERE `user_id`='{$user_id}'"); 
header('Location: /khumo/');
}
if (($thongtin[time] + 540 ) < $time) {
if($thongtin['reset'] == 1) { $connect->query("UPDATE `khumo` SET `suckhoe`= '100', `reset`= '0' WHERE `user_id`='{$user_id}'");
}
}
}
?>
<div class="main-xmenu" style="padding-bottom: 4px;">
<div class="nenkhumo"></div>
<div class="conduong"></div>
<div class="cola" style="margin-top: -2px; margin-bottom: 0; min-height: 90px; text-align: center">
<?php
$req = $connect->query("SELECT * FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'khumo'");
while ($res = $connect->fetch_array($req)) {
echo '<a href="/account/'.$res['id'].'/'.functions::khongdau($res['name']).'"><img src="'.$home.'/avatar/nen/'.$res['id'].'.png" alt="'. $res['name'] . '"/></a>';
}
if($thongtin['suckhoe'] > 8) {
echo'<div class="menu">';
echo'<form method="post"><input type="submit" name="submit" value="Đào Mỏ" /></form>';
echo'</div>';
}
echo'</div>';
echo'</div>';
require ('../incfiles/end.php');