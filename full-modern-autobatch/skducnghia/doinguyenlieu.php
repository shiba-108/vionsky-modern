<?php 
define('_IN_JOHNCMS', 1); 
$textl = 'Đổi Nguyên Liệu - Sự Kiện Yêu Lao Động'; 
require_once ("../incfiles/core.php"); 
require_once ("../incfiles/head.php"); 
if (!$user_id) { 
require_once ('../incfiles/head.php'); 
echo functions::display_error($lng['access_guest_forbidden']); 
require_once ('../incfiles/end.php'); 
exit; 
}
//--Đổi nguyên liệu sự kiện Yêu Lao Động Mod bởi Trần Văn Hoài--//
if(!isset($_POST['doi']))
{
$xemtrung = $connect->fetch_array($connect->query("SELECT * FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '28'"));
$xemcachua = $connect->fetch_array($connect->query("SELECT * FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '2'"));
$xemlua = $connect->fetch_array($connect->query("SELECT * FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '1'"));
echo'<div class="danhmuc">Đổi Nguyên Liệu</div>';
echo'<div class="list-me">Bạn đang có: '.$xemtrung['kol'].' <img src="http://teenvui.me/farm/vatnuoi/trungvit.png"/>, '.$xemcachua['kol'].' <img src="http://teenvui.me/farm/icon/item/2.png"/> và '.$xemlua['kol'].' <img src="http://teenvui.me/farm/icon/item/1.png"/></div>';
echo'<form action="" name="but" method="post"><div class="danhmuc"></div>
<div class="list-me"><input type="radio" name="loai" value="lkn"> <img src="/icon/lkn.png" title="Lương Khô Nhỏ"> Lương Khô Nhỏ: 130 <img src="http://teenvui.me/farm/icon/item/2.png" title="cachua"/> và 20 <img src="http://teenvui.me/farm/vatnuoi/trungvit.png" title="Trứng gà"/></div>
<div class="list-me"><input type="radio" name="loai" value="lkl"> <img src="/icon/lkl.png" title="Lương Khô Lớn"> Lương Khô Lớn: 200 <img src="http://teenvui.me/farm/icon/item/1.png" title="Lúa"/> và 15 <img src="http://teenvui.me/farm/vatnuoi/trungvit.png" title="Trứng gà"/></div>
<div class="list-me">Nhập số lượng:<br><input type="text" name="soluong"></div>
<div class="list-me"><input type="submit" name="doi" value="Đổi"></div>
</form>';
}
if(isset($_POST['doi']))
{
$star = htmlspecialchars($_POST['soluong']);
if($star <= 0)
echo'<div class="list-me">Bạn phải nhập số lượng</div>';
else
{
$loai = htmlspecialchars($_POST['loai']);
if($loai == lkn)
{
$cachua = 130*$star;
$trung = 20*$star;
}
elseif($loai == lkl)
{
$lua = 200*$star;
$trung = 15*$star;
}
//--Đổi nguyên liệu sự kiện Yêu Lao Động Mod bởi Trần Văn Hoài--//

$xemtrung = $connect->fetch_array($connect->query("SELECT * FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '28'"));
$xemcachua = $connect->fetch_array($connect->query("SELECT * FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '2'"));
$xemlua = $connect->fetch_array($connect->query("SELECT * FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '1'"));
if($xemtrung['kol'] >= $trung AND $xemcachua['kol'] >= $cachua AND $xemlua['kol'] >= $lua)
{
$connect->query("UPDATE `users` SET `$loai` = `$loai` + $star WHERE `id` = '$user_id'");
$connect->query("UPDATE `fermer_sclad` SET `kol` = `kol` - $cachua WHERE `semen` = '2' AND `id_user` = '$user_id'");
$connect->query("UPDATE `fermer_sclad` SET `kol` = `kol` - $trung WHERE `semen` = '28' AND `id_user` = '$user_id'");
$connect->query("UPDATE `fermer_sclad` SET `kol` = `kol` - $lua WHERE `semen` = '1' AND `id_user` = '$user_id'");
echo'<div class="list-me">Chúc mừng! Bạn đã đổi thành công '.$star.' <img src="/icon/'.$loai.'.png"/></div>';
echo'<div class="list-me"><a href="/sukienlaodong" title="Sự Kiện yêu Lao Động">Quay lại</a></div>';
}
else
{
echo'<div class="list-me">Bạn không đủ nguyên liệu để đổi lương khô</div>';
echo'<div class="list-me"><a href="/sukienlaodong/doi-nguyen-lieu.html" title="Sự Kiện yêu Lao Động">Quay lại</a></div>';

}
}
}
include'menu.php';
//--Kết thúc Mod bởi Trần Văn Hoài--//
require_once ("../incfiles/end.php"); 
?>