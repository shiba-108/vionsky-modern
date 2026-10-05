<?php

define('_IN_JOHNCMS', 1);
$textl = 'Nâng cấp';
$headmod = 'upgrade';
require_once ('../../incfiles/core.php');
require_once ('../../incfiles/head.php');
if (!$user_id){
echo'<div class="main-xmenu">';
echo'<div class="phdr">Upgrade</div>';
echo'<div class="omenu">Bạn phải đăng nhập để nâng cấp!</div>';
echo'</div>';
require('../../incfiles/end.php');
exit;
}

$id = intval($_GET['id']);
$check = ($connect->query("SELECT COUNT(*) FROM nangcap WHERE id = '".$_GET['id']."'")->fetch_row()[0] ?? 0);
$nangcap = $connect->fetch_array($connect->query("SELECT * FROM nangcap WHERE id = '".$id."'"));
$dangmac = $connect->fetch_array($connect->query("select * from `users` WHERE `id` = '".$user_id."'"));
$cross=$connect->fetch_array($connect->query("SELECT * FROM `shop` WHERE `id`='".$nangcap['canvp']."'"));
if ($dangmac[$cross['loai']]== $cross['id_loai']) {
	echo '<div class="rmenu">Vui lòng tháo đồ trước khi nâng cấp</div>';
	require('../../incfiles/end.php');
	exit;
}
$kiss=$connect->fetch_array($connect->query("SELECT * FROM `shop` WHERE `id`='".$nangcap['vatpham']."'"));
$sosanhkhodo = ($connect->query("SELECT COUNT(*) FROM `kho` WHERE `loai` = '".$kiss['loai']."' AND `id_loai` = '".$kiss['id_loai']."' AND `user_id` = '".$user_id."'")->fetch_row()[0] ?? 0);
if ($sosanhkhodo > 0) {
echo '<div class="omenu">Bạn đã có món đồ này rồi nhé hãy vào rương kiểm tra !<br/><a href="/ruong/">Tiếp Tục</a></div>';
echo'</div>';
require_once ("../../incfiles/end.php");
exit;
}
$demkcx = $connect->fetch_array($connect->query("SELECT * FROM  `vatpham` WHERE `id_user` = '".$user_id."' AND `item` = '8'"));
$demkchv = $connect->fetch_array($connect->query("SELECT * FROM  `vatpham` WHERE `id_user` = '".$user_id."' AND `item` = '9'"));
$demkct = $connect->fetch_array($connect->query("SELECT * FROM  `vatpham` WHERE `id_user` = '".$user_id."' AND `item` = '10'"));
$demnhb = $connect->fetch_array($connect->query("SELECT * FROM  `vatpham` WHERE `id_user` = '".$user_id."' AND `item` = '11'"));
$kcx = $demkcx['soluong']-$nangcap['kcx'];
$kct = $demkct['soluong']-$nangcap['kct'];
$kchv = $demkchv['soluong']-$nangcap['kchv'];
$nhb = $demnhb['soluong']-$nangcap['nhb'];
$xu = $datauser['xu']-$nangcap['gia'];
if($check > 0){
$vatpham = $connect->fetch_array($connect->query("SELECT * FROM shop WHERE id = '".$nangcap['vatpham']."'"));
$canvp = $connect->fetch_array($connect->query("SELECT * FROM shop WHERE id = '".$nangcap['canvp']."'"));
$covp = ($connect->query("SELECT COUNT(*) FROM kho WHERE id_loai = '".$canvp['id_loai']."' AND loai = '".$canvp['loai']."' AND user_id='".$user_id."'")->fetch_row()[0] ?? 0);
echo'<div class="phdr">Nâng Cấp '.$vatpham['tenvatpham'].'</div>';
if(isset($_POST['submit'])){

if($kcx >= 0 && $kct >= 0 &&kchv>=0  && $nhb >= 0 && $xu >= 0 && $covp > 0){
$rand = rand(1,10);
if ($rand == 3) {
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kchv']."' WHERE `id_user` = '".$user_id."' AND `item`='9'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kct']."' WHERE `id_user` = '".$user_id."' AND `item`='10'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['nhb']."' WHERE `id_user` = '".$user_id."' AND `item`='11'");
@$connect->query("UPDATE `users` SET `xu` = `xu` - '".$nangcap['gia']."' WHERE id = '".$user_id."'");
@$connect->query("INSERT INTO `kho` SET
`user_id`='" . $user_id. "',
`id_loai`='" . $vatpham['id_loai'] . "',
`loai`='" . $vatpham['loai'] . "',
`tangsucmanh`='" . $vatpham['tangsucmanh'] . "',
`tanghp`='" . $vatpham['hp'] . "',
`tenvatpham`='" . $vatpham['tenvatpham'] . "'
");
@$connect->query("DELETE FROM `kho` WHERE `user_id` = '".$user_id."' AND id_loai='".$canvp['id_loai']."' AND loai='".$canvp['loai']."'");
echo '<div class="omenu"><span style="color:green"><b>Chúc mừng bạn đã nâng cấp thành công '.$vatpham['tenvatpham'].' bạn hãy kiểm tra kho đồ của mình.</b></span></div>';
} else if ($rand ==1) {
echo '<div class="omenu"><span style="color:red"><b>Nâng cấp thất bại bạn đã bị trừ '.$nangcap['gia'].' Xu !!</b></span></div>';
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kcx']."' WHERE `id_user` = '".$user_id."' AND `item`='8'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kchv']."' WHERE `id_user` = '".$user_id."' AND `item`='9'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kct']."' WHERE `id_user` = '".$user_id."' AND `item`='10'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['nhb']."' WHERE `id_user` = '".$user_id."' AND `item`='11'");
@$connect->query("UPDATE `users` SET `xu` = `xu` - '".$nangcap['gia']."' WHERE id = '".$user_id."'");
} else if ($rand==2) {
echo '<div class="omenu"><span style="color:red"><b>Nâng cấp thất bại bạn đã bị trừ '.$nangcap['gia'].' Xu !!</b></span></div>';
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kcx']."' WHERE `id_user` = '".$user_id."' AND `item`='8'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kchv']."' WHERE `id_user` = '".$user_id."' AND `item`='9'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kct']."' WHERE `id_user` = '".$user_id."' AND `item`='10'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['nhb']."' WHERE `id_user` = '".$user_id."' AND `item`='11'");
@$connect->query("UPDATE `users` SET `xu` = `xu` - '".$nangcap['gia']."' WHERE id = '".$user_id."'");
} else if ($rand==4) {
echo '<div class="omenu"><span style="color:red"><b>Nâng cấp thất bại bạn đã bị trừ '.$nangcap['gia'].' Xu !!</b></span></div>';
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kcx']."' WHERE `id_user` = '".$user_id."' AND `item`='8'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kchv']."' WHERE `id_user` = '".$user_id."' AND `item`='9'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kct']."' WHERE `id_user` = '".$user_id."' AND `item`='10'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['nhb']."' WHERE `id_user` = '".$user_id."' AND `item`='11'");
@$connect->query("UPDATE `users` SET `xu` = `xu` - '".$nangcap['gia']."' WHERE id = '".$user_id."'");
} else if ($rand==5) {
echo '<div class="omenu"><span style="color:red"><b>Nâng cấp thất bại bạn đã bị trừ '.$nangcap['gia'].' Xu !!</b></span></div>';
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kcx']."' WHERE `id_user` = '".$user_id."' AND `item`='8'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kchv']."' WHERE `id_user` = '".$user_id."' AND `item`='9'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kct']."' WHERE `id_user` = '".$user_id."' AND `item`='10'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['nhb']."' WHERE `id_user` = '".$user_id."' AND `item`='11'");
@$connect->query("UPDATE `users` SET `xu` = `xu` - '".$nangcap['gia']."' WHERE id = '".$user_id."'");
} else if ($rand==6) {
echo '<div class="omenu"><span style="color:red"><b>Nâng cấp thất bại bạn đã bị trừ '.$nangcap['gia'].' Xu !!</b></span></div>';
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kcx']."' WHERE `id_user` = '".$user_id."' AND `item`='8'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kchv']."' WHERE `id_user` = '".$user_id."' AND `item`='9'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kct']."' WHERE `id_user` = '".$user_id."' AND `item`='10'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['nhb']."' WHERE `id_user` = '".$user_id."' AND `item`='11'");
@$connect->query("UPDATE `users` SET `xu` = `xu` - '".$nangcap['gia']."' WHERE id = '".$user_id."'");
} else if ($rand==7) {
echo '<div class="omenu"><span style="color:red"><b>Nâng cấp thất bại bạn đã bị trừ '.$nangcap['gia'].' Xu !!</b></span></div>';
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kcx']."' WHERE `id_user` = '".$user_id."' AND `item`='8'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kchv']."' WHERE `id_user` = '".$user_id."' AND `item`='9'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kct']."' WHERE `id_user` = '".$user_id."' AND `item`='10'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['nhb']."' WHERE `id_user` = '".$user_id."' AND `item`='11'");
@$connect->query("UPDATE `users` SET `xu` = `xu` - '".$nangcap['gia']."' WHERE id = '".$user_id."'");
} else if ($rand==8) {
echo '<div class="omenu"><span style="color:red"><b>Nâng cấp thất bại bạn đã bị trừ '.$nangcap['gia'].' Xu !!</b></span></div>';
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kcx']."' WHERE `id_user` = '".$user_id."' AND `item`='8'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kchv']."' WHERE `id_user` = '".$user_id."' AND `item`='9'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kct']."' WHERE `id_user` = '".$user_id."' AND `item`='10'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['nhb']."' WHERE `id_user` = '".$user_id."' AND `item`='11'");
@$connect->query("UPDATE `users` SET `xu` = `xu` - '".$nangcap['gia']."' WHERE id = '".$user_id."'");
} else if ($rand==9) {
echo '<div class="omenu"><span style="color:red"><b>Nâng cấp thất bại bạn đã bị trừ '.$nangcap['gia'].' Xu !!</b></span></div>';
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kcx']."' WHERE `id_user` = '".$user_id."' AND `item`='8'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kchv']."' WHERE `id_user` = '".$user_id."' AND `item`='9'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kct']."' WHERE `id_user` = '".$user_id."' AND `item`='10'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['nhb']."' WHERE `id_user` = '".$user_id."' AND `item`='11'");
@$connect->query("UPDATE `users` SET `xu` = `xu` - '".$nangcap['gia']."' WHERE id = '".$user_id."'");
} else if ($rand==10) {
echo '<div class="omenu"><span style="color:red"><b>Nâng cấp thất bại bạn đã bị trừ '.$nangcap['gia'].' Xu !!</b></span></div>';
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kcx']."' WHERE `id_user` = '".$user_id."' AND `item`='8'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kchv']."' WHERE `id_user` = '".$user_id."' AND `item`='9'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['kct']."' WHERE `id_user` = '".$user_id."' AND `item`='10'");
@$connect->query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$nangcap['nhb']."' WHERE `id_user` = '".$user_id."' AND `item`='11'");
@$connect->query("UPDATE `users` SET `xu` = `xu` - '".$nangcap['gia']."' WHERE id = '".$user_id."'");
}
}else{
echo '<div class="menu">Bạn chưa đủ điều kiện để nâng cấp!</div>';
}
}
echo '<div class="omenu"><center><img style="text-align: center;" src="/images/'.$vatpham['loai'].'/'.$vatpham['id_loai'].'.png " alt="do"></center></div>';
echo '<div class="phdr"><b>Thông tin</b></div><div class="omenu"><img src="/images/'.$canvp['loai'].'/'.$canvp['id_loai'].'.png " class="avatar_vina"></b><span style="color:black"><b>'.$canvp['tenvatpham'].'</b>';
echo ($nangcap['kcx'] > 0 ? '<br />Kim Cương Xanh : '.$demkcx['soluong'].'/'.$nangcap['kcx']:'');
echo ($nangcap['kchv'] > 0 ? '<br />Kim Cương Hy Vọng : '.$demkchv['soluong'].'/'.$nangcap['kchv']:'');
echo ($nangcap['kct'] > 0 ? '<br />Kim Cương Tím : '.$demkct['soluong'].'/'.$nangcap['kct']:'');
echo ($nangcap['nhb'] > 0 ? '<br />Ngọc Huyền Bí : '.$demnhb['soluong'].'/'.$nangcap['nhb']:'');
echo '</span>';
echo '</div>';
echo '<div class="menu">';
if($kcx >= 0 && $kct >= 0  &&$kchv>=0 && $nhb >= 0 && $xu >= 0 && $covp > 0){
echo '<form method="post"><input type="submit" name="submit" value="Nâng Cấp" /></form>';
}else{
echo '<span style="color:red"><b>Bạn Chưa Đủ Đạo Cụ Để Nâng Cấp</b></span>';
}
}else{
echo 'Trong hệ thống không có vật phẩm này';
}
echo '</div>';
















require_once ("../../incfiles/end.php");

?>