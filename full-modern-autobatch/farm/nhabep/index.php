<?php
define('_IN_JOHNCMS', 1);
$noionline = 'nhabep';
require_once('../../incfiles/core.php'); 
$textl = 'Nhà bếp';
require_once('../../incfiles/head.php'); 
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Nhà bếp</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<div class="menu list-bottom">Bạn đang có <span style="color:green">'.$datauser[diemtichluy].'</span> điểm tích lũy !</div>';
$id = intval(abs($_GET['id']));
if ($id) {
$post = $connect->fetch_array($connect->query("select * from `farm_nhabep` WHERE  `id` = '$id'  LIMIT 1"));
$thongtin = $connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '".$post[loainguyenlieu]."'  LIMIT 1"));
$thongtin2 = $connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '".$post[loainguyenlieu2]."'  LIMIT 1"));
$thongtinnguyenlieu = $connect->fetch_array($connect->query("select * from `fermer_sclad` WHERE `semen` = '".$post[loainguyenlieu]."' AND `id_user` = '".$user_id."' LIMIT 1"));
$thongtinnguyenlieu2 = $connect->fetch_array($connect->query("select * from `fermer_sclad` WHERE `semen` = '".$post[loainguyenlieu2]."' AND `id_user` = '".$user_id."' LIMIT 1"));
$thongtinbanh = $connect->fetch_array($connect->query("select * from `farm_nhabep_naubanh` WHERE `user_id` = '".$user_id."' AND `loaibanh` = '" .$post['id']. "'"));
echo'<div class="menu list-bottom congdong">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align: top;">';
echo'<img src="/farm/nhabep/icon/'.$post['id'].'.png" alt="icon" />';
echo'&#160;</td><td>';
echo'[ <b>'.htmlspecialchars($post['tenvatlieu']).'</b> ]<br/>';
echo'Nấu mất: '.$post['timenau'].' phút<br/>';
echo'</td></tr></table></div>';
$banhchinroi = ($connect->query("SELECT COUNT(*) FROM `farm_nhabep_naubanh` WHERE `user_id` = '".$user_id."' AND `loaibanh` = '" .$post['id']. "' AND `type` = '1'")->fetch_row()[0] ?? 0);
if ($banhchinroi > 0) {
if (isset($_POST['nhandiem']) && $thongtinbanh[type] == 1) {
echo'<div class="menu"><b style="color:green">Bạn đã nhận '.$post['diem'].' tích lũy cho bản thân !</b></div>';
echo'<div class="menu"><a href="/farm/nhabep/?id='.$id.'"><input type="button" value="Làm mới" /></a></div>';
$connect->query("UPDATE `users` SET `diemtichluy` = `diemtichluy` + '".$post['diem']."' WHERE `id` = $user_id LIMIT 1");
$connect->query("DELETE FROM `farm_nhabep_naubanh` WHERE `loaibanh`='".$post['id']."'");
} else {
echo'<div class="menu">'.htmlspecialchars($post['tenvatlieu']).' đã chín bạn có '.$post['diem'].' điểm tích lũy</div>';
echo'<div class="menu list-top"><form method="post"><input type="submit" name="nhandiem" value="Nhận điểm" /></form></div>';
}
echo'</div>';
require_once('../../incfiles/end.php'); 
exit;
}

$lambanh = ($connect->query("SELECT COUNT(*) FROM `farm_nhabep_naubanh` WHERE `user_id` = '".$user_id."' AND `loaibanh` = '" .$post['id']. "'")->fetch_row()[0] ?? 0);
if ($lambanh > 0) {
$banhchin = $thongtinbanh['time']+$thongtinbanh[timexong];
echo'<div class="menu">'.htmlspecialchars($post['tenvatlieu']).' còn '.thoigiantinh($banhchin).' nữa mới chín hãy kiên nhẫn chờ nhé !</div>';
} else {
echo'Bạn có muốn nấu '.htmlspecialchars($post['tenvatlieu']).' x '.$post['songuyenlieu'].' '.$thongtin[name].' <img src="/farm/icon/item/'.$post['loainguyenlieu'].'.png" alt="icon" style="vertical-align: -8px;"/>'.($post['loainguyenlieu2'] == 0 ? '':' và '.$thongtin2[name].' x '.$post['songuyenlieu2'].' <img src="/farm/icon/item/'.$post['loainguyenlieu2'].'.png" alt="icon" style="vertical-align: -8px;"/>').'<br/>';
if (isset($_POST['submit'])) {
if ($thongtinnguyenlieu[kol] < $post['songuyenlieu']) {
echo'<div class="menu list-top" style="color:red">Bạn không đủ số "'.$thongtin[name].'"'.($post['loainguyenlieu2'] > 0 ? ''.($thongtinnguyenlieu2[kol] < $post['songuyenlieu2'] ? ' và số "'.$thongtin2[name].'"':'').'':'').' để làm bánh nhé !</div>';
echo'</div>';
require_once('../../incfiles/end.php'); 
exit;
}
if (!empty($post['loainguyenlieu2'])) {
if ($thongtinnguyenlieu2[kol] < $post['songuyenlieu2']) {
echo'<div class="menu list-top" style="color:red">Bạn không đủ số '.$thongtin2[name].' để làm bánh nhé !</div>';
echo'</div>';
require_once('../../incfiles/end.php'); 
exit;
}
}
$connect->query("UPDATE `fermer_sclad` SET `kol` = `kol`-'".$post['songuyenlieu']."' WHERE `id_user` = '".$user_id."' AND `semen` = '".$post['loainguyenlieu']."'");
if (!empty($post['loainguyenlieu2'])) {
$connect->query("UPDATE `fermer_sclad` SET `kol` = `kol`-'".$post['songuyenlieu2']."' WHERE `id_user` = '".$user_id."' AND `semen` = '".$post['loainguyenlieu2']."'");
}
               $timenau = $post['timenau']*60;
                $connect->query("INSERT INTO `farm_nhabep_naubanh` SET 
               `user_id`='" . $user_id. "',
               `loaibanh`='" .$post['id']. "',
               `nhandiem`='" .$post['diem']. "',
               `timexong`='" .$timenau. "',
               `time`='" .time(). "'
               ");
header("Location: $home/farm/nhabep/?id=$id");
}
echo'<div class="menu list-top"><form method="post"><input type="submit" name="submit" value="Nấu bánh" /></form></div>';
}

} else {
$tong = ($connect->query("SELECT COUNT(*) FROM `farm_nhabep`")->fetch_row()[0] ?? 0);
if($tong == 0) {
echo "<div class='menu'>Hiện tại nhà bếp chưa có nguyên liệu nào !</div>";
} else {
echo "<div class='menu congdong'>Các nguyên liệu nấu bánh !</div>";
$res = $connect->query("select * from `farm_nhabep`");
while ($post = $connect->fetch_array($res)){
$thongtin = $connect->fetch_array($connect->query("select * from `fermer_name` WHERE  `id` = '$post[loainguyenlieu]'  LIMIT 1"));
echo'<div class="menu list-top">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align: top;width: 30px;">';
echo'<img src="/farm/nhabep/icon/'.$post['id'].'.png" alt="icon" />';
echo'&#160;</td><td style="width: 500px;">';
echo'<a href="/farm/nhabep/?id='.$post[id].'">[ <b>'.htmlspecialchars($post['tenvatlieu']).'</b> ]</a><br/>';
echo'Thời gian nấu: '.$post['timenau'].' phút<br/>';
echo'Điểm tích lũy: <b style="color:green">'.$post['diem'].'</b><br/>';
echo'Nguyên liệu: '.$thongtin[name].' x '.$post['songuyenlieu'].' <img src="/farm/icon/item/'.$post['loainguyenlieu'].'.png" alt="icon" style="vertical-align: -14px;"/>'.($post['loainguyenlieu2'] == 0 ? '':' và '.$thongtin2[name].' x '.$post['songuyenlieu2'].' <img src="/farm/icon/item/'.$post['loainguyenlieu2'].'.png" alt="icon" style="vertical-align: -14px;"/>').'';
echo'</td></tr></table></div>';
}
}
}
echo'</div>';
require_once('../../incfiles/end.php'); 