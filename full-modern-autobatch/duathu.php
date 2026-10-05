<?php
define('_IN_JOHNCMS', 1);
$noionline = 'khumayman';
require('../incfiles/core.php');
$textl = 'Khu May Mắn';
require('../incfiles/head.php');
echo'<div class="danhmuc">Trường đua thú - Trần Văn Hoài</div>';
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
//--Mod Đua Thú Bởi Trần Văn Hoài - Star MeFun.vn - behattjeu0 M4V.ME--//
echo'
<style>.list-me
{background:none repeat scroll 0 0 #FFF;line-height:24px;border-left:1px solid #e9e9e9;border-right:1px solid #e9e9e9;border-bottom:1px solid #EBEBEB;padding:5px 7px;}</style>';
if(!isset($_POST['ketqua']))
{
echo'<div class="rmenu">Đặt 1 ăn 5 quá đã!!</div>';
echo'<div class="list-me">
<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tbody><tr><td style="vertical-align: top;width:45px;"><img src="duathu/1.gif" height="60" width="60" alt="*"></td><td><h3 style="font-size:12px">Thánh nhím</h3><br>
<span class="post_mota">Bạn có biết tml Rammus trong LOL không? Con nó đây này <img width="20px" src="http://sieuzui.net/images/smileys/user/Troll/troll.png" alt=""></span></td></tr></tbody></table></div>';
echo'<div class="list-me">
<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tbody><tr><td style="vertical-align: top;width:45px;"><img src="duathu/2.gif" height="60" width="60" alt="*"></td><td><h3 style="font-size:12px">Rồng huyền thoại</h3><br>
<span class="post_mota">Sải cánh rất rộng, một sinh vật huyền thoại, ừ thì huyền thoại nhưng liệu bạn có tin được không <img width="20px" src="http://sieuzui.net/images/smileys/user/Depdoc/yao.png" alt=""></span></td></tr></tbody></table></div>';
echo'<div class="list-me">
<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tbody><tr><td style="vertical-align: top;width:45px;"><img src="duathu/3.gif" height="60" width="60" alt="*"></td><td><h3 style="font-size:12px">Rắn thợ săn</h3><br>
<span class="post_mota">WTF?! Nó đã ở đây... Sinh vật không chân duy nhất tham gia cuộc đua, hãy tin tưởng nó theo cách của bạn <img width="20px" src="http://sieuzui.net/images/smileys/user/Depdoc/yao1.gif" alt=""></span></td></tr></tbody></table></div>';
echo'<div class="list-me">
<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tbody><tr><td style="vertical-align: top;width:45px;"><img src="duathu/4.gif" height="60" width="60" alt="*"></td><td><h3 style="font-size:12px">Mini Totoro</h3><br>
<span class="post_mota">Các thím đã xem phim này rồi chứ <img src="http://sieuzui.net/images/smileys/user/emotions/haha.gif" alt="">, nó chạy rất nhanh phải không nào? Nhưng totoro bé thế này thì không biết có làm nên trò trống gì không đây <img src="http://sieuzui.net/images/smileys/user/emotions/lol.gif" alt=""></span></td></tr></tbody></table></div>';
echo'<div class="list-me">
<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tbody><tr><td style="vertical-align: top;width:45px;"><img src="duathu/5.gif" height="60" width="60" alt="*"></td><td><h3 style="font-size:12px">Con bướm xinh</h3><br>
<span class="post_mota">Dành cho những người yêu thích "BƯỚM" <img src="http://sieuzui.net/images/smileys/user/Troll/troll.png" width="20px" alt=""></span></td></tr></tbody></table></div>';
echo'<div class="list-me">
<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tbody><tr><td style="vertical-align: top;width:45px;"><img src="duathu/6.gif" height="60" width="60" alt="*"></td><td><h3 style="font-size:12px">Người ngoài hành tinh</h3><br>
<span class="post_mota">Nhanh hay chậm? Hỏi nó mới biết <img src="http://sieuzui.net/images/smileys/user/Depdoc/yao.png" width="20px" alt="">, người ta gọi đây là từ trên trời rơi xuống đây mà <img src="http://sieuzui.net/images/smileys/simply/)).gif" alt=""></span></td></tr></tbody></table></div>';
echo'<div class="list-me">
<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tbody><tr><td style="vertical-align: top;width:45px;"><img src="duathu/7.gif" height="60" width="60" alt="*"></td><td><h3 style="font-size:12px">Khủng long phun nửa</h3><br>
<span class="post_mota">Tùy vào liều lượng chén ớt của nó để đi tìm nguồn nước uống phù hợp <img src="http://sieuzui.net/images/smileys/user/sports/best.gif" alt=""> <img src="http://sieuzui.net/images/smileys/simply/)).gif" alt=""></span></td></tr></tbody></table></div>';
echo'<div class="danhmuc">Đặt cược</div><div class="list-me">
<form action="?Mastic" method="post">
<select name="thu"><option value="1">Thánh nhím</option><option value="2">Rồng huyền thoại</option><option value="3">Rắn thợ săn</option><option value="4">Mini totoro</option><option value="5">Con bướm xinh</option><option value="6">Người ngoài hành tinh</option><option value="7">Khủng long phun nửa</option></select><br/>
Tiền đặt: <br/><input type="text" name="tien"/><br/>
<input type="submit" name="ketqua" value="Xem kết quả"/></form></div>';
}
//--Mod Đua Thú Bởi Trần Văn Hoài - Star MeFun.vn - behattjeu0 M4V.ME--//
if(isset($_POST['ketqua']))
{
$tien = htmlspecialchars($_POST['tien']);
$thu = $_POST['thu'];
if($tien < 0)
{
echo'<div class="list-me">Lỗi! số tiền bạn đặt không hợp lệ</div>';
}
elseif($thu < 1 OR $thu > 7)
{
echo'<div class="list-me">Lỗi! Thú bạn đặt không phù hợp</div>';
}
else
{
echo'
<style>
.kg {
    background: url("duathu/kg.png");
    repeat-x;
    height: 120px;
}
.dd {
    background: url("duathu/dd.png");
}
.buico {
background: url("duathu/buico.png") repeat-x;
height: 24px;
}
</style><div class="kg"></div><div class="buico"></div><div class="dd">';
$connect->query("UPDATE `users` SET `tienxu` = `tienxu` - $tien WHERE `id` = '$user_id'");
$rand = rand(1,7);
$dem = 0;
for( $i = 1 ; $i <= 7 ; $i++ )
{
$dem = $dem+1;
if($thu == $rand)
{
$money = $tien*5;
$at = 1;
if($dem == 1)
$connect->query("UPDATE `users` SET `tienxu` = `tienxu` + '".$money."' WHERE `id` = '".$user_id."'");
if($i == $thu)
$rand1 = 10;
else
$rand1 = rand(1,9);
}
elseif($thu != $rand)
{
if($i == $thu)
$rand1 = 2;
else
$rand1 = rand(1,9);
}
echo'<marquee behavior="slide" direction="right" scrollamount="'.$rand1.'"><img src="duathu/'.$i.'.gif"></marquee>';
}
echo'</div><div class="buico"></div>';

if($at == 1)
$loichuc = 'Xin chúc mừng! thú của bạn đã chiến thắng, bạn nhận được '.($tien*5).' VNĐ';
else
$loichuc = 'Xin chia buồn! Thú của bạn vì yếu sinh lý nên đã không thể chiến thắng';
echo'<div class="list-me"><font color="red">'.$loichuc.'</font><br/><a href="duathu.php"><font color="blue">Tiếp tục</font></a></div></div>';
}
}



//--Mod Đua Thú Bởi Trần Văn Hoài - Star MeFun.vn - behattjeu0 M4V.ME--//
require('../incfiles/end.php');
?>
