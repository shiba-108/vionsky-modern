<?php 
define('_IN_JOHNCMS', 1); 
$textl = 'Đổi Điểm - Sự Kiện Yêu Lao Động'; 
require_once ("../incfiles/core.php"); 
require_once ("../incfiles/head.php"); 
if (!$user_id) { 
require_once ('../incfiles/head.php'); 
echo functions::display_error($lng['access_guest_forbidden']); 
require_once ('../incfiles/end.php'); 
exit; 
}
//--Đổi điểm sự kiện Yêu Lao Động Mod bởi Trần Văn Hoài--//
if(!isset($_POST['doi']))
{
echo'<div class="danhmuc">Đổi Nguyên Liệu</div>';
echo'<div class="list-me">Bạn đang có: '.$datauser['lkn'].' <img src="http://teenvui.me/icon/lkn.png"/> và '.$datauser['lkl'].' <img src="http://teenvui.me/icon/lkl.png"/></div>';
echo'<form action="" name="but" method="post"><div class="danhmuc"></div>
<div class="list-me"><input type="radio" name="loai" value="lkn"> <img src="/icon/lkn.png" title="Lương Khô Nhỏ"> Lương Khô Nhỏ: 2 điểm</div>
<div class="list-me"><input type="radio" name="loai" value="lkl"> <img src="/icon/lkl.png" title="Lương Khô Lớn"> Lương Khô Lớn: 3 điểm</div>
<div class="list-me">Nhập số lượng:<br><input type="text" name="soluong"></div>
<div class="list-me"><input type="submit" name="doi" value="Đổi"></div>
</form>';
}
if(isset($_POST['doi']))
{
$soluong = htmlspecialchars($_POST['soluong']);
if($soluong <= 0)
echo'<div class="list-me">Bạn phải nhập số lượng</div>';
else
{
$loai = htmlspecialchars($_POST['loai']);
if($datauser[$loai] >= $soluong)
{
//--Mod sự kiện bởi Trần Văn Hoài--//
if($loai == lkn)
$star = 2;
elseif($loai == lkl)
$star = 3;
$connect->query("UPDATE `users` SET `point_sukien` = `point_sukien` + ($soluong*$star) WHERE `id` = '$user_id'");
$connect->query("UPDATE `users` SET `point_all` = `point_all` + ($soluong*$star) WHERE `id` = '$user_id'");
$connect->query("UPDATE `users` SET `$loai` = `$loai` - $soluong WHERE `id` = '$user_id'");
echo'<div class="list-me">Bạn đã đổi thành công '.$soluong.' điểm</div>';
echo'<div class="list-me"><a href="/sukienlaodong" title="Sự Kiện yêu Lao Động">Quay lại</a></div>';
}
else
{
echo'<div class="list-me">Bạn không đủ lương khô để đổi</div>';
echo'<div class="list-me"><a href="/sukienlaodong/doi-diem-su-kien.html" title="Sự Kiện yêu Lao Động">Quay lại</a></div>';

}
}
}
include'menu.php';
//--Kết thúc Mod bởi Trần Văn Hoài--//
require_once ("../incfiles/end.php"); 
?>