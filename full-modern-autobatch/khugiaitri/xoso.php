<?php
//Mod xo so cho johncms
//By Sinh Thanh - SinhThanh.XtGem.Com
//SDT 01639454205
//Support at SinhThanh.XtGem.Com & JOHNCMSVN.COM
define('_IN_JOHNCMS',1);

$textl='Đánh xổ số online';

require('../incfiles/core.php');
require('../incfiles/head.php');
//Id bot thong bao wap ban.
$idbot='2';
if(!$user_id) {
echo '<div class="rmenu">Đăng nhập để thực hiện hành động</div>';
require('../incfiles/end.php');
exit();
}
$mm=intval(abs($datauser['tienxu']));
switch($_GET['andy']) {
case 'danh':
if(isset($_POST['so'])) {
$ktranao=($connect->query("SELECT COUNT(*) FROM `xoso` WHERE `user_id`='$user_id'")->fetch_row()[0] ?? 0);
$time=intval(date('H',time()+3600*7));
$so=intval(abs($_POST['so']));
$tien=intval(abs($_POST['tien']));
if(empty($so) || empty($tien)) $error .='Chưa nhập số.';
if($so > 99 || $so < 0) $error .='Sai số rùi nhé';
if($tien > $mm || $tien > 500000 || $tien < 0) $error .='Số tiền không cho phép';
if($time >= 18) $error .='Đã quá giờ đánh rùi';
if($ktranao) $error .='Ngày hôm nay bạn đã đánh rùi hoặc bảo lưu kết quả ngày hôm qua.';
if(!preg_match('/([0-9]+)/i',$so) || !preg_match('/([0-9]+)/i',$tien)) $error .='Bạn zừa nhập không phải số.';

if($error) {
echo functions::display_error($error);
require('../incfiles/end.php');
exit();
}
if(!$error) {
$time=time();
$connect->query("INSERT INTO `xoso` SET `user_id`='$user_id' , `so`='$so' , `tien`='$tien', `time`='$time'");
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`-$tien WHERE `id`='$user_id' LIMIT 1");
echo '<div class="menu">Đánh thành công. Vui lòng đợi kết quả.</div>';
require('../incfiles/end.php');
}
}
break;
case 'list':
if($rights < 3) {
exit('Truy cap trai phep');
}

$thanh=$connect->query("SELECT * FROM `xoso` ORDER BY `time` DESC LIMIT $start,$kmess");
$tong=$connect->query("SELECT * FROM ...")$thanh);
if($tong) {
$i=1;
while($andy=$connect->fetch_assoc($thanh)) {
echo ''.($i % 2 == 0 ? '<div class="menu">':'<div class="menu">').'<font color="red">'.$i.'</font>. <a href="/users/profile.php?user='.$andy['user_id'].'">'.nick($andy['user_id']).'</a><br/>Đánh số <font color="red">'.$andy['so'].'</font> với giá <font color="red">'.$andy['tien'].'</font> XU vào '.functions::display_date($andy['time']).'</div>';
$i++;
}

if ($tong > $kmess) {
echo '<div class="menu">'.functions::display_pagination('xoso.php?andy=list&amp;', $start, $tong, $kmess).'</div>';
}
} else {
echo '<div class="menu">Không có thành viên nào chơi</div>';
require('../incfiles/end.php');

}
break;
case 'ketqua':
$gio=intval(date('H',time()+7*3600));

if($gio < 20) {
exit('Bạn không đủ cấp độ hoặc chưa đến giờ.');
}
include 'funa.php';
$nd=grab_link('http://xoso.wap.vn/xsmb-ket-qua-xo-so-mien-bac-xstd.html');
$ketqua=strip_tags(laynoidung($nd,'<strong class="do">','</strong>'));
$ketqua=substr($ketqua,3,2);
$ketqua=intval(abs($ketqua));

$tong=($connect->query("SELECT COUNT(*) FROM `xoso`")->fetch_row()[0] ?? 0);
$nguoitrung=($connect->query("SELECT COUNT(*) FROM `xoso` WHERE `so`='$ketqua'")->fetch_row()[0] ?? 0);

if($tong && $ketqua != null) {

$thanh=$connect->query("SELECT * FROM `xoso` ORDER BY `time` DESC");
while($andy=$connect->fetch_assoc($thanh)) {
$idm=intval(abs($andy['user_id']));
$sotien=intval(abs($andy['tien']*70));
$ngay=date('d-m-Y',time()+7*3600);
$danh=intval(abs($andy['so']));
if($ketqua==$danh) {
//Cap nhat data
$connect->query("UPDATE `users` SET `tienxu`=`tienxu`+$sotien WHERE `id`='$idm'");
$connect->query("DELETE FROM `xoso` WHERE `user_id`='$idm'");
$connect->query("INSERT INTO `xoso_log` SET `user_id`='$idm' , `time`='$ngay' , `so`='$danh' , `tien`='$sotien'");

$tinnhan='Chúc mừng bạn. Bạn đã trúng '.$sotien.' đánh số '.$danh.' ngày '.$ngay.' . Hãy ủng hộ diễn đàn thêm nhé.';

$theme='Trúng xổ số';
//gui email thong bao
$kt= ($connect->query("SELECT COUNT(*) FROM `cms_mail` WHERE `from_id` ='".$idm."' AND `text`= '".$tinnhan."'")->fetch_row()[0] ?? 0);
if($kt==0) {
$connect->query("INSERT INTO `cms_mail` SET
`user_id` = '0',
`from_id` = '".$idm."',
`text` = '".mysql_real_escape_string($tinnhan)."',
`time` = '".time()."',
`sys` = '1',
`them` = '".mysql_real_escape_string($theme)."'
");
}
if($kt !=0) {
$connect->query("UPDATE `cms_mail` SET `from_id`= '{$idm}',
`read`='0',
`time`='".time()."' WHERE `text`='{$tinnhan}'");
}
}
}
$connect->query("DELETE FROM `xoso`");
if($nguoitrung) {
$default=date('d-m-Y',time()+7*3600);
$bot='Hôm nay có [url='.$home.'/mod/xoso.php?andy=thongke&time='.$default.']'.$nguoitrung.'[/url] người trúng xổ số.';
} else {
$bot='Haiz. Hôm nay không ai trúng xổ số.';
}
$time=time();
$connect->query("INSERT INTO `guest` SET
`adm` = '0',
`time` = '$time',
`user_id` = '$idbot',
`name` = 'BOT',
`text` = '".mysql_real_escape_string($bot)."',
`ip` = '60543201',
`browser` = 'Iphone 4'
");
echo '<div class="menu">Đã cập nhật kết quả.</div>';





}
break;
default:
echo '<div class="phdr">Đánh xổ số</div><div class="menu">Luật chơi:<br/>Nhập số muốn đánh và số tiền<br/>Thắng ăn x70 lần<br/>Số tiền đánh nhỏ hơn 500k xu<br/>Kết quả lấy 2 số cuối giải đặc biệt của xổ số miền bắc.<br/>Nếu ngày hôm đó admin không truy cập link cập nhật thì kết quả bạn đánh sẽ được dùng cho ngày hôm sau.<br/>Mỗi ngày chỉ được đánh 1 lần.<br/>Thời gian đánh là từ 0h đến 18h<br/><br/>Chỉ những người trúng mới nhận được email thông báo.<br/>Thời gian quay số từ 19h30 tuy nhiên kết quả phụ thuộc vào admin cập nhật.<br/></div>';


echo '<div class="rmenu"><form action="xoso.php?andy=danh" method="post"><br/>Nhập số muốn đánh :<br/><input name="so" type="number"><br/>Số tiền ( < 500k ):<br/><input name="tien" type="number"><br/><input name="submit" type="submit" value="Đánh nào."></form></div>';
$gio=intval(date('H',time()+7*3600));
echo '<div class="menu"><a href="xoso.php?andy=thongke">Xem thống kê người trúng</a></div>'.($gio <= 19 ? '':'<div class="menu"><a href="xoso.php?andy=ketqua"><font color="red">Nhấn vào đây để kiểm tra kết quả ( sau 19h)</font></a></div>').''.($rights >= 3 ? '<div class="menu"><a href="xoso.php?andy=list">Xem ai đánh hôm nay</a></div>':'').'';

require('../incfiles/end.php');
break;
case 'thongke':
$default=date('d-m-Y',time()+7*3600);
$dk=functions::check($_GET['time']);
$dk=$dk ? $dk : $default;
echo '<div class="phdr">Danh sách thành viên trúng '.$dk.'.</div>';
$thanh=$connect->query("SELECT * FROM `xoso_log` WHERE `time`='".mysql_real_escape_string($dk)."' ORDER BY `time` DESC LIMIT $start,$kmess");
$tong=$connect->query("SELECT * FROM ...")$thanh);
if($tong) {
$i=1;
while($andy=$connect->fetch_assoc($thanh)) {
echo ''.($i % 2 == 0 ? '<div class="menu">':'<div class="menu">').'<font color="red">'.$i.'</font>. <a href="/account/'.$andy['user_id'].'">'.nick($andy['user_id']).'</a><br/>Đánh số <font color="red">'.$andy['so'].'</font> trúng <font color="red">'.$andy['tien'].'</font> XU vào '.$andy['time'].'</div>';
$i++;
}

if ($tong > $kmess) {
echo '<div class="menu">'.functions::display_pagination('xoso.php?andy=thongke&amp;time='.$dk.'&amp;', $start, $tong, $kmess).'</div>';
}
} else {
echo '<div class="menu">Không có thành viên nào trúng trong ngày '.$dk.'</div>';
}

require('../incfiles/end.php');
break;
}

//Vui long khong xoa
echo '<div class="gmenu">Code by XemLaSuong.Tk</div>';
?>
